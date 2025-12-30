<?php
if (isset($_GET['kode_masuk'])) {
    $kode_masuk = $_GET['kode_masuk'];

    // Ambil semua data barangmasuk berdasarkan kode_masuk
    $result = $conn->query("SELECT * FROM barangmasuk WHERE kode_masuk = '$kode_masuk'");

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id_barang = $row['id_barang'];
            $jumlah = $row['jumlah'];

            // Kurangi stok
            $conn->query("UPDATE databarang SET stok = stok - $jumlah WHERE id_barang = '$id_barang'");
        }

        // Hapus semua data barangmasuk dengan kode_masuk ini
        $conn->query("DELETE FROM barangmasuk WHERE kode_masuk = '$kode_masuk'");

        // Tampilkan SweetAlert sukses
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Semua data transaksi berhasil dihapus dan stok diperbarui.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '?page=barangmasuk';
        });
        </script>";
    } else {
        // Tampilkan SweetAlert gagal
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            title: 'Gagal!',
            text: 'Transaksi dengan kode tersebut tidak ditemukan.',
            icon: 'error',
            confirmButtonText: 'Kembali'
        }).then(() => {
            window.location.href = '?page=barangmasuk';
        });
        </script>";
    }
}
?>
