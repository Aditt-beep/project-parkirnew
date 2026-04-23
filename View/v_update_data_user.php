<?php
if (!isset($user)) {
    header("Location: v_tampil_data_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Update Data User</title>

<style>
body {
    font-family: "Poppins", sans-serif;
    background: #f1f5f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: white;
    padding: 30px;
    width: 420px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    font-weight: 600;
    color: #1e293b;
}

label {
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
    color: #334155;
}

input, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    margin-bottom: 15px;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 12px;
    background: #16a34a;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #15803d;
}

.back {
    text-align: center;
    margin-top: 15px;
}

.back a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
}
</style>
</head>

<body>
<div class="container">

    <h2>Update Data User</h2>

    <form action="../Controller/c_user.php?aksi=update" method="POST">

        <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">

        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" required>

        <label>Username</label>
        <input type="text" name="username" value="<?= $user['username']; ?>" required>

        <label>Password</label>
        <input type="password" name="password" value="<?= $user['password']; ?>" required>

        <label>Role</label>
        <select name="role" required>
            <option value="admin" <?= $user['role']=='admin'?'selected':''; ?>>Admin</option>
            <option value="petugas" <?= $user['role']=='petugas'?'selected':''; ?>>Petugas</option>
            <option value="owner" <?= $user['role']=='owner'?'selected':''; ?>>Owner</option>
        </select>

        <label>Status</label>
        <select name="status_aktif" required>
            <option value="1" <?= $user['status_aktif']==1?'selected':''; ?>>Aktif</option>
            <option value="0" <?= $user['status_aktif']==0?'selected':''; ?>>Nonaktif</option>
        </select>

        <button type="submit">Update</button>
    </form>

    <div class="back">
        <a href="../View/v_tampil_data_user.php">← Kembali</a>
    </div>

</div>
</body>
</html>
