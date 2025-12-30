<?php
$kode_keluar = $_GET['kode'] ?? null;
if (!$kode_keluar) {
    die("Kode transaksi tidak ditemukan.");
}

$sql = $conn->prepare("
    SELECT bk.*, db.nama_barang, s.satuan, p.nama_pelanggan, p.alamat, u.username
    FROM barangkeluar bk
    JOIN databarang db ON bk.id_barang = db.id_barang
    JOIN satuan s ON db.id_satuan = s.id_satuan
    JOIN pelanggan p ON bk.id_pelanggan = p.id_pelanggan
    LEFT JOIN user u ON bk.id_user = u.id_user
    WHERE bk.kode_keluar = ?
");
$sql->bind_param("s", $kode_keluar);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows == 0) {
    die("Data transaksi tidak ditemukan.");
}

$data = $result->fetch_assoc();
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<style>
    .invoice-box {
        border: 1px solid #eee;
        padding: 20px;
        margin-top: 20px;
        background: #fff;
        font-size: 12px;
        line-height: 1.4;
        position: relative;
    }

    .watermark-logo {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 400px;
        max-width: 80%;
        opacity: 0.07;
        transform: translate(-50%, -50%);
        z-index: 0;
    }

    .invoice-content {
        position: relative;
        z-index: 1;
    }

    .signature-section {
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
        text-align: center;
        font-size: 12px;
    }

    .signature-box {
        flex: 1;
    }

   .signature-box .ttd-space {
    min-height: 60px; /* Tinggi area tanda tangan */
    margin-bottom: 10px;
}

    .signature-box .role {
        font-weight: bold;
        margin-bottom: 70px;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
    }
</style>

<div class="container">
    <div class="invoice-box">
        <img src="logoBarokah.png" class="watermark-logo" alt="Logo Watermark">
        <div class="invoice-content">
            <div class="row">
                <div class="col-md-6">
                    <h4><strong>INVOICE</strong></h4>
                    <p>
                        Nomor: <?= htmlspecialchars($data['kode_keluar']) ?><br>
                        Tanggal: <?= date('d-m-Y', strtotime($data['tanggal_keluar'])) ?>
                    </p>
                </div>
                <div class="col-md-6 text-right">
                    <h5><strong>CV.BAROKAH SEDAYA USAHA</strong></h5>
                    <p>
                        Jl Tanah Baru Raya No.6<br>
                        Depok, Jawa Barat<br>
                        Email: barokahsedayausaha@gmail.com
                    </p>
                </div>
            </div>

            <hr>

            <h6><strong>Vendor</strong></h6>
            <p>
                <?= htmlspecialchars($data['nama_pelanggan']) ?><br>
                <?= htmlspecialchars($data['alamat']) ?>
            </p>

            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $subtotal = 0;
                    $sql = $conn->prepare("
                        SELECT bk.*, db.nama_barang, s.satuan
                        FROM barangkeluar bk
                        JOIN databarang db ON bk.id_barang = db.id_barang
                        JOIN satuan s ON db.id_satuan = s.id_satuan
                        WHERE bk.kode_keluar = ?
                    ");
                    $sql->bind_param("s", $kode_keluar);
                    $sql->execute();
                    $result = $sql->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $total = $row['jumlah'] * $row['harga'];
                        $subtotal += $total;
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                            <td><?= $row['jumlah'] . ' ' . htmlspecialchars($row['satuan']) ?></td>
                            <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td>Rp<?= number_format($total, 0, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
                        <td><strong>Rp<?= number_format($subtotal, 0, ',', '.') ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total Keseluruhan</strong></td>
                        <td><strong>Rp<?= number_format($subtotal, 0, ',', '.') ?></strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="signature-section">
    <div class="signature-box">
        <p class="role">Prepared by,</p>
        <tr>
            
        </tr>
        <p><strong>PURCHASING</strong></p>
        <p>( <?= htmlspecialchars($data['username']) ?> )</p>
    </div>
    <div class="signature-box">
        <p class="role">Checked by,</p>
        <p><strong>&nbsp;</strong></p>
        <p>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</p>
    </div>
    <div class="signature-box">
        <p class="role">Approved by,</p>
        <p><strong>&nbsp;</strong></p>
        <p>( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</p>
    </div>
    <div class="signature-box">
        <p class="role">Vendor,</p>
        <p><strong><?= htmlspecialchars($data['nama_pelanggan']) ?></strong></p>
        <p>( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</p>
    </div>
</div>

    </div>

    <div class="text-center mt-4 mb-5">
        <button onclick="window.print()" class="btn btn-primary">Cetak Invoice</button>
    </div>
</div>
