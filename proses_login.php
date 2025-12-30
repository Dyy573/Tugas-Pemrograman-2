<?php
session_start();
require 'koneksi.php'; // koneksi ke database Anda

$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role'];

// Cek apakah user dengan role dan password tersebut ada
$query = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ? AND role = ?");
$query->bind_param("sss", $username, $password, $role);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Simpan data user ke session
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

    // Redirect sesuai role
    switch ($user['role']) {
        case 'users':
            header("Location: users/index.php");
            break;
        case 'admin':
            header("Location: admin/index.php");
            break;
        default:
            echo "Role tidak dikenali.";
    }
    exit();
} else {
    echo "Username, password, atau role tidak ditemukan.";
}
?>
