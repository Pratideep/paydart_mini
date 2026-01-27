<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSP Configurations</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #10b981;
            --danger: #ef4444;
            --bg: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border: #e5e7eb;
        }

        /* ... Keep your existing styles above ... */

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
                padding: 20px;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }

            /* Force table to not be a table */
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            /* Hide table headers (but keep accessible for screen readers) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 16px;
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: 8px;
                background: white;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50% !important;
                /* Push text to the right */
                text-align: right !important;
                padding: 12px 16px !important;
            }

            /* Label each cell using data-label attribute */
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: 600;
                font-size: 0.7rem;
                text-transform: uppercase;
                color: var(--text-muted);
            }

            td:last-child {
                text-align: center !important;
                padding-left: 16px !important;
                border-top: 1px solid var(--border);
                margin-top: 8px;
            }

            .btn-toggle {
                width: 100%;
                justify-content: center;
                margin-top: 8px;
            }
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
            line-height: 1.5;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            overflow: hidden;
            /* Keeps table corners rounded */
        }

        /* Header Section */
        .header-section {
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
        }

        .header-section h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
            text-decoration: none;
            cursor: pointer;
        }

        /* Refined Primary Button Styles */
        .btn-add {
            background-color: var(--primary);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            /* Space between icon and text */
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            text-decoration: none;
        }

        .btn-add:hover {
            background-color: #4338ca;
            /* Slightly darker indigo */
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.2),
                0 4px 6px -2px rgba(79, 70, 229, 0.1);
        }

        .btn-add:active {
            transform: translateY(0);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        /* Icon styling */
        .btn-add svg {
            width: 18px;
            height: 18px;
            stroke-width: 2.5;
            /* Makes the icon look "bolder" and cleaner */
        }

        .btn-toggle {
            border: 1px solid var(--border);
            color: var(--text-main);
            background: white;
        }

        .btn-toggle:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* Secondary/Ghost Button Style */
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-light);
            /* Uses your existing light text color */
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s;
            margin-bottom: 16px;
            /* Space above the container */
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
            color: var(--text-dark);
        }

        .btn-secondary svg {
            width: 16px;
            height: 16px;
            stroke-width: 2.5;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            padding: 14px 32px;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 18px 32px;
            border-bottom: 1px solid var(--border);
            font-size: 0.9375rem;
            color: var(--text-main);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #fcfdfe;
        }

        /* Status Badges */
        .status-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .active {
            background: #ecfdf5;
            color: #065f46;
        }

        .active::before {
            background: var(--success);
        }

        .inactive {
            background: #fef2f2;
            color: #991b1b;
        }

        .inactive::before {
            background: var(--danger);
        }

        /* Utilities */
        .psp-name {
            font-weight: 600;
            color: var(--primary);
        }

        .date-cell {
            color: var(--text-muted);
            font-variant-numeric: tabular-nums;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        /* Specific Priority Badge Styles */
        .priority-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            text-transform: capitalize;
        }

        /* Priority Levels */
        .priority-high {
            background-color: #fff7ed;
            color: #9a3412;
            border: 1px solid #ffedd5;
        }

        .priority-medium {
            background-color: #f0f9ff;
            color: #075985;
            border: 1px solid #e0f2fe;
        }

        .priority-low {
            background-color: #f8fafc;
            color: #475569;
            border: 1px solid #f1f5f9;
        }

        /* Optional: Add a small star or dot for priority if you like */
        .priority-badge::before {
            content: "•";
            margin-right: 4px;
            font-size: 1.2rem;
            line-height: 0;
        }
    </style>
</head>

<body>
    <a href="/dashboard" class="btn btn-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Back to Dashboard
    </a>

    <div class="container">
    </div>
    <div class="container">
        <div class="header-section">
            <div>
                <h2>Payment Service Providers</h2>
                <p style="margin: 4px 0 0; font-size: 0.875rem; color: var(--text-muted);">
                    Manage your API integration keys and connection status.
                </p>
            </div>
            <a href="/psp-keys/create" class="btn btn-add">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add New PSP
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>PSP Name</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Date Created</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($psps)): ?>
                    <?php foreach ($psps as $index => $psp): ?>
                        <tr>
                            <td data-label="#">
                                <span style="color: var(--text-muted);"><?= $index + 1 ?></span>
                            </td>
                            <td data-label="PSP Name">
                                <span class="psp-name"><?= esc($psp['psp_name']) ?></span>
                            </td>
                            <td data-label="Status">
                                <span class="status-badge <?= strtolower($psp['status']) ?>">
                                    <?= ucfirst($psp['status']) ?>
                                </span>
                            </td>
                            <td data-label="Priority">
                                <?php $prioClass = 'priority-' . strtolower($psp['priority']); ?>
                                <span class="priority-badge <?= $prioClass ?>">
                                    <?= esc($psp['priority']) ?>
                                </span>
                            </td>
                            <td data-label="Date Created" class="date-cell">
                                <?= date('M d, Y', strtotime($psp['created_at'])) ?>
                            </td>
                            <td style="text-align: right;">
                                <a href="/psp-keys/toggle/<?= $psp['id'] ?>" class="btn btn-toggle">
                                    Change Status
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>