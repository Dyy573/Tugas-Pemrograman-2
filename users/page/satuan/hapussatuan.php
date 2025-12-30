<?php

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapussatuan' && isset($_GET['id'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    $id_satuan = $_GET['id'];

    try {
        $sql = $conn->query("DELETE FROM satuan WHERE id_satuan = '$id_satuan'");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil dihapus.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = '?page=satuan'; // Redirect ke halaman satuan
                });
            </script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Gagal menghapus data! Data masih digunakan sebagai Satuan pada data barang.',
                icon: 'error'
            }).then(() => {
                window.history.back(); // Kembali ke halaman sebelumnya setelah klik OK
            });
        </script>";
    }
}
