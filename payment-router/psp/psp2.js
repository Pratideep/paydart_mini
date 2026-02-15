const PSP_NAME = "paypal";

async function processPayment(payload) {
  const amount = Number(payload.amount);
  if (!Number.isFinite(amount) || amount <= 0) {
    return {
      success: false,
      message: "Invalid amount",
      code: "INVALID_AMOUNT",
    };
  }

  return {
    success: true,
    message: "Payment processed by PayPal (mock)",
    transactionRef: `pp_${Date.now()}`,
    psp: PSP_NAME,
  };
}

module.exports = {
  PSP_NAME,
  processPayment,
};
