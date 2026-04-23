<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Add Parking Area</title>
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
    box-shadow: 0 4px 20px rgba(0,0,0,.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1e293b;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #334155;
}

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
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #1d4ed8;
}

.back {
    text-align: center;
    margin-top: 15px;
}

.back a {
    text-decoration: none;
    color: #2563eb;
    font-weight: 500;
}
</style>
</head>
<body>

<div class="container">
    <h2>Add Parking Area</h2>

    <form action="../Controller/c_area.php?aksi=tambah" method="POST">
        <label>Area Name</label>
        <input type="text" name="nama_area" placeholder="e.g. Area A" required>

        <label>Capacity</label>
        <input type="number" name="kapasitas" placeholder="e.g. 50" min="1" required>

        <button type="submit">Add Area</button>
    </form>

    <div class="back">
        <a href="v_tampil_data_area.php">← Back to List</a>
    </div>
</div>

</body>
</html>