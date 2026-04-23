<?php
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'petugas') {
    header("Location: ../View/v_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Parkir</title>

    <style>
        body {
            font-family: Arial;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        h2 {
            margin-bottom: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #34495e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #2c3e50;
            color: #fff;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        tr:hover {
            background: #f5f5f5;
        }

        .btn {
            padding:6px 12px;
            border-radius:6px;
            text-decoration:none;
            font-size:13px;
            display:inline-block;
        }

        .btn-keluar {
            background:#e74c3c;
            color:#fff;
        }

        .btn-keluar:hover {
            background:#c0392b;
        }

        .btn-struk {
            background:#3498db;
            color:#fff;
        }

        .btn-struk:hover {
            background:#2980b9;
        } 
        .btn-back {
            display:inline-block;
            margin-bottom:15px;
            padding:8px 12px;
            background:#3498db;
            color:#fff;
            text-decoration:none;
            border-radius:6px;
        }
        .btn-back:hover {
            background:#2980b9;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="../View/v_homepetugas.php  " class="btn-back">Kembali</a>
    <div class="card">
        <h2>Input Kendaraan</h2>

        <form method="POST" action="../Controller/c_transaksi.php">

            <input type="text" name="plat" placeholder="Plat Nomor" required>

            <select name="jenis">
                <option value="motor">Motor</option>
                <option value="mobil">Mobil</option>
            </select>

            <input type="hidden" name="id_user" value="<?= $_SESSION['data']['id_user']; ?>">
            <input type="hidden" name="id_area" value="1">

            <button type="submit">Masuk</button>

        </form>
    </div>

    <div class="card">
        <h2>Kendaraan Parkir</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Plat</th>
                <th>Jenis</th>
                <th>Waktu Masuk</th>
                <th>Aksi</th>
            </tr>

            <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['plat_nomor']; ?></td>
                    <td><?= $row['jenis_kendaraan']; ?></td>
                    <td><?= $row['waktu_masuk']; ?></td>
                    <td>
                        <a class="btn btn-keluar" href="../Controller/c_transaksi.php?aksi=keluar&id=<?= $row['id_parkir']; ?>">Keluar</a>
                        <a class="btn btn-struk" href="../Controller/c_transaksi.php?aksi=struk&id=<?= $row['id_parkir']; ?>">Struk</a>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>