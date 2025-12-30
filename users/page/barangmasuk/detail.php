<?php

include '../koneksi.php';

$kode_masuk = $_GET['kode'] ?? null;
if (!$kode_masuk) {
    die("Kode transaksi tidak ditemukan.");
}

if (!isset($_SESSION['username'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}
$usernameLogin = $_SESSION['username'];

$sql = $conn->prepare("
    SELECT bm.*, db.nama_barang, s.satuan, sup.nama_supplier, sup.alamat
    FROM barangmasuk bm
    JOIN databarang db ON bm.id_barang = db.id_barang
    JOIN satuan s ON db.id_satuan = s.id_satuan
    JOIN supplier sup ON bm.id_supplier = sup.id_supplier
    WHERE bm.kode_masuk = ?
");
$sql->bind_param("s", $kode_masuk);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows == 0) {
    die("Data transaksi tidak ditemukan.");
}
$data = $result->fetch_assoc();
$nama_supplier = $data['nama_supplier']; // ✅ Tambahan ini penting
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<style>
  .invoice-box {
    border: 1px solid #eee;
    padding: 15px;
    margin-top: 15px;
    background: #fff;
    font-size: 12px;
    line-height: 1.2;
    position: relative;
  }

  .watermark-logo {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 400px;
    max-width: 80%;
    opacity: 0.08;
    transform: translate(-50%, -50%);
    z-index: 0;
  }

  .invoice-content {
    position: relative;
    z-index: 1;
  }

  table.table {
    width: 100%;
    font-size: 12px;
    background-color: transparent !important;
    border-color: #999 !important;
  }

  table.table th,
  table.table td {
    padding: 4px 6px;
    vertical-align: middle;
    background-color: transparent !important;
  }

  thead.thead-light th {
    background-color: rgba(240, 240, 240, 0.4) !important;
  }

  @media print {
    body {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }

    #print-btn {
      display: none;
    }

    @page {
      size: A4 portrait;
      margin: 10mm;
    }
  }
</style>

<div class="container" id="print-area">
  <div class="invoice-box">
    <img src="logoBarokah.png" alt="Logo Watermark" class="watermark-logo" />
    <div class="invoice-content">
      <div class="row mb-4">
        <div class="col text-center"></div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <h2>INVOICE</h2>
          <p>Nomor: <?= htmlspecialchars($data['kode_masuk']) ?><br />
            Tanggal: <?= date('d-m-Y', strtotime($data['tanggal_masuk'])) ?></p>
        </div>
        <div class="col-md-6 text-right">
          <h4>CV.BAROKAH SEDAYA USAHA</h4>
          <p>
            Jl Tanah Baru Raya No.6<br />
            Depok, Jawa Barat<br />
            Email: barokahsedayausaha@gmail.com
          </p>
        </div>
      </div>

      <hr />

      <div class="row mb-4">
        <div class="col-md-6">
          <h5>Supplier</h5>
          <p>
            <?= htmlspecialchars($data['nama_supplier']) ?><br />
            <?= htmlspecialchars($data['alamat']) ?>
          </p>
        </div>
      </div>

      <table class="table table-bordered">
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
          $totalSubtotal = 0;

          $sqlDetail = $conn->prepare("
            SELECT bm.*, db.nama_barang, s.satuan
            FROM barangmasuk bm
            JOIN databarang db ON bm.id_barang = db.id_barang
            JOIN satuan s ON db.id_satuan = s.id_satuan
            WHERE bm.kode_masuk = ?
            ORDER BY bm.id_masuk DESC
          ");
          $sqlDetail->bind_param("s", $kode_masuk);
          $sqlDetail->execute();
          $resultDetail = $sqlDetail->get_result();

          while ($row = $resultDetail->fetch_assoc()) {
            $totalBaris = $row['jumlah'] * $row['harga'];
            $totalSubtotal += $totalBaris;
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= htmlspecialchars($row['nama_barang']) ?></td>
              <td><?= $row['jumlah'] ?> <?= htmlspecialchars($row['satuan']) ?></td>
              <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
              <td>Rp<?= number_format($totalBaris, 0, ',', '.') ?></td>
            </tr>
          <?php } ?>
          <tr>
            <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
            <td><strong>Rp<?= number_format($totalSubtotal, 0, ',', '.') ?></strong></td>
          </tr>
          <tr>
            <td colspan="4" class="text-right"><strong>Total Keseluruhan</strong></td>
            <td><strong>Rp<?= number_format($totalSubtotal, 0, ',', '.') ?></strong></td>
          </tr>
        </tbody>
      </table>

      <table style="width:100%; margin-top: 50px; text-align: center;">
  <tr>
    <td><strong>Prepared by,</strong></td>
    <td><strong>Checked by,</strong></td>
    <td><strong>Approved by,</strong></td>
    <td><strong>Supplier,</strong></td>
  </tr>
  <tr style="height: 60px;">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>PURCHASING</strong></td>
    <td></td>
    <td></td>
    <td><strong><?= htmlspecialchars($nama_supplier) ?></strong></td>
  </tr>
  <tr>
    <td>( <?= htmlspecialchars($_SESSION['username']) ?> )</td>
    <td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
    <td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
    <td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
  </tr>
</table>


    </div>
  </div>
</div>

<!-- BUTTON CETAK -->
<div class="text-center mt-4 mb-5">
  <button id="print-btn" class="btn btn-primary" onclick="printInvoice()">Cetak Invoice</button>
</div>

<script>
function printInvoice() {
  var content = document.getElementById("print-area").innerHTML;
  var printWindow = window.open('', '', 'width=1000,height=700');
  printWindow.document.write(`
    <html>
      <head>
        <title>Invoice</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <style>
          @page { size: A4 portrait; margin: 10mm; }
          body { font-size: 12px; position: relative; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
          .watermark-logo {
            position: absolute;
            top: 30%;
            left: 50%;
            width: 400px;
            max-width: 100%;
            opacity: 0.08;
            transform: translate(-50%, -50%);
            z-index: 9999;
          }
          .invoice-content {
            position: relative;
            z-index: 1;
          }
          table.table th, table.table td {
            padding: 4px 6px;
            font-size: 12px;
            background-color: transparent !important;
          }
        </style>
      </head>
      <body onload="window.print(); window.close();">
        ${content}
      </body>
    </html>
  `);
  printWindow.document.close();
}
</script>
