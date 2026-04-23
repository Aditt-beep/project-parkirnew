<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Owner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        h2 { margin-bottom: 15px; }

        .filter-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-form label {
            font-size: 14px;
            color: #555;
        }

        input[type="date"] {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button[type="submit"] {
            padding: 9px 18px;
            background: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        button[type="submit"]:hover { background: #34495e; }

        .btn-back {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 14px;
            background: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-back:hover { background: #2980b9; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            background: #2c3e50;
            color: #fff;
            padding: 11px 10px;
            text-align: center;
        }

        td {
            padding: 10px;
            border: 1px solid #e0e0e0;
            text-align: center;
        }

        tr:hover { background: #f5f5f5; }

        .total-card {
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
        }

        .total-card span {
            color: #16a34a;
            font-size: 22px;
        }

        .empty {
            text-align: center;
            color: #94a3b8;
            padding: 20px;
        }

        .info-hint {
            font-size: 13px;
            color: #64748b;
            margin-top: 8px;
        }
    </style>
</head>
<body>

<div class="container">

    <a href="../View/v_homeowner.php" class="btn-back">← Kembali</a>

    <div class="card">
        <h2>Filter Tanggal</h2>
        <form method="GET" class="filter-form">
            <label>Dari:</label>
            <input type="date" name="dari" value="<?= htmlspecialchars($dari) ?>">
            <label>Sampai:</label>
            <input type="date" name="sampai" value="<?= htmlspecialchars($sampai) ?>">
            <button type="submit">Tampilkan</button>
        </form>
        <p class="info-hint">* Menampilkan transaksi dengan status <strong>keluar</strong> berdasarkan tanggal masuk.</p>
    </div>

    <div class="card">
        <h2>Data Laporan</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat</th>
                    <th>Jenis</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Durasi (Jam)</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            if ($data && mysqli_num_rows($data) > 0):
                while ($row = mysqli_fetch_assoc($data)):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['plat_nomor']) ?></td>
                    <td><?= htmlspecialchars($row['jenis_kendaraan']) ?></td>
                    <td><?= $row['waktu_masuk'] ?></td>
                    <td><?= $row['waktu_keluar'] ?></td>
                    <td><?= $row['durasi_jam'] ?> jam</td>
                    <td>Rp <?= number_format($row['biaya_total'], 0, ',', '.') ?></td>
                </tr>
            <?php
                endwhile;
            else:
            ?>
                <tr>
                    <td colspan="7" class="empty">
                        Tidak ada data untuk rentang tanggal 
                        <strong><?= $dari ?></strong> s/d <strong><?= $sampai ?></strong>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card total-card">
        Total Pendapatan: <span>Rp <?= number_format($total ?? 0, 0, ',', '.') ?></span>
    </div>

</div>

</body>
</html>