require("dotenv").config();

const express = require("express");
const cors = require("cors");
const { query, closePool } = require("./db");
const psp1 = require("./psp/psp1");
const psp2 = require("./psp/psp2");

const app = express();
const PORT = Number(process.env.PORT || 3000);

app.use(cors());
app.use(express.json());

const PSP_HANDLERS = {
  stripe: psp1.processPayment,
  paypal: psp2.processPayment,
};

function normalizePspName(name) {
  return String(name || "").trim().toLowerCase();
}

function parseAmount(input) {
  const value = Number(input);
  return Number.isFinite(value) && value > 0 ? value : null;
}

async function fetchActivePsps(merchantId) {
  const priorityColumnRows = await query(
    `
      SELECT COUNT(*) AS has_priority
      FROM information_schema.COLUMNS
      WHERE TABLE_SCHEMA = DATABASE()
        AND TABLE_NAME = 'merchant_psp_keys'
        AND COLUMN_NAME = 'priority'
    `
  );

  const hasPriority = Number(priorityColumnRows?.[0]?.has_priority || 0) > 0;
  const orderBy = hasPriority ? "priority ASC, id ASC" : "id ASC";

  const rows = await query(
    `
      SELECT id, merchant_id, psp_name, status
      FROM merchant_psp_keys
      WHERE merchant_id = ?
        AND status = 'active'
      ORDER BY ${orderBy}
    `,
    [merchantId]
  );

  return rows;
}

async function saveTransaction({ merchantId, orderId, amount, pspUsed, status }) {
  try {
    await query(
      `
        INSERT INTO transactions
        (merchant_id, order_id, amount, psp_used, status)
        VALUES (?, ?, ?, ?, ?)
      `,
      [merchantId, orderId, amount, pspUsed, status]
    );
    return;
  } catch (error) {
    if (error.code !== "ER_BAD_FIELD_ERROR") {
      throw error;
    }
  }

  try {
    await query(
      `
        INSERT INTO transactions
        (merchant_id, order_id, amount, psp_name, status)
        VALUES (?, ?, ?, ?, ?)
      `,
      [merchantId, orderId, amount, pspUsed, status]
    );
    return;
  } catch (error) {
    if (error.code !== "ER_BAD_FIELD_ERROR") {
      throw error;
    }
  }

  await query(
    `
      INSERT INTO transactions
      (merchant_id, order_id, amount, status)
      VALUES (?, ?, ?, ?)
    `,
    [merchantId, orderId, amount, status]
  );
}

app.get("/health", async (_req, res) => {
  try {
    await query("SELECT 1");
    res.status(200).json({ ok: true, service: "payment-router" });
  } catch (error) {
    res.status(500).json({
      ok: false,
      message: "Database connectivity failed",
      error: error.message,
    });
  }
});

app.get("/api/psps/:merchantId", async (req, res) => {
  try {
    const merchantId = Number(req.params.merchantId);
    if (!Number.isInteger(merchantId) || merchantId <= 0) {
      return res.status(400).json({ message: "merchantId must be a positive integer" });
    }

    const psps = await fetchActivePsps(merchantId);
    return res.status(200).json({ merchantId, count: psps.length, psps });
  } catch (error) {
    return res.status(500).json({ message: "Failed to fetch PSP list", error: error.message });
  }
});

app.post("/api/pay", async (req, res) => {
  const merchantId = Number(req.body.merchant_id);
  const orderId = String(req.body.order_id || "").trim();
  const amount = parseAmount(req.body.amount);
  const currency = String(req.body.currency || "INR").trim().toUpperCase();
  const preferredPsp = normalizePspName(req.body.preferred_psp);

  if (!Number.isInteger(merchantId) || merchantId <= 0) {
    return res.status(400).json({ message: "merchant_id must be a positive integer" });
  }
  if (!orderId) {
    return res.status(400).json({ message: "order_id is required" });
  }
  if (!amount) {
    return res.status(400).json({ message: "amount must be a positive number" });
  }

  try {
    let activePsps = await fetchActivePsps(merchantId);
    if (preferredPsp) {
      activePsps = activePsps.filter((psp) => normalizePspName(psp.psp_name) === preferredPsp);
    }

    if (activePsps.length === 0) {
      await saveTransaction({
        merchantId,
        orderId,
        amount,
        pspUsed: null,
        status: "failed",
      });
      return res.status(404).json({
        message: preferredPsp
          ? `Selected PSP '${preferredPsp}' is not active for this merchant`
          : "No active PSP configured for this merchant",
      });
    }

    for (const psp of activePsps) {
      const pspName = normalizePspName(psp.psp_name);
      const handler = PSP_HANDLERS[pspName];
      if (!handler) {
        continue;
      }

      const result = await handler({ merchantId, orderId, amount, currency });
      if (result.success) {
        await saveTransaction({
          merchantId,
          orderId,
          amount,
          pspUsed: psp.psp_name,
          status: "success",
        });

        return res.status(200).json({
          message: "Payment successful",
          merchant_id: merchantId,
          order_id: orderId,
          amount,
          currency,
          psp_used: psp.psp_name,
          transaction_ref: result.transactionRef,
        });
      }
    }

    await saveTransaction({
      merchantId,
      orderId,
      amount,
      pspUsed: activePsps[0].psp_name,
      status: "failed",
    });

    return res.status(502).json({
      message: "Payment failed after trying all active PSPs",
      merchant_id: merchantId,
      order_id: orderId,
      amount,
      currency,
      available_psps: activePsps.map((p) => normalizePspName(p.psp_name)),
    });
  } catch (error) {
    return res.status(500).json({ message: "Unexpected payment router error", error: error.message });
  }
});

const server = app.listen(PORT, () => {
  // eslint-disable-next-line no-console
  console.log(`Payment router running on http://localhost:${PORT}`);
});

process.on("SIGINT", async () => {
  server.close(async () => {
    await closePool();
    process.exit(0);
  });
});
