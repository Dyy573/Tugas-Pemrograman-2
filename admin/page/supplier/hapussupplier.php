<?php

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapussupplier' && isset($_GET['id'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    $id_supplier = $_GET['id'];

    try {
        $sql = $conn->query("DELETE FROM supplier WHERE id_supplier = '$id_supplier'");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data supplier berhasil dihapus.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = '?page=supplier'; // Redirect ke halaman supplier
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
