<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Data User</title>
<style>
body {
    font-family: "Poppins", sans-serif;
    background: #f1f5f9;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
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
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 12px;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
}

button:hover { background: #1d4ed8; }

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
    <h2>Tambah Data User</h2>

    <!-- fix: hapus include c_user.php, form ini statis tidak butuh controller -->
    <form action="../Controller/c_user.php?aksi=tambah" method="POST">

        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" placeholder="e.g. Andi Saputra" required>

        <label>Username</label>
        <input type="text" name="username" placeholder="e.g. andi" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Role</label>
        <select name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
            <option value="owner">Owner</option>
        </select>

        <label>Status</label>
        <select name="status_aktif" required>
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>
        </select>

        <button type="submit">Simpan</button>
    </form>

    <div class="back">
        <a href="v_tampil_data_user.php">← Kembali</a>
    </div>
</div>

</body>
</html>