<?php include_once '../Controller/c_area.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Parking Area</title>
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

.kembali:hover {
    background: #475569;
}

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

.add {
    background: #2563eb;
    color: white;
    padding: 10px 16px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
}

.add:hover {
    background: #1d4ed8;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #e2e8f0;
}

th, td {
    padding: 12px;
    text-align: center;
    color: #334155;
}

th {
    font-weight: 600;
}

tr:nth-child(even) {
    background: #f8fafc;
}

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
        <h2>Parking Area</h2>
        <a href="v_tambah_data_area.php" class="add">+ Add Area</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Area Name</th>
                <th>Capacity</th>
                <th>Occupied</th>
                <th>Available</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php if (!empty($data_area)): ?>
            <?php $no = 1; foreach ($data_area as $row): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_area']); ?></td>
                <td><?= $row['kapasitas']; ?></td>
                <td><?= $row['terisi']; ?></td>
                <td><?= $row['kapasitas'] - $row['terisi']; ?></td>
                <td class="action">
                    <a href="../Controller/c_area.php?aksi=edit&id_area=<?= $row['id_area']; ?>" class="edit">Update</a>
                    <a href="../Controller/c_area.php?aksi=hapus&id_area=<?= $row['id_area']; ?>"
                       onclick="return confirm('Delete area <?= htmlspecialchars($row['nama_area']); ?>?')"
                       class="delete">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="empty">No parking area data found.</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

</div>

</body>
</html>