
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add PSP Configuration</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f9fafb;
            --card-bg: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-color: #d1d5db;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-top: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            border-bottom: 2px solid var(--bg-color);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
            /* Crucial for width alignment */
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .help-text {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        button {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 1rem;
        }

        button:hover {
            background-color: var(--primary-hover);
        }

        /* Responsive tweak */
        @media (max-width: 480px) {
            .container {
                margin: 20px;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Add New PSP</h2>

        <form method="post" action="/psp-keys/store">
            <div class="form-group">
                <label for="psp_name">PSP Name</label>
                <input type="text" id="psp_name" name="psp_name" placeholder="e.g. Stripe, PayPal" required>
            </div>

            <div class="form-group">
                <label for="api_key">API Key</label>
                <input type="" id="api_key" name="api_key" required>
            </div>

            <div class="form-group">
                <label for="api_secret">API Secret</label>
                <input type="" id="api_secret" name="api_secret" required>
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>
                <input type="number" id="priority" name="priority" value="1">
                <p class="help-text">Lower numbers represent higher routing priority.</p>
            </div>

            <button type="submit">Save Configuration</button>
        </form>
    </div>

</body>

</html> 