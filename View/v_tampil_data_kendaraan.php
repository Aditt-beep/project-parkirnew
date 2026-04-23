<?php
include_once '../Controller/c_kendaraan.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Kendaraan - Parkir</title>
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
        width: 28px; height: 28px;
        background: #2980b9;
        border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
    }

    .brand-icon svg {
        width: 16px; height: 16px;
        stroke: #fff; fill: none;
        stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
    }

    .brand-text { font-size: 14px; font-weight: 600; color: #ffffff; }

    .sidebar-section { padding: 16px 0 4px; }

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

    .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.9); }

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

    .content { padding: 28px 30px; flex: 1; }

    /* ===== PAGE HEADER ===== */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .page-header h1 { font-size: 20px; font-weight: 600; color: #1e293b; }
    .page-header p  { font-size: 13px; color: #64748b; margin-top: 2px; }

    .header-actions { display: flex; align-items: center; gap: 8px; }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        transition: all 0.15s;
    }

    .btn-back:hover { background: #f1f5f9; color: #334155; }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #2980b9;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        transition: background 0.15s;
    }

    .btn-add:hover { background: #1f6fa0; }

    .btn-back svg, .btn-add svg {
        width: 14px; height: 14px;
        stroke: currentColor; fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    }

    /* ===== CARD & TABLE ===== */
    .card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    table { width: 100%; border-collapse: collapse; }

    thead th {
        font-size: 11px;
        font-weight: 600;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        padding: 12px 16px;
        background: #2c3e50;
        text-align: center;
    }

    tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.12s;
    }

    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #f8fbff; }

    tbody td {
        padding: 13px 16px;
        font-size: 13px;
        color: #334155;
        text-align: center;
        vertical-align: middle;
    }

    /* Plat nomor */
    .plat {
        display: inline-block;
        background: #2c3e50;
        color: #fff;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.06em;
    }

    /* Jenis badge */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge svg {
        width: 12px; height: 12px;
        stroke: currentColor; fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    }

    .badge-motor { background: rgba(37,99,235,0.1);  color: #2563eb; }
    .badge-mobil { background: rgba(5,150,105,0.1);  color: #059669; }
    .badge-truk  { background: rgba(234,88,12,0.1);  color: #ea580c; }

    /* Warna dot */
    .warna-cell { display: flex; align-items: center; justify-content: center; gap: 7px; }
    .warna-dot  { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; border: 1.5px solid rgba(0,0,0,0.1); }

    /* ===== AKSI ===== */
    .aksi-wrap { display: flex; justify-content: center; gap: 6px; }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(234,179,8,0.1);
        color: #b45309;
        border: 1px solid rgba(234,179,8,0.3);
        border-radius: 6px;
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        transition: all 0.15s;
    }

    .btn-edit:hover { background: rgba(234,179,8,0.18); }

    .btn-hapus {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(220,38,38,0.07);
        color: #dc2626;
        border: 1px solid rgba(220,38,38,0.2);
        border-radius: 6px;
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        transition: all 0.15s;
    }

    .btn-hapus:hover { background: rgba(220,38,38,0.13); }

    .btn-edit svg, .btn-hapus svg {
        width: 13px; height: 13px;
        stroke: currentColor; fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        padding: 52px 20px;
        text-align: center;
        color: #94a3b8;
        font-size: 13px;
    }

    .empty-state svg {
        width: 40px; height: 40px;
        stroke: #cbd5e1; fill: none;
        stroke-width: 1.5;
        margin-bottom: 12px;
    }

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
    <span class="topbar-title">Data Kendaraan</span>
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
        <div class="sidebar-label">Menu Utama</div>

        <a href="v_homeadmin.php" class="nav-item">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>

        <a href="../View/v_tampil_data_user.php" class="nav-item">
            <svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/><path d="M19 8v6m-3-3h6"/></svg>
            Data User
        </a>

        <a href="../View/v_tampil_data_kendaraan.php" class="nav-item active">
            <svg viewBox="0 0 24 24"><path d="M5 17H3v-5l2-5h14l2 5v5h-2"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/><path d="M5 12h14"/></svg>
            Data Kendaraan
        </a>

        <a href="../View/v_tampil_data_tarif.php" class="nav-item">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 6v6l4 2"/></svg>
            Data Tarif
        </a>

        <a href="../View/v_tampil_data_area.php" class="nav-item">
            <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Area Parkir
        </a>

        <a href="../Controller/c_log.php?aksi=tampil" class="nav-item">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            Log Aktivitas
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

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Daftar Kendaraan</h1>
                <p>Kelola semua data kendaraan terdaftar</p>
            </div>
            <div class="header-actions">
                <a href="v_homeadmin.php" class="btn-back">
                    <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                    Kembali
                </a>
                <a href="v_tambah_data_kendaraan.php" class="btn-add">
                    <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Kendaraan
                </a>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Plat Nomor</th>
                        <th>Jenis Kendaraan</th>
                        <th>Warna</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($kendaraans)): ?>
                    <?php foreach ($kendaraans as $row): ?>
                        <?php
                            $warnaMap = [
                                'hitam'   => '#1a1a1a',
                                'putih'   => '#e8e8e8',
                                'merah'   => '#ef4444',
                                'biru'    => '#3b82f6',
                                'abu'     => '#9ca3af',
                                'abu-abu' => '#9ca3af',
                                'hijau'   => '#22c55e',
                                'kuning'  => '#eab308',
                                'silver'  => '#cbd5e1',
                                'orange'  => '#f97316',
                                'coklat'  => '#92400e',
                            ];
                            $warnaLower = strtolower(trim($row['warna']));
                            $dotColor   = $warnaMap[$warnaLower] ?? '#94a3b8';
                            $jenis      = strtolower($row['jenis_kendaraan']);
                        ?>
                        <tr>
                            <td><span class="plat"><?= htmlspecialchars($row['plat_nomor']) ?></span></td>
                            <td>
                                <span class="badge badge-<?= $jenis ?>">
                                    <?php if ($jenis === 'motor'): ?>
                                        <svg viewBox="0 0 24 24"><circle cx="5.5" cy="17.5" r="2.5"/><circle cx="18.5" cy="17.5" r="2.5"/><path d="M15 6h-3l-2 5H5.5"/><path d="M9 11l1.5-5H15l2 4h2"/></svg>
                                    <?php else: ?>
                                        <svg viewBox="0 0 24 24"><path d="M5 17H3v-5l2-5h14l2 5v5h-2"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/></svg>
                                    <?php endif; ?>
                                    <?= ucfirst($row['jenis_kendaraan']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="warna-cell">
                                    <span class="warna-dot" style="background:<?= $dotColor ?>"></span>
                                    <?= htmlspecialchars(ucfirst($row['warna'])) ?>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($row['pemilik']) ?></td>
                            <td>
                                <div class="aksi-wrap">
                                    <a href="../Controller/c_kendaraan.php?aksi=edit&id_kendaraan=<?= $row['id_kendaraan'] ?>" class="btn-edit">
                                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Update
                                    </a>
                                    <a href="../Controller/c_kendaraan.php?aksi=hapus&id_kendaraan=<?= $row['id_kendaraan'] ?>"
                                       onclick="return confirm('Yakin hapus data ini?')"
                                       class="btn-hapus">
                                        <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <svg viewBox="0 0 24 24"><path d="M5 17H3v-5l2-5h14l2 5v5h-2"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/></svg>
                                <p>Tidak ada data kendaraan</p>
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