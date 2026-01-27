<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Portal | Login</title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --error-bg: #fef2f2;
            --error-text: #b91c1c;
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            margin: 0;
            font-family: 'Inter', -apple-system, sans-serif;
            background: radial-gradient(circle at top right, #e0e7ff 0%, #ffffff 50%, #f3f4f6 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .auth-card {
            background: var(--glass-bg);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #111827;
            margin: 0;
        }

        .header p {
            color: #6b7280;
            margin-top: 8px;
        }

        /* Error Alert Styling */
        .alert {
            padding: 12px 16px;
            background-color: var(--error-bg);
            color: var(--error-text);
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            border: 1px solid rgba(185, 28, 28, 0.1);
            display: flex;
            align-items: center;
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
        }

        button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>


    <div class="auth-container">
        <div class="auth-card">
            <div class="header">
                <h2>Welcome Back</h2>
                <p>Enter your details to login</p>
            </div>

            <?php if (session()->getFlashdata('success')): ?>
                <div style="background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem; border: 1px solid #10b981;">
                    ✅ <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('login') ?>">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="name@company.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>

                <button type="submit">Sign In</button>
            </form>

            <div class="footer">
                Don't have an account? <a href="<?= base_url('register') ?>">Create one</a>
            </div>
        </div>
    </div>

</body>

</html>