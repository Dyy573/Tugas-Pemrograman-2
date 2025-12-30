<?php
include '../../../koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : 'all';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : 'all';

// Query untuk mengambil data barang masuk
$sql = "SELECT 
            bm.kode_masuk, 
            db.nama_barang, 
            bm.jumlah, 
            s.satuan,
            bm.harga, 
            bm.total, 
            sup.nama_supplier, 
            bm.tanggal_masuk, 
            bm.keterangan
        FROM barangmasuk bm
        JOIN databarang db ON bm.id_barang = db.id_barang
        JOIN satuan s ON db.id_satuan = s.id_satuan
        JOIN supplier sup ON bm.id_supplier = sup.id_supplier";



// Filter berdasarkan bulan dan tahun jika ada
if ($bulan != 'all') {
    $filters[] = "MONTH(bm.tanggal_masuk) = $bulan";
}
if ($tahun != 'all') {
    $filters[] = "YEAR(bm.tanggal_masuk) = $tahun";
}

if (!empty($filters)) {
    $sql .= " WHERE " . implode(' AND ', $filters);
}

// Urutkan berdasarkan kode_masuk dan tanggal_masuk
$sql .= " ORDER BY bm.kode_masuk ASC, bm.tanggal_masuk ASC";

// Eksekusi query
$result = $conn->query($sql);

$data = [];
$current_kode_masuk = null;
$current_data = [];

while ($row = $result->fetch_assoc()) {
    // Cek apakah kode_masuk sudah berubah
    if ($row['kode_masuk'] != $current_kode_masuk) {
        // Jika kode_masuk berubah, simpan data sebelumnya (jika ada)
        if ($current_kode_masuk !== null) {
            $data[] = $current_data;
        }
        // Reset data untuk kode_masuk yang baru
        $current_kode_masuk = $row['kode_masuk'];
        $current_data = [
            'kode_masuk' => $row['kode_masuk'],
            'items' => [] // Menampung item-item dengan kode_masuk yang sama
        ];
    }

    // Masukkan item barang ke dalam array items
    $current_data['items'][] = [
        'nama_barang' => $row['nama_barang'],
        'jumlah' => $row['jumlah'],
        'satuan' => $row['satuan'],
        'harga' => $row['harga'],
        'total' => $row['total'],
        'nama_supplier' => $row['nama_supplier'],
        'tanggal_masuk' => $row['tanggal_masuk'],
        'keterangan' => $row['keterangan']
    ];
}

// Jangan lupa untuk menambahkan data terakhir ke array $data
if ($current_data) {
    $data[] = $current_data;
}

// Kirim data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
