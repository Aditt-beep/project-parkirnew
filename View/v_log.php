<?php
if(!isset($data_log)){
    $data_log = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-w:    220px;
            --navy:         #1e2d3d;
            --navy-dark:    #172232;
            --navy-hover:   #263a50;
            --accent:       #3b82f6;
            --accent-light: #60a5fa;
            --bg:           #f0f4f8;
            --white:        #ffffff;
            --text:         #1a2332;
            --text-sub:     #64748b;
            --border:       #e2e8f0;
            --card-shadow:  0 2px 12px rgba(30,45,61,.08);

            /* Role badge colors */
            --badge-admin-bg:   #ede9fe;
            --badge-admin-text: #7c3aed;
            --badge-petugas-bg: #dbeafe;
            --badge-petugas-text:#2563eb;
            --badge-owner-bg:   #dcfce7;
            --badge-owner-text: #16a34a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* ══ TOP BAR ══ */
        .topbar {
            position: fixed;
            top: 0; left: var(--sidebar-w); right: 0;
            height: 56px;
            background: var(--accent);
            display: flex; align-items: center;
            padding: 0 32px;
            z-index: 90;
            box-shadow: 0 2px 8px rgba(59,130,246,.25);
        }
        .topbar-title {
            font-size: 1rem; font-weight: 700; color: #fff;
            letter-spacing: .02em;
        }

        /* ══ SIDEBAR ══ */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--navy);
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 0 20px;
            height: 56px;
            background: var(--accent);
            display: flex; align-items: center; gap: 10px;
            flex-shrink: 0;
        }
        .brand-icon {
            width: 32px; height: 32px;
            background: rgba(255,255,255,.2);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .brand-icon svg { width: 18px; height: 18px; color: #fff; }
        .brand-name { font-size: .9rem; font-weight: 800; color: #fff; }

        .sidebar-label {
            padding: 18px 20px 6px;
            font-size: .62rem; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: rgba(255,255,255,.3);
        }

        .sidebar nav { flex: 1; overflow-y: auto; padding-bottom: 12px; }
        .sidebar nav ul { list-style: none; padding: 0 10px; }

        .sidebar nav ul li a {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 8px;
            color: rgba(255,255,255,.6); text-decoration: none;
            font-size: .83rem; font-weight: 500;
            transition: background .2s, color .2s; margin-bottom: 2px;
        }
        .sidebar nav ul li a svg { width: 16px; height: 16px; flex-shrink: 0; opacity: .7; transition: opacity .2s; }
        .sidebar nav ul li a:hover { background: var(--navy-hover); color: #fff; }
        .sidebar nav ul li a:hover svg { opacity: 1; }
        .sidebar nav ul li a.active { background: var(--accent); color: #fff; box-shadow: 0 3px 10px rgba(59,130,246,.35); }
        .sidebar nav ul li a.active svg { opacity: 1; }

        .sidebar-footer { padding: 10px; border-top: 1px solid rgba(255,255,255,.07); }
        .sidebar-footer a {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 8px;
            color: rgba(255,100,100,.75); text-decoration: none;
            font-size: .83rem; font-weight: 600; transition: background .2s, color .2s;
        }
        .sidebar-footer a svg { width: 16px; height: 16px; }
        .sidebar-footer a:hover { background: rgba(255,80,80,.1); color: #ff6b6b; }

        /* ══ CONTENT ══ */
        .content {
            margin-left: var(--sidebar-w);
            padding-top: 56px; /* topbar height */
            flex: 1; padding-left: 32px; padding-right: 32px; padding-bottom: 32px;
            animation: fadeIn .35s ease both;
        }
        /* override shorthand ordering issue */
        .content { padding: 88px 32px 32px; margin-left: var(--sidebar-w); flex: 1; animation: fadeIn .35s ease both; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .page-header {
            display: flex; align-items: flex-start;
            justify-content: space-between; margin-bottom: 24px;
        }
        .page-header h1 { font-size: 1.4rem; font-weight: 800; }
        .page-header p  { font-size: .82rem; color: var(--text-sub); margin-top: 3px; }

        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 16px; border-radius: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: .83rem; font-weight: 600;
            text-decoration: none; cursor: pointer; border: none;
            transition: transform .15s, box-shadow .2s;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn svg { width: 15px; height: 15px; }
        .btn-back {
            background: var(--white); color: var(--text);
            border: 1.5px solid var(--border); box-shadow: var(--card-shadow);
        }
        .btn-back:hover { border-color: var(--accent); color: var(--accent); }

        /* summary pills */
        .summary-bar { display: flex; gap: 14px; margin-bottom: 22px; }
        .summary-pill {
            background: var(--white); border-radius: 12px;
            padding: 14px 18px; display: flex; align-items: center; gap: 10px;
            box-shadow: var(--card-shadow);
        }
        .pill-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .pill-icon svg { width: 17px; height: 17px; }
        .pill-icon.purple { background: rgba(124,58,237,.12); color: #7c3aed; }
        .pill-icon.blue   { background: rgba(37,99,235,.12);  color: #2563eb; }
        .pill-val { font-size: 1.2rem; font-weight: 800; line-height: 1; }
        .pill-lbl { font-size: .7rem; color: var(--text-sub); font-weight: 500; margin-top: 2px; }

        /* card + table */
        .card { background: var(--white); border-radius: 14px; box-shadow: var(--card-shadow); overflow: hidden; }

        table { width: 100%; border-collapse: collapse; font-size: .875rem; }

        thead tr { background: var(--navy); color: #fff; }
        thead th {
            padding: 13px 20px; font-weight: 600;
            font-size: .75rem; letter-spacing: .06em;
            text-transform: uppercase; text-align: left;
        }
        thead th.center { text-align: center; width: 70px; }

        tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f5f8ff; }

        tbody td { padding: 13px 20px; }
        tbody td.num { text-align: center; color: var(--text-sub); font-weight: 600; font-size: .8rem; }

        /* user cell */
        .user-cell { display: flex; align-items: center; gap: 10px; }
        .mini-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--accent); color: #fff;
            font-size: .72rem; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            text-transform: uppercase; flex-shrink: 0;
        }
        .username-text { font-weight: 600; font-size: .875rem; }

        /* role badge */
        .badge {
            display: inline-flex; align-items: center;
            padding: 4px 12px; border-radius: 20px;
            font-size: .73rem; font-weight: 600; letter-spacing: .01em;
        }
        .badge.admin   { background: var(--badge-admin-bg);   color: var(--badge-admin-text); }
        .badge.petugas { background: var(--badge-petugas-bg); color: var(--badge-petugas-text); }
        .badge.owner   { background: var(--badge-owner-bg);   color: var(--badge-owner-text); }

        /* status badge */
        .status-badge {
            display: inline-flex; align-items: center;
            padding: 4px 12px; border-radius: 20px;
            font-size: .73rem; font-weight: 600;
            background: #dcfce7; color: #16a34a;
        }

        /* time cell */
        .time-cell { display: flex; align-items: center; gap: 8px; color: var(--text-sub); font-size: .85rem; }
        .time-cell svg { width: 14px; height: 14px; flex-shrink: 0; opacity: .55; }
        .time-date { font-weight: 700; color: var(--text); margin-right: 4px; }

        /* action btn */
        .btn-update {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 6px 14px; border-radius: 8px;
            background: #fff8ed; color: #d97706;
            border: 1.5px solid #fde68a;
            font-size: .78rem; font-weight: 600; text-decoration: none;
            transition: background .15s;
        }
        .btn-update:hover { background: #fef3c7; }
        .btn-update svg { width: 13px; height: 13px; }

        /* empty */
        .empty-state { padding: 60px 20px; text-align: center; color: var(--text-sub); }
        .empty-state svg { width: 44px; height: 44px; opacity: .25; margin-bottom: 12px; display: block; margin-left: auto; margin-right: auto; }
        .empty-state p { font-size: .875rem; }
    </style>
</head>
<body>

<!-- ══ SIDEBAR ══ -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            </svg>
        </div>
        <div class="brand-name">My Menu</div>
    </div>

    <nav>
        <div class="sidebar-label">Menu Utama</div>
        <ul>
            <li><a href="v_homeadmin.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>Dashboard
            </a></li>
            <li><a href="../View/v_tampil_data_user.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M21 21v-2a4 4 0 0 0-3-3.85"/>
                </svg>Data User
            </a></li>
            <li><a href="../View/v_tampil_data_kendaraan.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 17H3v-5l2-5h14l2 5v5h-2"/>
                    <circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/>
                    <path d="M5 12h14"/>
                </svg>Data Kendaraan
            </a></li>
            <li><a href="../View/v_tampil_data_tarif.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M14.5 9a2.5 2.5 0 0 0-5 0v6a2.5 2.5 0 0 0 5 0"/><line x1="9.5" y1="12" x2="14.5" y2="12"/>
                </svg>Data Tarif
            </a></li>
            <li><a href="../View/v_tampil_data_area.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                    <circle cx="12" cy="9" r="2.5"/>
                </svg>Area Parkir
            </a></li>
            <li><a href="../Controller/c_log.php?aksi=tampil" class="active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>Log Aktivitas
            </a></li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <a href="../Controller/c_logout.php">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Logout
        </a>
    </div>
</div>

<!-- ══ TOP BAR ══ -->
<div class="topbar">
    <span class="topbar-title">Log Aktivitas</span>
</div>

<!-- ══ CONTENT ══ -->
<div class="content">

    <div class="page-header">
        <div>
            <h1>Log Aktivitas</h1>
            <p>Riwayat semua aktivitas login pengguna sistem</p>
        </div>
        <a href="../View/v_homeadmin.php" class="btn btn-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Summary pills -->
    <div class="summary-bar">
        <div class="summary-pill">
            <div class="pill-icon purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
            </div>
            <div>
                <div class="pill-val"><?= count($data_log) ?></div>
                <div class="pill-lbl">Total Log</div>
            </div>
        </div>
        <?php
            $unik = !empty($data_log) ? count(array_unique(array_column($data_log, 'username'))) : 0;
        ?>
        <div class="summary-pill">
            <div class="pill-icon blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                </svg>
            </div>
            <div>
                <div class="pill-val"><?= $unik ?></div>
                <div class="pill-lbl">User Aktif</div>
            </div>
        </div>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th class="center">No</th>
                    <th>Username</th>
                    <th>Waktu Login</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($data_log)): ?>
                <?php $no = 1; foreach($data_log as $row): ?>
                <tr>
                    <td class="num"><?= $no++ ?></td>
                    <td>
                        <div class="user-cell">
                            <div class="mini-avatar"><?= strtoupper(substr($row['username'], 0, 1)) ?></div>
                            <span class="username-text"><?= htmlspecialchars($row['username']) ?></span>
                        </div>
                    </td>
                    <td>
                        <?php
                            $waktu = $row['waktu_aktivitas'] ?? '';
                            $parts = explode(' ', $waktu);
                            $tgl   = $parts[0] ?? $waktu;
                            $jam   = $parts[1] ?? '';
                        ?>
                        <div class="time-cell">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <span><span class="time-date"><?= htmlspecialchars($tgl) ?></span><?= htmlspecialchars($jam) ?></span>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                            <p>Belum ada aktivitas login tercatat</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>