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

    /* Card */
    .card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: box-shadow 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .card-header {
        padding: 24px 30px;
        font-weight: 700;
        font-size: 1.4rem;
        background: linear-gradient(to right, #e3f2fd, #ffffff);
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #2d3436;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 18px;
        font-weight: 600;
        border-radius: 8px;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
        margin-right: 8px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 16px rgba(0, 86, 179, 0.5);
        transform: scale(1.05);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
        padding: 10px 18px;
        font-weight: 600;
        border-radius: 8px;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(108, 117, 125, 0.4);
    }

    .btn-secondary:hover {
        background-color: #545b62;
        box-shadow: 0 6px 16px rgba(84, 91, 98, 0.5);
        transform: scale(1.05);
    }

    /* Form Controls */
    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 12px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Filter Section */
    .row {
        margin-bottom: 20px;
    }

    #hasilTampil {
        color: #28a745;
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* Table styling */
    #dataTable {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        font-size: 0.85rem;
    }

    #dataTable thead tr {
        background-color: #2c3e50;
        color: #ecf0f1;
        text-align: center;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        display: table-row;
    }

    #dataTable th, #dataTable td {
        padding: 8px 12px;
        vertical-align: middle !important;
        transition: background-color 0.3s ease;
        text-align: center;
        font-size: 0.85rem;
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
        cursor: pointer;
    }

    #dataTable td {
        color: #34495e;
    }

    .card-body {
        padding: 30px;
    }

    /* Buttons */
    .btn-xs {
        padding: 0.2rem 0.4rem;
        font-size: 0.75rem;
        line-height: 1;
        border-radius: 4px;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 6px;
    }

    /* Responsive Mobile */
    @media (max-width: 767.98px) {
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

        /* Header card dengan background biru */
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
            font-size: 0.9rem;
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
            font-size: 0.85rem;
            margin-bottom: 2px;
        }

        /* Style khusus untuk field tertentu */
        #dataTable td[data-label="Nama Barang"]::before,
        #dataTable td[data-label="Jenis Barang"]::before,
        #dataTable td[data-label="Stok"]::before,
        #dataTable td[data-label="Satuan"]::before {
            color: #6b7280;
            font-weight: 500;
        }

        /* Hide nomor urut di mobile */
        #dataTable td[data-label="No"] {
            display: none;
        }

        /* Style untuk stok */
        #dataTable td[data-label="Stok"] {
            font-weight: 600;
            color: #059669;
        }

        /* Responsive untuk layar yang sangat kecil */
        @media (max-width: 480px) {
            #dataTable tr {
                margin-bottom: 1rem;
            }
            
            #dataTable td::before {
                width: 100px;
                font-size: 0.8rem;
            }
            
            #dataTable td {
                padding: 10px 15px;
                font-size: 0.85rem;
            }

            .col-md-6 {
                margin-bottom: 20px;
            }

            .form-control {
                width: 100% !important;
                margin-bottom: 10px;
            }
        }
    }

    /* Filter controls styling */
    .filter-controls {
        background: #f8fafc;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #e5e7eb;
    }

    .filter-controls select {
        margin-bottom: 10px;
        margin-right: 10px;
    }

    .filter-controls button {
        margin-right: 8px;
    }
</style>

<?php
$sql = "SELECT db.id_barang, db.nama_barang, jb.nama_jenis AS jenis_barang, db.stok, s.satuan 
FROM databarang db
JOIN jenisbarang jb ON db.id_jenis = jb.id_jenis
JOIN satuan s ON db.id_satuan = s.id_satuan";

$result = $conn->query($sql);
?>

<div class="container-fluid">
    <div class="bg-dasboard">
        <h1 class="mt-4 mb-4"><i class="fas fa-file"></i> Laporan Stok Barang</h1>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Stok barang tersedia</h5>
        </div>
        
        <div class="card-body p-3 p-md-4 bg-white rounded">
            <div class="filter-controls">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-sm" onclick="customPrint()">
                            <i class="fas fa-print mr-1"></i> Cetak
                        </button>
                        <p id="hasilTampil" class="mt-2"></p>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            for ($no = 1; $data = $result->fetch_assoc(); $no++) {
                        ?>
                                <tr>
                                    <td data-label="No"><?= $no ?></td>
                                    <td data-label="Nama Barang"><?= $data['nama_barang'] ?></td>
                                    <td data-label="Jenis Barang"><?= $data['jenis_barang'] ?></td>
                                    <td data-label="Stok"><?= $data['stok'] ?></td>
                                    <td data-label="Satuan"><?= $data['satuan'] ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function getTanggalSekarang() {
        const now = new Date();
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return now.toLocaleDateString('id-ID', options);
    }

    function getNamaFile() {
        const now = new Date();
        const year = now.getFullYear();
        const month = ("0" + (now.getMonth() + 1)).slice(-2); // Format MM
        const day = ("0" + now.getDate()).slice(-2); // Format DD
        return `Laporan_Stok_Barang_${day}-${month}-${year}`; // Format: Laporan_Stok_Barang_05-05-2025
    }

    function customPrint() {
        const table = document.getElementById("dataTable").outerHTML;
        const tanggalCetak = getTanggalSekarang();
        const judulLaporan = "Laporan Stok Barang";

        const logoURL = "logoBarokah.png"; // Ganti dengan path logo Anda jika perlu

        const printWindow = window.open('', '', 'height=800,width=1000');

        printWindow.document.write(`
        <html>
        <head>
            <title>${judulLaporan}</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                body {
                    padding: 30px;
                    font-family: Arial, sans-serif;
                }
                .kop {
                    text-align: center;
                    margin-bottom: 20px;
                    border-bottom: 2px solid #2c3e50;
                    padding-bottom: 15px;
                }
                .kop img {
                    max-width: 80px;
                    display: block;
                    margin: 0 auto 10px;
                }
                .kop h1 {
                    font-size: 20px;
                    margin: 0;
                    font-weight: bold;
                    color: #2c3e50;
                }
                .kop h2 {
                    font-size: 14px;
                    margin: 0;
                    font-weight: normal;
                    color: #34495e;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 30px;
                    border: 2px solid #2c3e50;
                }
                th, td {
                    text-align: center;
                    vertical-align: middle !important;
                    border: 1px solid #2c3e50;
                    padding: 8px;
                    font-size: 12px;
                }
                th {
                    background-color: #2c3e50;
                    color: #ecf0f1;
                    font-weight: bold;
                }
                tbody tr:nth-child(even) {
                    background-color: #f8f9fa;
                }
                tbody tr:nth-child(odd) {
                    background-color: #ffffff;
                }
                .print-date {
                    margin-top: 20px;
                    text-align: right;
                    font-size: 12px;
                    color: #6c757d;
                }
            </style>
        </head>
        <body>
            <div class="kop">
                <img src="${logoURL}" alt="Logo">
                <h1>Inventori Barokah Sedaya Usaha</h1>
                <h2>${judulLaporan}</h2>
                <h2>${tanggalCetak}</h2>
            </div>
            ${table}
            <div class="print-date">
                Dicetak pada: ${new Date().toLocaleString('id-ID')}
            </div>
        </body>
        </html>
        `);

        printWindow.document.close();
        printWindow.focus();

        printWindow.onload = function() {
            printWindow.print();
            printWindow.close();
        };
    }
</script>