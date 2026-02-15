<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Checkout</title>
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #6366f1;
            --bg: #f9fafb;
            --text-dark: #111827;
            --text-light: #6b7280;
            --line: #e5e7eb;
            --danger: #b42318;
            --danger-bg: #fff1f2;
            --danger-border: #fecdd3;
            --success: #047857;
            --success-bg: #ecfdf3;
            --success-border: #bbf7d0;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            display: flex;
            flex-direction: column;
        }

        .mobile-top-bar {
            display: none;
            background: white;
            padding: 16px;
            border-bottom: 1px solid var(--line);
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            height: 100vh;
            border-right: 1px solid var(--line);
            position: fixed;
            display: flex;
            flex-direction: column;
            padding: 24px;
            box-sizing: border-box;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .logo {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--primary);
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo a {
            color: inherit;
            text-decoration: none;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-light);
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-link.active {
            background: #f3f4ff;
            color: var(--primary);
        }

        .nav-link:hover:not(.active) {
            background: #f9fafb;
            color: var(--text-dark);
        }

        .logout-btn {
            margin-top: auto;
            color: #ef4444;
            font-weight: 600;
            text-decoration: none;
            padding: 12px 16px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-dark);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 40px;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .merchant-badge {
            background: #e0e7ff;
            color: var(--primary);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .content-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid var(--line);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .content-card h2 {
            margin: 0 0 6px;
            font-size: 1.25rem;
            color: var(--text-dark);
        }

        .content-card p {
            margin: 0 0 16px;
            color: var(--text-light);
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9rem;
        }

        input,
        select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 0.95rem;
            color: var(--text-dark);
            background: white;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
        }

        .pay-btn {
            margin-top: 12px;
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 12px 14px;
            background: var(--primary);
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        .pay-btn:hover {
            filter: brightness(0.96);
        }

        .alert {
            border-radius: 10px;
            padding: 11px 12px;
            margin-bottom: 14px;
            font-size: 0.92rem;
        }

        .alert-danger {
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid var(--danger-border);
        }

        .result {
            margin-top: 18px;
            border: 1px solid var(--success-border);
            background: var(--success-bg);
            padding: 12px;
            border-radius: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #d1fae5;
        }

        .row:last-child {
            border-bottom: 0;
        }

        .k {
            color: #065f46;
            font-weight: 500;
        }

        .v {
            font-weight: 700;
            color: var(--success);
            text-align: right;
        }

        @media (max-width: 768px) {
            .mobile-top-bar {
                display: flex;
            }

            .sidebar {
                transform: translateX(-100%);
                top: 0;
                left: 0;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 24px 16px;
            }

            .menu-toggle {
                display: block;
            }

            .header {
                flex-direction: column;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="mobile-top-bar">
        <div class="logo" style="margin-bottom:0;">
            <div style="width:24px; height:24px; background:var(--primary); border-radius:6px;"></div>
            MerchantHub
        </div>
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="logo">
            <div style="width:32px; height:32px; background:var(--primary); border-radius:8px;"></div>
            <a href="/homepage">MerchantHub</a>
        </div>

        <a href="/dashboard" class="nav-link">Dashboard</a>
        <a href="/psp-keys" class="nav-link">PSP KEYS</a>
        <a href="/checkout" class="nav-link active">Checkout</a>
        <a href="/transactions" class="nav-link">Transactions</a>
        <a href="#" class="nav-link">Settings</a>

        <a href="<?= base_url('logout') ?>" class="logout-btn">Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1 style="margin:0; font-size: 1.5rem;">Checkout</h1>
                <p style="color:var(--text-light); margin: 4px 0 0 0;">Create and process a payment from your merchant account.</p>
            </div>
            <div class="merchant-badge">
                Merchant ID: #<?= esc($merchant_id) ?>
            </div>
        </div>

        <section class="content-card">
            <h2>New Payment</h2>
            <p>Choose amount, currency and PSP to process a test transaction.</p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= esc($error) ?></div>
            <?php endif; ?>

            <?php if (empty($psps)): ?>
                <div class="alert alert-danger">
                    No active PSP found. Add and activate one from PSP Keys first.
                </div>
            <?php else: ?>
                <form method="post" action="<?= base_url('checkout/pay') ?>">
                    <?= csrf_field() ?>

                    <div class="grid">
                        <div>
                            <label for="order_id">Order ID</label>
                            <input id="order_id" name="order_id" required value="<?= esc(old('order_id') ?: ('ORD-' . time())) ?>">
                        </div>
                        <div>
                            <label for="amount">Amount</label>
                            <input id="amount" type="number" name="amount" min="0.01" step="0.01" required value="<?= esc(old('amount') ?: '10') ?>">
                        </div>
                    </div>

                    <div class="grid">
                        <div>
                            <label for="currency">Currency</label>
                            <select id="currency" name="currency">
                                <option value="INR" <?= old('currency') === 'INR' ? 'selected' : '' ?>>INR</option>
                                <option value="USD" <?= old('currency') === 'USD' ? 'selected' : '' ?>>USD</option>
                            </select>
                        </div>
                        <div>
                            <label for="preferred_psp">Choose PSP</label>
                            <select id="preferred_psp" name="preferred_psp" required>
                                <?php foreach ($psps as $psp): ?>
                                    <?php $name = strtolower((string) $psp['psp_name']); ?>
                                    <option value="<?= esc($name) ?>" <?= old('preferred_psp') === $name ? 'selected' : '' ?>>
                                        <?= esc(strtoupper($name)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="pay-btn">Pay Now</button>
                </form>
            <?php endif; ?>

            <?php if (!empty($result)): ?>
                <div class="result">
                    <div class="row"><span class="k">Message</span><span class="v"><?= esc($result['message'] ?? '-') ?></span></div>
                    <div class="row"><span class="k">Order ID</span><span class="v"><?= esc($result['order_id'] ?? '-') ?></span></div>
                    <div class="row"><span class="k">PSP Used</span><span class="v"><?= esc($result['psp_used'] ?? '-') ?></span></div>
                    <div class="row"><span class="k">Transaction Ref</span><span class="v"><?= esc($result['transaction_ref'] ?? '-') ?></span></div>
                </div>
            <?php endif; ?>
        </section>
    </div>

    <script>
        function toggleMenu() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !menuToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    </script>

</body>

</html>
