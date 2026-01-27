<style>
    :root {
        /* Font Families */
        --font-main: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        --font-mono: 'JetBrains Mono', monospace;

        /* Font Sizes */
        --text-xs: 0.75rem;
        --text-sm: 0.875rem;
        --text-base: 1rem;
        --text-lg: 1.125rem;
        --text-xl: 1.25rem;
        --text-2xl: 1.5rem;
    }

    body {
        font-family: var(--font-main);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        letter-spacing: -0.011em;
        /* Tightens Inter for a cleaner look */
        line-height: 1.6;
    }

    /* Use Mono for technical data like amounts, IDs, and Version numbers */
    .stat-value,
    .amount-cell,
    .version-tag,
    .mono {
        font-family: var(--font-mono);
        letter-spacing: -0.02em;
    }

    h1,
    h2,
    h3,
    h4 {
        font-weight: 700;
        letter-spacing: -0.025em;
        /* Gives headers a modern, bold punch */
        color: #0f172a;
    }

    .brand {
        font-weight: 800;
        letter-spacing: -0.04em;
        text-transform: uppercase;
    }

    .status-badge,
    .gateway-pill {
        font-size: var(--text-xs);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.02em;
    }

    /* Modern Top Navigation */
    .glass-nav {
        background: var(--glass);
        backdrop-filter: blur(10px);
        position: sticky;
        top: 0;
        z-index: 100;
        padding: 12px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid white;
    }

    .search-bar {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 8px 16px;
        border-radius: 99px;
        width: 300px;
        font-size: 0.875rem;
    }

    /* Gateway Health Monitor (Horizontal Scroller) */
    .health-bar {
        display: flex;
        gap: 20px;
        padding: 20px 40px;
        overflow-x: auto;
        white-space: nowrap;
    }

    .gateway-pill {
        background: white;
        padding: 12px 20px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    /* Main Grid: Split Layout */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        /* 2 parts main, 1 part sidebar */
        gap: 30px;
        padding: 0 40px 40px;
    }

    .main-panel {
        background: white;
        border-radius: 24px;
        padding: 32px;
        min-height: 500px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .side-panel {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .action-card {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: white;
        padding: 24px;
        border-radius: 20px;
    }

    .live-feed {
        background: white;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #e2e8f0;
    }

    .feed-item {
        padding: 12px 0;
        border-bottom: 1px solid #f8fafc;
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
    }

    /* Fancy Chart Placeholder */
    .chart-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(to bottom, var(--accent-soft), transparent);
        border-radius: 12px;
        margin-top: 20px;
        border-bottom: 2px solid var(--accent);
    }
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
<nav class="glass-nav">
    <a href="/dashboard">
        <div class="brand">
            <strong>PAYDART</strong> <span style="color: var(--accent);">MINI</span>
        </div>
    </a>

    <input type="text" class="search-bar" placeholder="Search transactions, PSPs, or logs...">
    <div style="display: flex; gap: 15px; align-items: center;">
        <span style="font-size: 0.8rem; font-weight: 600;">Merchant ID: #8821</span>
        <div style="width: 35px; height: 35px; border-radius: 50%; background: #ddd;"></div>
    </div>
</nav>

<div class="health-bar">
    <div class="gateway-pill">
        <span style="color: #10b981;">●</span> <strong>Stripe</strong> <span style="color: #64748b;">99.9% Up</span>
    </div>
    <div class="gateway-pill">
        <span style="color: #10b981;">●</span> <strong>PayPal</strong> <span style="color: #64748b;">98.2% Up</span>
    </div>
    <div class="gateway-pill">
        <span style="color: #f59e0b;">●</span> <strong>Razorpay</strong> <span style="color: #64748b;">Lagging</span>
    </div>
    <div class="gateway-pill">
        <span style="color: #ef4444;">●</span> <strong>Flutterwave</strong> <span style="color: #64748b;">Offline</span>
    </div>
</div>

<div class="dashboard-grid">
    <div class="main-panel">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="margin:0;">Revenue Stream</h2>
            <select style="border:none; background: #f1f5f9; padding: 5px 10px; border-radius: 8px;">
                <option>Last 7 Days</option>
                <option>Last 30 Days</option>
            </select>
        </div>

        <div class="chart-placeholder">
            <div style="padding: 20px; color: var(--accent); font-weight: 600;">Live Volume Metrics</div>
        </div>

        <div style="margin-top: 40px;">
            <h3>Active Configurations</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px 0;">Checkout v3 - Main Store</td>
                    <td style="text-align: right; color: #10b981; font-weight: 600;">Active</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px 0;">API Gateway - Mobile App</td>
                    <td style="text-align: right; color: #10b981; font-weight: 600;">Active</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="side-panel">
        <div class="action-card">
            <h4 style="margin-top:0">Quick Launch</h4>
            <p style="font-size: 0.8rem; opacity: 0.8;">Generate a payment link or check API keys instantly.</p>
            <button style="width: 100%; padding: 12px; border-radius: 10px; border: none; background: var(--accent); color: white; font-weight: 600; cursor: pointer;">+ New Payment Link</button>
        </div>

        <div class="live-feed">
            <h4 style="margin-top:0">Live Event Feed</h4>
            <div class="feed-item">
                <span>Webhook Received</span>
                <span style="color: var(--text-gray);">12:04</span>
            </div>
            <div class="feed-item">
                <span>Payout Scheduled</span>
                <span style="color: var(--text-gray);">11:50</span>
            </div>
            <div class="feed-item">
                <span>New PSP Connected</span>
                <span style="color: var(--text-gray);">09:12</span>
            </div>
            <button style="width: 100%; background: none; border: 1px dashed #cbd5e1; margin-top: 15px; padding: 10px; border-radius: 8px; color: #64748b; font-size: 0.8rem;">View Developer Logs</button>
        </div>
    </div>
</div>