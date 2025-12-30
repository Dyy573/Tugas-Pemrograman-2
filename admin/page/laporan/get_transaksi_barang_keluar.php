<?php
include '../../../koneksi.php'; // Pastikan koneksi database sudah benar

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : 'all';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : 'all';

// Query dasar
$sql = "SELECT 
            bk.kode_keluar, 
            db.nama_barang, 
            bk.jumlah, 
            s.satuan, 
            bk.harga, 
            bk.total,
            bk.tanggal_keluar, 
            bk.keterangan
        FROM barangkeluar bk
        JOIN databarang db ON bk.id_barang = db.id_barang
        JOIN satuan s ON db.id_satuan = s.id_satuan";



if ($bulan != 'all') {
    $filters[] = "MONTH(bk.tanggal_keluar) = $bulan";
}
if ($tahun != 'all') {
    $filters[] = "YEAR(bk.tanggal_keluar) = $tahun";
}

if (!empty($filters)) {
    $sql .= " WHERE " . implode(' AND ', $filters);
}

$sql .= " ORDER BY bk.kode_keluar ASC, bk.tanggal_keluar ASC";

$result = $conn->query($sql);

$data = [];
$current_kode_keluar = null;
$current_data = [];

while ($row = $result->fetch_assoc()) {
    if ($row['kode_keluar'] !== $current_kode_keluar) {
        if ($current_kode_keluar !== null) {
            $data[] = $current_data;
        }

        $current_kode_keluar = $row['kode_keluar'];
        $current_data = [
            'kode_keluar' => $row['kode_keluar'],
            'items' => []
        ];
    }

    $current_data['items'][] = [
        'nama_barang' => $row['nama_barang'],
        'jumlah' => $row['jumlah'],
        'satuan' => $row['satuan'],
        'harga' => $row['harga'],
        'total' => $row['total'],
        'tanggal_keluar' => $row['tanggal_keluar'],
        'keterangan' => $row['keterangan']
    ];
}

if ($current_data) {
    $data[] = $current_data;
}

header('Content-Type: application/json');
echo json_encode($data);
