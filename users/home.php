<?php
// Jumlah anggota
$sql = "SELECT COUNT(id_barang) AS jumlah_barang FROM databarang";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $jumlah_barang = $row["jumlah_barang"];
} else {
  $jumlah_barang = 0;
}

$sql = "SELECT COUNT(id_jenis) AS jumlah_jenis FROM jenisbarang";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $jumlah_jenis = $row["jumlah_jenis"];
} else {
  $jumlah_jenis = 0;
}

$sql = "SELECT COUNT(id_satuan) AS jumlah_satuan FROM satuan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $jumlah_satuan = $row["jumlah_satuan"];
} else {
  $jumlah_satuan = 0;
}
?>

<style>
    /* Reset dan base font */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f9;
        color: #333;
    }

    /* Container */
    .container-fluid {
        max-width: 100%;
        margin: 30px auto;
        padding: 0 15px;
    }

    .bg-dasboard h1 {
        font-weight: 700;
        color: #2c3e50;
    }

    /* Card Styling */
    .card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: none;
    }

    .card:hover {
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }

    .card-header {
        padding: 24px 30px;
        font-weight: 700;
        font-size: 1.4rem;
        background: linear-gradient(to right, #e3f2fd, #ffffff);
        border-bottom: 1px solid #ddd;
        color: #2d3436;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-body {
        padding: 24px 30px;
    }

    /* Dashboard Cards */
    .card-link {
        text-decoration: none;
        color: inherit;
    }

    .card-link:hover {
        text-decoration: none;
        color: inherit;
    }

    .dashboard-card {
        background: linear-gradient(135deg, #fff 0%, #f8fafc 100%);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .dashboard-card:hover::before {
        opacity: 1;
    }

    .dashboard-card .card-title {
        font-weight: 600;
        color: #374151;
        font-size: 1.1rem;
    }

    .dashboard-card h3 {
        font-weight: 700;
        font-size: 2.5rem;
        color: #1f2937;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .dashboard-card i {
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .dashboard-card:hover i {
        opacity: 1;
        transform: scale(1.1);
    }

    /* Icon Colors */
    .text-primary-custom {
        color: #3b82f6 !important;
    }

    .text-success-custom {
        color: #10b981 !important;
    }

    .text-warning-custom {
        color: #f59e0b !important;
    }

    /* Table styling */
    #dataTable {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        font-size: 0.95rem;
    }

    #dataTable thead tr {
        background-color: #2c3e50;
        color: #ecf0f1;
        text-align: center;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    #dataTable th, #dataTable td {
        padding: 14px 20px;
        vertical-align: middle !important;
        transition: background-color 0.3s ease;
    }

    #dataTable tbody tr {
        background: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        border-radius: 12px;
        transition: all 0.3s ease-in-out;
    }

    #dataTable tbody tr:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        transform: translateY(-3px);
        border-left: 4px solid #007bff;
    }

    #dataTable td {
        text-align: center;
        color: #34495e;
    }

    /* Badge styling */
    .badge {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-danger {
        background-color: #ef4444;
        color: #fff;
    }

    .badge-warning {
        background-color: #f59e0b;
        color: #92400e;
    }

    .badge-success {
        background-color: #10b981;
        color: #fff;
    }

    /* Responsive Mobile */
    @media (max-width: 767.98px) {
        .dashboard-card h3 {
            font-size: 2rem;
        }

        #dataTable thead {
            display: none;
        }

        #dataTable, #dataTable tbody, #dataTable tr, #dataTable td {
            display: block;
            width: 100%;
        }

        #dataTable tr {
            margin-bottom: 1.5rem;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 12px;
            padding: 0;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            position: relative;
        }

        #dataTable tr:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        #dataTable tr::before {
            content: '';
            display: block;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            height: 8px;
            width: 100%;
        }

        #dataTable td {
            text-align: left !important;
            padding: 12px 20px;
            position: relative;
            border: none;
            box-shadow: none;
            font-size: 0.95rem;
            line-height: 1.5;
            border-bottom: 1px solid #f1f5f9;
        }

        #dataTable td:last-child {
            border-bottom: none;
            padding-bottom: 20px;
        }

        #dataTable td::before {
            content: attr(data-label) ':';
            font-weight: 600;
            color: #374151;
            display: inline-block;
            width: 120px;
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        #dataTable td[data-label="No"] {
            background: #f8fafc;
            padding: 15px 20px 10px 20px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #3b82f6;
            border-bottom: 1px solid #e5e7eb;
        }

        #dataTable td[data-label="No"]::before {
            display: none;
        }

        @media (max-width: 480px) {
            #dataTable tr {
                margin-bottom: 1rem;
            }
            
            #dataTable td::before {
                width: 100px;
                font-size: 0.85rem;
            }
            
            #dataTable td {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }
    }

    /* Additional styling untuk consistent look */
    .main-content {
        margin-top: 0;
    }

    .half-background {
        display: none;
    }

    hr {
        border-top: 2px solid #e9ecef;
        margin: 1rem 0;
    }
</style>

<div class="container-fluid">
  <div class="bg-dasboard">
    <h1 class="mt-4 mb-4"><i class="fas fa-home"></i> Dashboard</h1>
  </div>

  <!-- Dashboard Cards -->
  <div class="container main-content">
    <div class="row">

      <!-- Card 1: Data Barang -->
      <div class="col-md-4 mb-4">
        <a href="?page=databarang" class="card-link">
          <div class="card dashboard-card shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Data Barang</h5>
                <i class="fas fa-box fa-2x text-primary-custom"></i>
              </div>
              <hr>
              <h3 class="text-center mt-3 mb-0"><?php echo $jumlah_barang; ?></h3>
            </div>
          </div>
        </a>
      </div>

      <!-- Card 2: Jenis Barang -->
      <div class="col-md-4 mb-4">
        <a href="?page=jenisbarang" class="card-link">
          <div class="card dashboard-card shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Jenis Barang</h5>
                <i class="fas fa-tags fa-2x text-success-custom"></i>
              </div>
              <hr>
              <h3 class="text-center mt-3 mb-0"><?php echo $jumlah_jenis; ?></h3>
            </div>
          </div>
        </a>
      </div>

      <!-- Card 3: Satuan -->
      <div class="col-md-4 mb-4">
        <a href="?page=satuan" class="card-link">
          <div class="card dashboard-card shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Satuan</h5>
                <i class="fas fa-ruler fa-2x text-warning-custom"></i>
              </div>
              <hr>
              <h3 class="text-center mt-3 mb-0"><?php echo $jumlah_satuan; ?></h3>
            </div>
          </div>
        </a>
      </div>

    </div>
  </div>

  <!-- Data Tables -->
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-info-circle"></i> Stok barang telah mencapai batas minimum</h5>
    </div>
    <div class="card-body p-3 p-md-4 bg-white rounded">
      <div class="table-responsive">
        <table class="table table-borderless table-sm" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Jenis Barang</th>
              <th>Stok</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $sql = $conn->query("SELECT databarang.*, jenisbarang.nama_jenis, satuan.satuan
                                 FROM databarang
                                 JOIN jenisbarang ON databarang.id_jenis = jenisbarang.id_jenis
                                 JOIN satuan ON databarang.id_satuan = satuan.id_satuan
                                 ORDER BY databarang.stok ASC"); // stok terkecil dulu

            while ($data = $sql->fetch_assoc()) {
            ?>
              <tr>
                <td data-label="No"><?php echo $no++; ?></td>
                <td data-label="Nama Barang"><?php echo $data['nama_barang']; ?></td>
                <td data-label="Jenis Barang"><?php echo $data['nama_jenis']; ?></td>
                <td data-label="Stok">
                  <span class="badge 
                    <?php
                    if ($data['stok'] == 0) {
                      echo 'badge-danger';
                    } elseif ($data['stok'] > 0 && $data['stok'] <= 10) {
                      echo 'badge-warning';
                    } else {
                      echo 'badge-success';
                    }
                    ?>">
                    <?php
                    if ($data['stok'] == 0) {
                      echo "Barang Habis";
                    } elseif ($data['stok'] > 0 && $data['stok'] <= 10) {
                      echo "Barang Hampir Habis";
                    } else {
                      echo "Tersedia";
                    }
                    ?>
                  </span>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>