<!DOCTYPE html>
<html>
<head>
    <title>Struk Parkir</title>
    <style>
        body{
            font-family: monospace;
            text-align:center;
        }
        .box{
            width:250px;
            margin:auto;
            border:1px dashed #000;
            padding:10px;
        }
    </style>
</head>
<body onload="window.print()">

<div class="box">
    <h3>STRUK PARKIR</h3>
    <hr>

    Plat: <?= $data['plat_nomor']; ?><br>
    Jenis: <?= $data['jenis_kendaraan']; ?><br>
    Masuk: <?= $data['waktu_masuk']; ?><br>
    Keluar: <?= $data['waktu_keluar']; ?><br>
    Durasi: <?= $data['durasi_jam']; ?> jam<br>
    Total: Rp<?= $data['biaya_total']; ?><br>

    <hr>
    Terima kasih 
</div>

</body>
</html>