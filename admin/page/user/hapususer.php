<?php

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapususer' && isset($_GET['id'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    $id_user = $_GET['id'];

    try {
        $sql = $conn->query("DELETE FROM user WHERE id_user = '$id_user'");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data user berhasil dihapus.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = '?page=user'; // Redirect ke halaman user
                });
            </script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Gagal menghapus data! Data masih digunakan dalam sistem.',
                icon: 'error'
            }).then(() => {
                window.history.back(); // Kembali ke halaman sebelumnya setelah klik OK
            });
        </script>";
    }
}
