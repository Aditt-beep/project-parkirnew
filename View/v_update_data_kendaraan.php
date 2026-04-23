<?php
if (!isset($kendaraan)) {
    header("Location: v_tampil_data_kendaraan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Update Data Kendaraan</title>

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

    <h2>Update Data Kendaraan</h2>

    <form action="../Controller/c_kendaraan.php?aksi=update" method="POST">

        <input type="hidden" name="id_kendaraan" value="<?= $kendaraan['id_kendaraan']; ?>">

        <label>Plat Nomor</label>
        <input type="text" name="plat_nomor" value="<?= $kendaraan['plat_nomor']; ?>" required>

        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required>
            <option value="Motor" <?= $kendaraan['jenis_kendaraan']=='Motor'?'selected':''; ?>>Motor</option>
            <option value="Mobil" <?= $kendaraan['jenis_kendaraan']=='Mobil'?'selected':''; ?>>Mobil</option>
            <option value="Truk" <?= $kendaraan['jenis_kendaraan']=='Truk'?'selected':''; ?>>Truk</option>
        </select>

        <label>Warna</label>
        <input type="text" name="warna" value="<?= $kendaraan['warna']; ?>" required>

        <label>Pemilik</label>
        <input type="text" name="pemilik" value="<?= $kendaraan['pemilik']; ?>" required>

        <button type="submit">Update</button>
    </form>

    <div class="back">
        <a href="../View/v_tampil_data_kendaraan.php"> Kembali</a>
    </div>

</div>
</body>
</html>
