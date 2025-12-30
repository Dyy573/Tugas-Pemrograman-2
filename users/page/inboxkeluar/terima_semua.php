<?php
include '../../../koneksi.php'; // Pastikan koneksi database sudah benar

// Query untuk mengambil data barang keluar yang statusnya 'pending'
$query = "SELECT id_keluar, id_barang, jumlah FROM barangkeluar WHERE status = 'dipinjam'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Proses setiap barang keluar
    while ($row = $result->fetch_assoc()) {
        $id_keluar = $row['id_keluar'];
        $id_barang = $row['id_barang'];
        $jumlah = $row['jumlah'];

        // Update status barang keluar menjadi 'diterima'
        $conn->query("UPDATE barangkeluar SET status = 'selesai' WHERE id_keluar = $id_keluar");

        // Kurangi stok barang yang dikeluarkan
        $conn->query("UPDATE databarang SET stok = stok + $jumlah WHERE id_barang = $id_barang");
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Tidak ada data peminjaman']);
}

$conn->close();
