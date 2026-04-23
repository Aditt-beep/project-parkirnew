<?php if (!isset($data)) include_once '../Controller/c_area.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Parking Area</title>
<style>
body {
    font-family: "Poppins", sans-serif;
    background: #f1f5f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.container {
    background: white;
    padding: 30px;
    width: 420px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,.1);
}
h2 { text-align: center; margin-bottom: 20px; color: #1e293b; }
label { display: block; margin-bottom: 6px; font-weight: 500; color: #334155; }
input {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    margin-bottom: 15px;
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
.back { text-align: center; margin-top: 15px; }
.back a { text-decoration: none; color: #2563eb; font-weight: 500; }
</style>
</head>
<body>
<div class="container">
    <h2>Edit Parking Area</h2>

    <form action="../Controller/c_area.php?aksi=update" method="POST">
        <!-- kirim id_area via hidden input -->
        <input type="hidden" name="id_area" value="<?= $data['id_area']; ?>">

        <label>Area Name</label>
        <input type="text" name="nama_area" value="<?= $data['nama_area']; ?>" required>

        <label>Capacity</label>
        <input type="number" name="kapasitas" value="<?= $data['kapasitas']; ?>" required>

        <button type="submit">Save Changes</button>
    </form>

    <div class="back">
        <a href="../View/v_tampil_data_area.php">← Back</a>
    </div>
</div>
</body>
</html>