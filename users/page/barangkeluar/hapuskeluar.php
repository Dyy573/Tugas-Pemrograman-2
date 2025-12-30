<?php
if (isset($_GET['kode_keluar'])) {
    $kode_keluar = $_GET['kode_keluar'];

    // Ambil semua barangkeluar berdasarkan kode_keluar
    $result = $conn->query("SELECT * FROM barangkeluar WHERE kode_keluar = '$kode_keluar'");

    if ($result && $result->num_rows > 0) {
        // Loop data untuk kembalikan stok jika status = 'dipinjam'
        while ($row = $result->fetch_assoc()) {
            $id_barang = $row['id_barang'];
            $jumlah = $row['jumlah'];
            $status = strtolower($row['status']);

            if ($status === 'dipinjam') {
                $conn->query("UPDATE databarang SET stok = stok + $jumlah WHERE id_barang = '$id_barang'");
            }
        }

        // Hapus semua data barangkeluar dengan kode_keluar ini
        $conn->query("DELETE FROM barangkeluar WHERE kode_keluar = '$kode_keluar'");

        // Tampilkan pesan sukses
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Seluruh data transaksi berhasil dihapus dan stok dikembalikan.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '?page=barangkeluar';
        });
        </script>";
    } else {
        // Data tidak ditemukan
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            title: 'Gagal!',
            text: 'Transaksi dengan kode tersebut tidak ditemukan.',
            icon: 'error',
            confirmButtonText: 'Kembali'
        }).then(() => {
            window.location.href = '?page=barangkeluar';
        });
        </script>";
    }
}
?>
