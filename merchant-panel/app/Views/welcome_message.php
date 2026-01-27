<?php
$system_name = "Paydart Mini PSP";
$version = "v1.0.4";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | <?php echo $system_name; ?></title>
    <style>
        /* This CSS replaces Tailwind so you don't need the Internet */
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --bg: #f9fafb;
            --text-dark: #111827;
            --text-gray: #4b5563;
        }

        body {
            font-family: -apple-system, system-ui, sans-serif;
            background-color: var(--bg);
            margin: 0;
            color: var(--text-dark);
        }

        .nav {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-weight: bold;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-box {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 5px 10px;
            border-radius: 8px;
        }

        .container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .hero-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #f3f4f6;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
            flex-wrap: wrap;
        }

        .hero-main {
            padding: 50px;
            flex: 2;
            min-width: 300px;
        }

        .hero-sidebar {
            padding: 50px;
            flex: 1;
            background: #eff6ff;
            min-width: 250px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        p {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-group {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: #1e3a8a;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: var(--text-gray);
        }

        .status-list {
            list-style: none;
            padding: 0;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 0.9rem;
            color: #1e40af;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .dot-green {
            background: #22c55e;
        }

        .dot-blue {
            background: #3b82f6;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .info-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #f3f4f6;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            color: #9ca3af;
            padding-bottom: 30px;
        }
    </style>
</head>

<body>

    <nav class="nav">
        <div class="brand">
            <div class="logo-box">P</div>
            <span>Paydart <span style="color:var(--primary-light)">Mini</span></span>
        </div>
        <div style="display: flex; gap: 20px; align-items: center;">
            <a href="login" style="color:var(--text-gray); text-decoration:none; font-weight:500;">Login</a>
            <a href="#" style="color:var(--text-gray); text-decoration:none;">Docs</a>
        </div>
    </nav>

    <main class="container">
        <div class="hero-card">
            <div class="hero-main">
                <h1>PSP Handler Active & Ready.</h1>
                <p>The Paydart Mini interface is successfully initialized. Use this endpoint to process incoming transactions, manage merchant callbacks, and monitor status in real-time.</p>

                <div class="btn-group">
                    <a href="login" class="btn btn-primary">Merchant Login</a>
                    <a href="register" class="btn btn-secondary" style="background: #e0e7ff; color: #1e40af;">Create Account</a>
                </div>

                <div style="margin-top: 20px;">
                    <a href="test-transaction.php" style="color: var(--text-gray); font-size: 0.9rem; text-decoration: underline;">Or run a test payment &rarr;</a>
                </div>
            </div>
            <div class="hero-sidebar">
                <h3 style="margin-top:0">System Status</h3>
                <ul class="status-list">
                    <li class="status-item"><span class="dot dot-green"></span> API Endpoint: Online</li>
                    <li class="status-item"><span class="dot dot-green"></span> DB Connection: Stable</li>
                    <li class="status-item"><span class="dot dot-blue"></span> Version: <?php echo $version; ?></li>
                </ul>
            </div>
        </div>

        <div class="grid">
            <div class="info-card">
                <h4>Webhooks</h4>
                <p style="font-size: 0.9rem">Configure your listener URL to receive instant HTTP POST notifications.</p>
            </div>
            <div class="info-card">
                <h4>Security</h4>
                <p style="font-size: 0.9rem">Ensure your Secret Key is stored in a secure .env file.</p>
            </div>
            <div class="info-card">
                <h4>Documentation</h4>
                <p style="font-size: 0.9rem">Access the full API schema to integrate Paydart Mini.</p>
            </div>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Paydart Systems.
    </footer>

</body>

</html>