<?php include_once '../Controller/c_tarif.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Tarif</title>
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
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
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
    <h2>Tambah Tarif Parkir</h2>

    <form action="../Controller/c_tarif.php?aksi=tambah" method="POST">

        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="mobil">Mobil</option>
            <option value="motor">Motor</option>
            <option value="lainnya">Lainnya</option>
        </select>

        <label>Tarif per Jam</label>
        <input type="number" name="tarif_per_jam" placeholder="e.g. 5000" min="0" required>

        <button type="submit">Simpan</button>
    </form>

    <div class="back">
        <a href="v_tampil_data_tarif.php">← Kembali</a>
    </div>
</div>
</body>
</html>