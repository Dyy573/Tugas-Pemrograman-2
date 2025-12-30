<?php
// Koneksi database
include '../../../koneksi.php';

// Query untuk mengambil status terbaru
$sql = "SELECT id_keluar, status FROM barangkeluar ORDER BY id_keluar DESC";
$result = $conn->query($sql);

// Menyusun data sebagai array untuk JSON
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Mengembalikan data dalam format JSON
echo json_encode($data);
