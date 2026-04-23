<?php
session_start();

if (!isset($_SESSION['data']) || strtolower($_SESSION['data']['role']) != 'owner') {
    header("Location: ../View/v_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - Parkir</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #f0f4f8;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 46px;
            background: #2980b9;
            display: flex;
            align-items: center;
            padding: 0 20px 0 240px;
            z-index: 100;
            border-bottom: 2px solid #1a6fa0;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 600;
            color: #ffffff;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: #2c3e50;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 200;
        }

        .sidebar-brand {
            background: #1a252f;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            height: 46px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .brand-icon {
            width: 28px;
            height: 28px;
            background: #2980b9;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon svg {
            width: 16px; height: 16px;
            stroke: #fff; fill: none;
            stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
        }

        .brand-text {
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
        }

        .sidebar-section {
            padding: 16px 0 4px;
        }

        .sidebar-label {
            font-size: 10px;
            color: rgba(255,255,255,0.3);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0 18px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 13px;
            border-left: 3px solid transparent;
            transition: all 0.15s;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.9);
        }

        .nav-item.active {
            background: rgba(41,128,185,0.22);
            color: #ffffff;
            border-left-color: #2980b9;
        }

        .nav-item svg {
            width: 16px; height: 16px;
            flex-shrink: 0;
            stroke: currentColor; fill: none;
            stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
        }

        .sidebar-logout {
            margin-top: auto;
            padding: 14px 0;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .nav-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            color: #e74c3c;
            text-decoration: none;
            font-size: 13px;
            transition: background 0.15s;
        }

        .nav-logout:hover { background: rgba(231,76,60,0.1); }

        .nav-logout svg {
            width: 16px; height: 16px;
            stroke: currentColor; fill: none;
            stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
        }

        /* ===== MAIN ===== */
        .main {
            margin-left: 220px;
            padding-top: 46px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .content {
            padding: 28px 30px;
            flex: 1;
        }

        /* ===== WELCOME BANNER ===== */
        .welcome-banner {
            background: #2980b9;
            border-radius: 12px;
            padding: 22px 28px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .welcome-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }

        .welcome-text h2 {
            font-size: 17px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .welcome-text p {
            font-size: 13px;
            color: rgba(255,255,255,0.8);
        }

        /* ===== SECTION TITLE ===== */
        .page-section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .page-section-sub {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 22px;
        }

        /* ===== STAT CARDS ===== */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: box-shadow 0.15s;
        }

        .stat-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.07); }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg {
            width: 20px; height: 20px;
            stroke: currentColor; fill: none;
            stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
        }

        .stat-icon.blue   { background: #eff6ff; color: #2563eb; }
        .stat-icon.green  { background: #f0fdf4; color: #16a34a; }
        .stat-icon.purple { background: #f5f3ff; color: #7c3aed; }

        .stat-info .label {
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .stat-info .value {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
        }

        /* ===== INFO CARD ===== */
        .info-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .info-card-header {
            padding: 16px 22px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card-header svg {
            width: 16px; height: 16px;
            stroke: #2980b9; fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }

        .info-card-header h3 {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        .info-card-body {
            padding: 20px 22px;
        }

        .info-card-body p {
            font-size: 13px;
            color: #475569;
            line-height: 1.7;
            margin-bottom: 14px;
        }

        .info-list {
            list-style: none;
            padding: 0;
        }

        .info-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            color: #475569;
            padding: 6px 0;
        }

        .info-list li::before {
            content: '';
            width: 18px;
            height: 18px;
            background: #2980b9;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 1px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 10px;
        }

        /* ===== QUICK LINKS ===== */
        .quick-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .quick-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #2980b9;
            color: #ffffff;
            text-decoration: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            transition: background 0.15s;
        }

        .quick-btn:hover { background: #1f6fa0; }

        .quick-btn svg {
            width: 15px; height: 15px;
            stroke: #fff; fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }

        .quick-btn.outline {
            background: transparent;
            color: #2980b9;
            border: 1px solid #2980b9;
        }

        .quick-btn.outline:hover { background: #eff6ff; }
        .quick-btn.outline svg { stroke: #2980b9; }

        /* ===== FOOTER ===== */
        .footer {
            background: #2980b9;
            text-align: center;
            padding: 14px;
            font-size: 12px;
            color: rgba(255,255,255,0.85);
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <span class="topbar-title">Beranda Owner</span>
</div>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24"><rect x="2" y="10" width="20" height="9" rx="2"/><path d="M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3"/><circle cx="7" cy="19" r="1"/><circle cx="17" cy="19" r="1"/></svg>
        </div>
        <span class="brand-text">My Menu</span>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Menu</div>

        <a href="v_homeowner.php" class="nav-item active">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Beranda
        </a>

        <a href="../Controller/c_laporan.php" class="nav-item">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/></svg>
            Laporan
        </a>
    </div>

    <div class="sidebar-logout">
        <a href="../Controller/c_logout.php" class="nav-logout">
            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            Logout
        </a>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <div class="content">

        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-avatar">
                <?= strtoupper(substr($_SESSION['data']['username'], 0, 1)); ?>
            </div>
            <div class="welcome-text">
                <h2>Halo, <?= htmlspecialchars($_SESSION['data']['username']); ?>! 👋</h2>
                <p>Kamu login sebagai Owner. Pantau laporan dan kinerja parkir dari sini.</p>
            </div>
        </div>

        <!-- Section Title -->
        <div class="page-section-title">Selamat Datang di Portal Owner</div>
        <div class="page-section-sub">Gunakan menu di samping untuk memantau laporan sistem parkir.</div>
        <!-- Quick Links -->
        <div class="info-card">
            <div class="info-card-header">
                <svg viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
                <h3>Akses Cepat</h3>
            </div>
            <div class="info-card-body">
                <div class="quick-links">
                    <a href="../Controller/c_laporan.php" class="quick-btn">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Lihat Laporan
                    </a>
                </div>
            </div>
        </div>

    </div>


</body>
</html>