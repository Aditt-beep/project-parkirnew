<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Data Kendaraan</title>
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
    <h2>Tambah Data Kendaraan</h2>

    <!-- fix: hapus include c_kendaraan.php, form ini statis -->
    <form action="../Controller/c_kendaraan.php?aksi=tambah" method="POST">

        <label>Plat Nomor</label>
        <input type="text" name="plat_nomor" placeholder="B 1234 ABC" required>

        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="Motor">Motor</option>
            <option value="Mobil">Mobil</option>
            <option value="Truk">Truk</option>
        </select>

        <label>Warna</label>
        <input type="text" name="warna" placeholder="e.g. Hitam" required>

        <label>Pemilik</label>
        <input type="text" name="pemilik" placeholder="e.g. Andi" required>

        <button type="submit">Simpan</button>
    </form>

    <div class="back">
        <a href="v_tampil_data_kendaraan.php">← Kembali</a>
    </div>
</div>

</body>
</html>