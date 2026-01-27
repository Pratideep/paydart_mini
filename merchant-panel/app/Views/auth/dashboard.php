<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Dashboard</title>
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #6366f1;
            --bg: #f9fafb;
            --text-dark: #111827;
            --text-light: #6b7280;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            display: flex;
            flex-direction: column;
            /* Stack for mobile */
        }

        /* Mobile Header */
        .mobile-top-bar {
            display: none;
            background: white;
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* Sidebar Navigation */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            height: 100vh;
            border-right: 1px solid #e5e7eb;
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

        /* Main Content Area */
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
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .merchant-badge {
            background: #e0e7ff;
            color: var(--primary);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .stat-card h3 {
            margin: 0;
            font-size: 0.875rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .stat-card p {
            margin: 10px 0 0 0;
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .logout-btn {
            margin-top: auto;
            color: #ef4444;
            font-weight: 600;
            text-decoration: none;
            padding: 12px 16px;
        }

        /* Mobile Menu Toggle Button */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-dark);
        }

        /* Responsive Breakpoint */
        @media (max-width: 768px) {
            .mobile-top-bar {
                display: flex;
            }

            .sidebar {
                transform: translateX(-100%);
                /* Hide sidebar */
                top: 0;
                left: 0;
            }

            .sidebar.active {
                transform: translateX(0);
                /* Show sidebar when active */
            }

            .main-content {
                margin-left: 0;
                padding: 24px 16px;
            }

            .menu-toggle {
                display: block;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                /* Stack cards vertically */
            }

            .header {
                flex-direction: column;
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

        <a href="/dashboard" class="nav-link active">Dashboard</a>
        <a href="/psp-keys" class="nav-link">PSP KEYS</a>
        <a href="#" class="nav-link">Transactions</a>
        <a href="#" class="nav-link">Settings</a>

        <a href="<?= base_url('logout') ?>" class="logout-btn">Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1 style="margin:0; font-size: 1.5rem;">Overview</h1>
                <p style="color:var(--text-light); margin: 4px 0 0 0;">Welcome back to your store manager.</p>
            </div>
            <div class="merchant-badge">
                Merchant ID: #<?= esc($merchant_id) ?>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Sales</h3>
                <p>$12,450.00</p>
            </div>
            <div class="stat-card">
                <h3>Active Orders</h3>
                <p>24</p>
            </div>
            <div class="stat-card">
                <h3>Customers</h3>
                <p>1,205</p>
            </div>
        </div>

        <div style="background:white; padding:40px; border-radius:16px; border:1px solid #e5e7eb; text-align:center; color:var(--text-light);">
            <p>No recent activity to show.</p>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // Close menu if clicking outside on mobile
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