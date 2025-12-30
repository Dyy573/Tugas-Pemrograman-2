<?php

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapusjenis' && isset($_GET['id'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    $id_jenis = $_GET['id'];

    try {
        $sql = $conn->query("DELETE FROM jenisbarang WHERE id_jenis = '$id_jenis'");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil dihapus.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = '?page=jenisbarang'; // Redirect ke halaman data jenis barang
                });
            </script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Gagal menghapus data! Data masih digunakan sebagai foreign key.',
                icon: 'error'
            }).then(() => {
                window.history.back(); // Kembali ke halaman sebelumnya setelah klik OK
            });
        </script>";
    }
}
