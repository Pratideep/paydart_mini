<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #6366f1;
            --bg: #f9fafb;
            --text-dark: #111827;
            --text-light: #6b7280;
            --line: #e5e7eb;
            --ok: #047857;
            --fail: #b42318;
            --danger: #b42318;
            --danger-bg: #fff1f2;
            --danger-border: #fecdd3;
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

        .alert {
            border-radius: 10px;
            padding: 11px 12px;
            margin-bottom: 14px;
            font-size: 0.92rem;
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid var(--danger-border);
        }

        .empty {
            border: 1px dashed var(--line);
            border-radius: 10px;
            padding: 18px;
            color: var(--text-light);
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid var(--line);
            border-radius: 12px;
            overflow: hidden;
        }

        th,
        td {
            text-align: left;
            padding: 11px 12px;
            border-bottom: 1px solid var(--line);
            font-size: 0.92rem;
        }

        th {
            background: #f8fafc;
            color: #334155;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .status {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
            background: #eef2ff;
        }

        .status.success {
            color: var(--ok);
            background: #ecfdf3;
        }

        .status.failed {
            color: var(--fail);
            background: #fff1f2;
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
        }

        @media (max-width: 780px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                border: 1px solid var(--line);
                border-radius: 10px;
                margin-bottom: 10px;
                background: #fff;
            }

            td {
                border: 0;
                border-bottom: 1px solid var(--line);
                display: flex;
                justify-content: space-between;
                gap: 10px;
            }

            td:last-child {
                border-bottom: 0;
            }

            td::before {
                content: attr(data-label);
                color: #475569;
                font-weight: 700;
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
        <a href="/checkout" class="nav-link">Checkout</a>
        <a href="/transactions" class="nav-link active">Transactions</a>
        <a href="#" class="nav-link">Settings</a>

        <a href="<?= base_url('logout') ?>" class="logout-btn">Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1 style="margin:0; font-size: 1.5rem;">Payment History</h1>
                <p style="color:var(--text-light); margin: 4px 0 0 0;">Track all payments processed for your merchant account.</p>
            </div>
            <div class="merchant-badge">
                Merchant ID: #<?= esc($merchant_id) ?>
            </div>
        </div>

        <section class="content-card">
            <h2>Transactions</h2>
            <p>Latest transactions are listed first.</p>

            <?php if (!empty($error)): ?>
                <div class="alert"><?= esc($error) ?></div>
            <?php elseif (empty($transactions)): ?>
                <div class="empty">No payments yet. Complete a checkout payment to see history here.</div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order</th>
                            <th>Amount</th>
                            <th>PSP</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $txn): ?>
                            <?php
                            $status = strtolower((string) ($txn['status'] ?? ''));
                            $created = $txn['created_at'] ?? $txn['updated_at'] ?? '-';
                            $psp = $txn['psp'] ?? '-';
                            ?>
                            <tr>
                                <td data-label="ID"><?= esc((string) ($txn['id'] ?? '-')) ?></td>
                                <td data-label="Order"><?= esc((string) ($txn['order_id'] ?? '-')) ?></td>
                                <td data-label="Amount"><?= esc((string) ($txn['amount'] ?? '-')) ?></td>
                                <td data-label="PSP"><?= esc((string) $psp) ?></td>
                                <td data-label="Status">
                                    <span class="status <?= $status === 'success' ? 'success' : ($status === 'failed' ? 'failed' : '') ?>">
                                        <?= esc((string) ($txn['status'] ?? '-')) ?>
                                    </span>
                                </td>
                                <td data-label="Created"><?= esc((string) $created) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
