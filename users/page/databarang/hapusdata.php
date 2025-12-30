<?php
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapusbarang' && isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    try {
        $sql = $conn->query("DELETE FROM databarang WHERE id_barang = '$id_barang'");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil dihapus.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = '?page=databarang'; // Redirect ke halaman data jenis barang
                });
            </script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Gagal menghapus data! Data Barang Aktif',
                icon: 'error'
            }).then(() => {
                window.history.back(); // Kembali ke halaman sebelumnya setelah klik OK
            });
        </script>";
    }
}
