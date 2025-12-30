<?php
include '../../../koneksi.php'; // Pastikan koneksi database sudah benar

// Ambil data barang keluar yang statusnya 'pending' dan dikelompokkan berdasarkan kode transaksi
$result = $conn->query("
    SELECT 
        bk.kode_keluar, 
        GROUP_CONCAT(db.nama_barang ORDER BY db.nama_barang) AS nama_barang,
        GROUP_CONCAT(bk.jumlah ORDER BY db.nama_barang) AS jumlah,
        bk.tanggal_keluar,
        GROUP_CONCAT(bk.id_keluar ORDER BY db.nama_barang) AS id_keluar,
        GROUP_CONCAT(bk.keterangan ORDER BY db.nama_barang) AS keterangan
    FROM barangkeluar bk
    JOIN databarang db ON bk.id_barang = db.id_barang
    WHERE bk.status = 'dipinjam'
    GROUP BY bk.kode_keluar
    ORDER BY bk.id_keluar DESC
");

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
