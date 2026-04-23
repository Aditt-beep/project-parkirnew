<?php
if (!isset($tarif)) {
    header("Location: v_tampil_data_tarif.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Update Tarif Parkir</title>
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
    background: #16a34a;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
}

button:hover { background: #15803d; }

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
    <h2>Update Tarif Parkir</h2>

    <form action="../Controller/c_tarif.php?aksi=update" method="POST">

        <input type="hidden" name="id_tarif" value="<?= $tarif['id_tarif']; ?>">

        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required>
            <option value="motor"   <?= $tarif['jenis_kendaraan'] == 'motor'   ? 'selected' : ''; ?>>Motor</option>
            <option value="mobil"   <?= $tarif['jenis_kendaraan'] == 'mobil'   ? 'selected' : ''; ?>>Mobil</option>
            <option value="lainnya" <?= $tarif['jenis_kendaraan'] == 'lainnya' ? 'selected' : ''; ?>>Lainnya</option>
        </select>

        <label>Tarif per Jam</label>
        <input type="number" name="tarif_per_jam"
               value="<?= $tarif['tarif_per_jam']; ?>" min="0" required>

        <button type="submit">Update</button>
    </form>

    <div class="back">
        <a href="../View/v_tampil_data_tarif.php">← Kembali</a>
    </div>
</div>

</body>
</html>