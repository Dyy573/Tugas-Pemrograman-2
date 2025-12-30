<?php

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapuspelanggan' && isset($_GET['id'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    $id_pelanggan = $_GET['id'];

    try {
        $sql = $conn->query("DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data pelanggan berhasil dihapus.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = '?page=pelanggan'; // Redirect ke halaman pelanggan
                });
            </script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Gagal menghapus data! Data masih digunakan dalam transaksi lain.',
                icon: 'error'
            }).then(() => {
                window.history.back(); // Kembali ke halaman sebelumnya setelah klik OK
            });
        </script>";
    }
}
