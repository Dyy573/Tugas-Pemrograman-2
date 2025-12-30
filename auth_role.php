<?php
function require_role($allowed_roles = [])
{

    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header("Location: login.php");
        exit();
    }

    if (!in_array($_SESSION['role'], $allowed_roles)) {
        echo '
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Akses Ditolak</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
            <script>
    Swal.fire({
        icon: "error",
        title: "Akses Ditolak",
        text: "Role Anda tidak memiliki izin untuk mengakses halaman ini.",
        confirmButtonText: "Login Ulang"
    }).then(() => {
        window.location.href = "../login.php"; // Arahkan ke halaman login
    });
</script>
        </body>
        </html>';
        exit();
    }
}
