<?php include_once '../Controller/c_user.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data User</title>
<style>
body {
    font-family: "Poppins", sans-serif;
    background: #f1f5f9;
    margin: 0;
    padding: 40px;
}

.container {
    background: #fff;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,.08);
}

.top-bar {
    margin-bottom: 15px;
}

.kembali {
    background: #64748b;
    color: white;
    padding: 8px 14px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
}

.kembali:hover { background: #475569; }

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header h2 {
    margin: 0;
    color: #1e293b;
}

.tambah {
    background: #2563eb;
    color: white;
    padding: 10px 16px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
}

.tambah:hover { background: #1d4ed8; }

table {
    width: 100%;
    border-collapse: collapse;
}

thead { background: #e2e8f0; }

th, td {
    padding: 12px;
    text-align: center;
    color: #334155;
}

th { font-weight: 600; }

tr:nth-child(even) { background: #f8fafc; }

.action a {
    padding: 6px 10px;
    color: white;
    border-radius: 8px;
    font-size: 13px;
    text-decoration: none;
    margin: 0 2px;
}

.edit   { background: #16a34a; }
.edit:hover   { background: #15803d; }
.delete { background: #dc2626; }
.delete:hover { background: #b91c1c; }

.badge {
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.aktif    { background: #dcfce7; color: #16a34a; }
.nonaktif { background: #fee2e2; color: #dc2626; }

.role-badge {
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.admin   { background: #dbeafe; color: #2563eb; }
.petugas { background: #fef9c3; color: #ca8a04; }
.owner   { background: #f3e8ff; color: #9333ea; }

.empty {
    text-align: center;
    color: #94a3b8;
    padding: 20px;
}
</style>
</head>
<body>

<div class="container">

    <div class="top-bar">
        <a href="v_homeadmin.php" class="kembali">← Kembali ke Beranda</a>
    </div>

    <div class="header">
        <h2>Data User</h2>
        <a href="v_tambah_data_user.php" class="tambah">+ Tambah User</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        <?php if (!empty($users)): ?>
            <?php $no = 1; foreach ($users as $row): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                <td><?= htmlspecialchars($row['username']); ?></td>
                <td>
                    <span class="role-badge <?= $row['role']; ?>">
                        <?= ucfirst($row['role']); ?>
                    </span>
                </td>
                <td>
                    <span class="badge <?= $row['status_aktif'] ? 'aktif' : 'nonaktif'; ?>">
                        <?= $row['status_aktif'] ? 'Aktif' : 'Nonaktif'; ?>
                    </span>
                </td>
                <td class="action">
                    <a href="../Controller/c_user.php?aksi=edit&id_user=<?= $row['id_user']; ?>" class="edit">Update</a>
                    <a href="../Controller/c_user.php?aksi=hapus&id_user=<?= $row['id_user']; ?>"
                       onclick="return confirm('Hapus user <?= htmlspecialchars($row['nama_lengkap']); ?>?')"
                       class="delete">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="empty">Belum ada data user.</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

</div>

</body>
</html>