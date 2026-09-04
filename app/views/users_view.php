<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$user_count = is_array($users) ? count($users) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List — LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --lava: #dd4814;
            --lava-dim: #b83a10;
            --lava-glow: rgba(221, 72, 20, 0.18);
            --bg: #0a0a0b;
            --bg2: #111113;
            --bg3: #18181b;
            --surface: #1c1c1f;
            --border: rgba(255, 255, 255, 0.08);
            --border-hot: rgba(221, 72, 20, 0.35);
            --text: #f4f4f5;
            --text-muted: #71717a;
            --text-dim: #52525b;
        }

        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            line-height: 1.5;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 10% -10%, rgba(221, 72, 20, 0.14), transparent),
                radial-gradient(ellipse 50% 40% at 90% 100%, rgba(221, 72, 20, 0.08), transparent);
            pointer-events: none;
            z-index: 0;
        }

        .page {
            position: relative;
            z-index: 1;
            max-width: 960px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 3rem;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover { color: var(--lava); }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(221, 72, 20, 0.12);
            border: 1px solid var(--border-hot);
            color: #f97316;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
        }

        .badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--lava);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--lava);
        }

        .header {
            margin-bottom: 1.75rem;
        }

        .header h1 {
            font-size: clamp(1.75rem, 4vw, 2.25rem);
            font-weight: 700;
            letter-spacing: -0.03em;
            margin-bottom: 0.35rem;
        }

        .header h1 span { color: var(--lava); }

        .header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.35);
        }

        .card-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            background: var(--surface);
        }

        .card-toolbar .count {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .card-toolbar .count strong {
            color: var(--text);
            font-weight: 600;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        thead th {
            text-align: left;
            padding: 0.85rem 1.25rem;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-dim);
            background: var(--bg3);
            border-bottom: 1px solid var(--border);
        }

        tbody tr {
            transition: background 0.15s;
        }

        tbody tr:hover {
            background: rgba(221, 72, 20, 0.05);
        }

        tbody tr:not(:last-child) td {
            border-bottom: 1px solid var(--border);
        }

        tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--lava), var(--lava-dim));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 4px 12px var(--lava-glow);
        }

        .user-name {
            font-weight: 600;
            color: var(--text);
        }

        .user-id {
            color: var(--text-dim);
            font-size: 0.8rem;
            font-variant-numeric: tabular-nums;
        }

        .email {
            color: var(--text-muted);
        }

        .username {
            display: inline-block;
            padding: 0.25rem 0.6rem;
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 0.82rem;
            color: #a1a1aa;
            font-family: ui-monospace, monospace;
        }

        .empty-state {
            padding: 3.5rem 1.5rem;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-state .icon {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
            opacity: 0.5;
        }

        footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.8rem;
            color: var(--text-dim);
        }

        footer a {
            color: var(--lava);
            text-decoration: none;
        }

        footer a:hover { text-decoration: underline; }

        @media (max-width: 640px) {
            thead { display: none; }

            tbody tr {
                display: block;
                padding: 1rem 1.25rem;
                border-bottom: 1px solid var(--border);
            }

            tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.4rem 0;
                border: none;
            }

            tbody td::before {
                content: attr(data-label);
                font-size: 0.72rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: var(--text-dim);
            }

            .user-cell { justify-content: flex-end; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="top-bar">
            <a class="back-link" href="<?= rtrim(BASE_URL, '/') ?>/">← Back to Home</a>
            <span class="badge">User Module</span>
        </div>

        <header class="header">
            <h1>User <span>Management</span></h1>
            <p>View and manage registered users in the system.</p>
        </header>

        <div class="card">
            <div class="card-toolbar">
                <span class="count"><strong><?= html_escape((string) $user_count) ?></strong> user<?= $user_count === 1 ? '' : 's' ?> found</span>
            </div>

            <?php if ($user_count > 0): ?>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <?php
                            $initials = strtoupper(
                                mb_substr($user['firstname'], 0, 1) . mb_substr($user['lastname'], 0, 1)
                            );
                            $full_name = html_escape($user['firstname'] . ' ' . $user['lastname']);
                        ?>
                        <tr>
                            <td data-label="User">
                                <div class="user-cell">
                                    <div class="avatar"><?= html_escape($initials) ?></div>
                                    <div>
                                        <div class="user-name"><?= $full_name ?></div>
                                        <div class="user-id">ID #<?= html_escape($user['id']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="email" data-label="Email"><?= html_escape($user['email']) ?></td>
                            <td data-label="Username"><span class="username">@<?= html_escape($user['username']) ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <div class="icon">👤</div>
                <p>No users found in the database.</p>
            </div>
            <?php endif; ?>
        </div>

        <footer>
            Powered by <a href="https://github.com/ronmarasigan/LavaLust" target="_blank">LavaLust</a>
        </footer>
    </div>
</body>
</html>
