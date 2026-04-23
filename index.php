<?php
session_start();
include_once 'Model/m_koneksi.php';
include_once 'Model/m_log.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $koneksi = new koneksi();

    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    if ($user == "" || $pass == "") {
        echo "<script>alert('Isi username dan password'); window.location='index.php'</script>";
        exit;
    }

    $user = mysqli_real_escape_string($koneksi->koneksi, $user);
    $pass = mysqli_real_escape_string($koneksi->koneksi, $pass);

    $query = mysqli_query($koneksi->koneksi,
        "SELECT * FROM tb_user 
         WHERE username='$user' AND status_aktif=1 LIMIT 1"
    );

    if ($query && mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_assoc($query);

        if ($pass == $data['password']) {

            $_SESSION['data'] = $data;

            $log = new m_log();
            $log->simpan_log($data['id_user']);

            if ($data['role'] == 'admin') {
                header("Location: View/v_homeadmin.php");
            } elseif ($data['role'] == 'petugas') {
                header("Location: View/v_homepetugas.php");
            } elseif ($data['role'] == 'owner') {
                header("Location: View/v_homeowner.php");
            } else {
                echo "<script>alert('Role tidak dikenali'); window.location='index.php'</script>";
            }
            exit;

        } else {
            echo "<script>alert('Password salah'); window.location='index.php'</script>";
        }

    } else {
        echo "<script>alert('Username tidak ditemukan atau akun nonaktif'); window.location='index.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Parkir</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: "Poppins", sans-serif;
    background: #f1f5f9;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.card {
    background: #fff;
    padding: 36px 32px;
    width: 380px;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.10);
}

.logo {
    text-align: center;
    margin-bottom: 24px;
}

.logo-icon {
    width: 52px;
    height: 52px;
    background: #2563eb;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.logo-icon svg {
    width: 28px;
    height: 28px;
    stroke: #fff;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.logo h1 {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
}

.logo p {
    font-size: 13px;
    color: #64748b;
    margin-top: 2px;
}

label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    color: #334155;
    margin-bottom: 6px;
}

input {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    margin-bottom: 16px;
    transition: border-color 0.2s;
    font-family: "Poppins", sans-serif;
}

input:focus {
    outline: none;
    border-color: #2563eb;
}

button {
    width: 100%;
    padding: 12px;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    font-family: "Poppins", sans-serif;
    transition: background 0.2s;
}

button:hover { background: #1d4ed8; }
</style>
</head>
<body>

<div class="card">

    <div class="logo">
        <div class="logo-icon">
            <svg viewBox="0 0 24 24">
                <path d="M5 17H3v-5l2-5h14l2 5v5h-2"/>
                <circle cx="7.5" cy="17.5" r="2.5"/>
                <circle cx="16.5" cy="17.5" r="2.5"/>
                <path d="M5 12h14"/>
            </svg>
        </div>
        <h1>Sistem Parkir</h1>
        <p>Masuk ke akun Anda</p>
    </div>

    <form method="POST" action="index.php">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required autofocus>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button type="submit">Masuk</button>
    </form>

</div>

</body>
</html>