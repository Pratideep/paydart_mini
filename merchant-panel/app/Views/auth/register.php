<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Portal | Register</title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            margin: 0;
            font-family: 'Inter', -apple-system, sans-serif;
            /* Modern Gradient Background */
            background: radial-gradient(circle at top left, #e0e7ff 0%, #ffffff 50%, #f3f4f6 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-main);
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .auth-card {
            background: var(--glass-bg);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h2 {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.025em;
            color: #111827;
        }

        .header p {
            color: var(--text-muted);
            margin-top: 8px;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            font-size: 1rem;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        button:active {
            transform: translateY(0);
        }

        .divider {
            margin: 24px 0;
            text-align: center;
            border-bottom: 1px solid #f3f4f6;
            line-height: 0.1em;
        }

        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="auth-container">
        <div class="auth-card">
            <div class="header">
                <h2>Create Account</h2>
                <p>Join our merchant network today</p>
            </div>

            <form method="post" action="<?= base_url('register') ?>">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">Business Name</label>
                    <input type="text" name="name" id="name" placeholder="John Doe Ltd." required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="name@company.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>

                <button type="submit">Get Started</button>
            </form>

            <div class="footer">
                Already have an account? <a href="<?= base_url('login') ?>">Sign in</a>
            </div>
        </div>
    </div>

</body>

</html>