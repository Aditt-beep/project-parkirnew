<?php
include_once '../Controller/c_tarif.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Tarif Parkir</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --sidebar-w:   220px;
    --navy:        #1e2d3d;
    --navy-dark:   #172232;
    --navy-hover:  #263a50;
    --accent:      #3b82f6;
    --bg:          #f0f4f8;
    --white:       #ffffff;
    --text:        #1a2332;
    --text-sub:    #64748b;
    --border:      #e2e8f0;
    --shadow:      0 2px 12px rgba(30,45,61,.08);
  }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    display: flex;
    min-height: 100vh;
  }

  /* ===== SIDEBAR ===== */
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
    height: 56px;
    padding: 0 20px;
    background: var(--accent);
    display: flex; align-items: center; gap: 10px;
    flex-shrink: 0;
  }
  .brand-icon {
    width: 32px; height: 32px;
    background: rgba(255,255,255,.2);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
  }
  .brand-icon svg { width: 18px; height: 18px; color: #fff; }
  .brand-name { font-size: .9rem; font-weight: 800; color: #fff; }

  .sidebar-label {
    padding: 18px 20px 6px;
    font-size: .62rem; font-weight: 700;
    letter-spacing: .1em; text-transform: uppercase;
    color: rgba(255,255,255,.3);
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
  .sidebar nav ul li a svg { width: 16px; height: 16px; flex-shrink: 0; opacity: .7; }
  .sidebar nav ul li a:hover { background: var(--navy-hover); color: #fff; }
  .sidebar nav ul li a:hover svg { opacity: 1; }
  .sidebar nav ul li a.active {
    background: var(--accent); color: #fff;
    box-shadow: 0 3px 10px rgba(59,130,246,.35);
  }
  .sidebar nav ul li a.active svg { opacity: 1; }

  .sidebar-footer {
    padding: 10px;
    border-top: 1px solid rgba(255,255,255,.07);
  }
  .sidebar-footer a {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px; border-radius: 8px;
    color: rgba(255,100,100,.75); text-decoration: none;
    font-size: .83rem; font-weight: 600;
    transition: background .2s, color .2s;
  }
  .sidebar-footer a svg { width: 16px; height: 16px; }
  .sidebar-footer a:hover { background: rgba(255,80,80,.1); color: #ff6b6b; }

  /* ===== TOPBAR ===== */
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
  .topbar-title { font-size: 1rem; font-weight: 700; color: #fff; }

  /* ===== CONTENT ===== */
  .content {
    margin-left: var(--sidebar-w);
    padding: 88px 32px 32px;
    flex: 1;
    animation: fadeIn .35s ease both;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .page-header {
    display: flex; justify-content: space-between; align-items: flex-start;
    margin-bottom: 26px;
  }
  .page-header h1 { font-size: 1.4rem; font-weight: 800; }
  .page-header p  { font-size: .82rem; color: var(--text-sub); margin-top: 3px; }

  /* ===== ALERT ===== */
  .alert {
    padding: 12px 16px; border-radius: 10px;
    font-size: .83rem; margin-bottom: 18px;
    display: flex; align-items: center; gap: 8px;
  }
  .alert-success { background: rgba(16,185,129,.08); color: #065f46; border: 1px solid rgba(16,185,129,.22); }
  .alert-error   { background: rgba(239,68,68,.07);  color: #991b1b; border: 1px solid rgba(239,68,68,.2); }

  /* ===== CARD ===== */
  .card { background: var(--white); border-radius: 14px; box-shadow: var(--shadow); overflow: hidden; }

  .card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 24px;
    border-bottom: 1px solid var(--border);
  }
  .card-header h2 { font-size: .95rem; font-weight: 700; }
  .header-actions { display: flex; gap: 8px; align-items: center; }

  .btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 16px; border-radius: 8px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: .83rem; font-weight: 600;
    text-decoration: none; cursor: pointer; border: none;
    transition: transform .15s, background .15s;
  }
  .btn:hover { transform: translateY(-1px); }
  .btn svg { width: 14px; height: 14px; }

  .btn-back {
    background: var(--white); color: var(--text);
    border: 1.5px solid var(--border); box-shadow: var(--shadow);
  }
  .btn-back:hover { border-color: var(--accent); color: var(--accent); }

  .btn-add {
    background: var(--accent); color: #fff;
    box-shadow: 0 3px 10px rgba(59,130,246,.3);
  }
  .btn-add:hover { background: #2563eb; }

  /* ===== TABLE ===== */
  table { width: 100%; border-collapse: collapse; font-size: .875rem; }

  thead tr { background: var(--navy); color: #fff; }
  thead th {
    padding: 13px 24px; font-weight: 600;
    font-size: .75rem; letter-spacing: .06em;
    text-transform: uppercase; text-align: left;
  }
  thead th.center { text-align: center; }

  tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
  tbody tr:last-child { border-bottom: none; }
  tbody tr:hover { background: #f5f8ff; }

  tbody td { padding: 13px 24px; vertical-align: middle; }
  tbody td.center { text-align: center; }
  tbody td.num { color: var(--text-sub); font-weight: 600; font-size: .8rem; width: 60px; }

  .jenis-wrap { display: flex; align-items: center; gap: 9px; font-weight: 500; }
  .dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }

  .tarif-val  { font-weight: 700; color: var(--text); font-size: .9rem; }
  .tarif-note { font-size: .72rem; color: var(--text-sub); margin-top: 2px; }

  .aksi-wrap { display: flex; justify-content: center; gap: 7px; }

  .btn-update {
    display: inline-flex; align-items: center;
    padding: 6px 14px; border-radius: 7px;
    background: #fff8ed; color: #d97706;
    border: 1.5px solid #fde68a;
    font-size: .78rem; font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    text-decoration: none; cursor: pointer;
    transition: background .15s;
  }
  .btn-update:hover { background: #fef3c7; }

  .btn-hapus {
    display: inline-flex; align-items: center;
    padding: 6px 14px; border-radius: 7px;
    background: rgba(239,68,68,.07); color: #dc2626;
    border: 1.5px solid rgba(239,68,68,.22);
    font-size: .78rem; font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    text-decoration: none; cursor: pointer;
    transition: background .15s;
  }
  .btn-hapus:hover { background: rgba(239,68,68,.13); }

  .empty-state { text-align: center; padding: 56px 20px; color: var(--text-sub); }
  .empty-state svg { width: 44px; height: 44px; opacity: .25; display: block; margin: 0 auto 12px; }
  .empty-state p { font-size: .875rem; }
</style>
</head>
<body>

<!-- ===== SIDEBAR ===== -->
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
      <li><a href="v_tampil_data_user.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M21 21v-2a4 4 0 0 0-3-3.85"/>
        </svg>Data User
      </a></li>
      <li><a href="v_tampil_data_kendaraan.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 17H3v-5l2-5h14l2 5v5h-2"/>
          <circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/>
          <path d="M5 12h14"/>
        </svg>Data Kendaraan
      </a></li>
      <li><a href="v_tampil_data_tarif.php" class="active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="9"/>
          <path d="M14.5 9a2.5 2.5 0 0 0-5 0v6a2.5 2.5 0 0 0 5 0"/>
          <line x1="9.5" y1="12" x2="14.5" y2="12"/>
        </svg>Data Tarif
      </a></li>
      <li><a href="v_tampil_data_area.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
          <circle cx="12" cy="9" r="2.5"/>
        </svg>Area Parkir
      </a></li>
      <li><a href="../Controller/c_log.php?aksi=tampil">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/>
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

<!-- ===== TOPBAR ===== -->
<div class="topbar">
  <span class="topbar-title">Data Tarif</span>
</div>

<!-- ===== CONTENT ===== -->
<div class="content">

  <div class="page-header">
    <div>
      <h1>Data Tarif Parkir</h1>
      <p>Kelola tarif parkir berdasarkan jenis kendaraan</p>
    </div>
  </div>

  <?php if (!empty($_SESSION['pesan'])): ?>
    <div class="alert alert-success">✓ <?= htmlspecialchars($_SESSION['pesan']) ?></div>
    <?php unset($_SESSION['pesan']); ?>
  <?php endif; ?>
  <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-error">✕ <?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <div class="card">
    <div class="card-header">
      <h2>Daftar Tarif</h2>
      <div class="header-actions">
        <a href="v_homeadmin.php" class="btn btn-back">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
          Kembali
        </a>
        <a href="v_tambah_data_tarif.php" class="btn btn-add">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
          Tambah Tarif
        </a>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th style="width:60px">No</th>
          <th>Jenis Kendaraan</th>
          <th>Tarif / Jam</th>
          <th class="center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $dot_map      = ['mobil'=>'#8b5cf6','motor'=>'#3b82f6','lainnya'=>'#f59e0b'];
        $dot_fallback = ['#10b981','#f43f5e','#06b6d4','#ec4899'];
        ?>
        <?php if (!empty($data_tarif)): ?>
          <?php $no = 1; $fi = 0; foreach ($data_tarif as $row): ?>
          <?php
            $jenis     = strtolower(trim($row['jenis_kendaraan']));
            $dot_color = $dot_map[$jenis] ?? $dot_fallback[$fi++ % count($dot_fallback)];
          ?>
          <tr>
            <td class="num"><?= $no++ ?></td>
            <td>
              <div class="jenis-wrap">
                <span class="dot" style="background:<?= $dot_color ?>"></span>
                <?= htmlspecialchars($row['jenis_kendaraan']) ?>
              </div>
            </td>
            <td>
              <div class="tarif-val">Rp <?= number_format($row['tarif_per_jam'], 0, ',', '.') ?></div>
              <div class="tarif-note">per jam parkir</div>
            </td>
            <td class="center">
              <div class="aksi-wrap">
                <a href="../Controller/c_tarif.php?aksi=edit&id_tarif=<?= $row['id_tarif'] ?>" class="btn-update">Update</a>
                <a href="../Controller/c_tarif.php?aksi=hapus&id_tarif=<?= $row['id_tarif'] ?>"
                   onclick="return confirm('Yakin ingin menghapus data ini?')"
                   class="btn-hapus">Hapus</a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4">
              <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                  <circle cx="12" cy="12" r="9"/><path d="M12 6v6l4 2"/>
                </svg>
                <p>Belum ada data tarif</p>
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