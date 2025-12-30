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

    .bg-dashboard h1 {
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

    /* Link styling untuk kode transaksi */
    #dataTable a {
        color: #2980b9;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    #dataTable a:hover {
        color: #1d6fa5;
        text-decoration: underline;
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

        /* Kode Transaksi di bagian atas dengan style khusus */
        #dataTable td[data-label="Kode Transaksi"] {
            background: #f8fafc;
            padding: 15px 20px 10px 20px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #3b82f6;
            border-bottom: 1px solid #e5e7eb;
            letter-spacing: 0.5px;
        }

        #dataTable td[data-label="Kode Transaksi"]::before {
            display: none;
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
        #dataTable td[data-label="Jumlah"]::before,
        #dataTable td[data-label="Satuan"]::before,
        #dataTable td[data-label="Harga"]::before,
        #dataTable td[data-label="Total"]::before,
        #dataTable td[data-label="Nama Supplier"]::before,
        #dataTable td[data-label="Tanggal Masuk"]::before,
        #dataTable td[data-label="Keterangan"]::before {
            color: #6b7280;
            font-weight: 500;
        }

        /* Hide nomor urut di mobile */
        #dataTable td[data-label="No"] {
            display: none;
        }

        /* Style untuk harga dan total */
        #dataTable td[data-label="Harga"],
        #dataTable td[data-label="Total"] {
            font-weight: 600;
            color: #059669;
        }

        /* Style untuk tanggal */
        #dataTable td[data-label="Tanggal Masuk"] {
            background: #f0f9ff;
            color: #0369a1;
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

<div class="container-fluid">
    <div class="bg-dashboard">
        <h1 class="mt-4 mb-4"><i class="fas fa-file"></i> Laporan Barang Masuk</h1>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Transaksi Masuk</h5>
        </div>
        
        <div class="card-body p-3 p-md-4 bg-white rounded">
            <div class="filter-controls">
                <div class="row">
                    <div class="col-md-6">
                        <select id="bulan" class="form-control mb-2" style="width: 250px;">
                            <option value="all">Semua</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <select id="tahun" class="form-control mb-2" style="width: 250px;">
                            <option value="all">Semua</option>
                        </select>

                        <button id="tampilkanBtn" class="btn btn-primary btn-sm">
                            <i class="fas fa-search mr-1"></i> Tampilkan
                        </button>

                        <button class="btn btn-secondary btn-sm" onclick="customPrint()">
                            <i class="fas fa-print mr-1"></i> Cetak
                        </button>
                        <p id="hasilTampil" class="mt-2"></p>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-sm" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Nama Supplier</th>
                            <th>Tanggal Masuk</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="dataRows">
                        <!-- Data akan dimuat di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Mendapatkan tahun saat ini
    const currentYear = new Date().getFullYear();

    // Menentukan jumlah tahun yang akan ditampilkan
    const yearsToShow = 10; // Misalnya, menampilkan 10 tahun kedepan

    // Mendapatkan elemen select
    const tahunSelect = document.getElementById('tahun');

    // Menambahkan tahun ke dalam select
    for (let i = 0; i < yearsToShow; i++) {
        const yearOption = document.createElement('option');
        yearOption.value = currentYear + i;
        yearOption.textContent = currentYear + i;
        tahunSelect.appendChild(yearOption);
    }

    document.addEventListener("DOMContentLoaded", () => {
        const tampilkanBtn = document.getElementById("tampilkanBtn");

        tampilkanBtn.addEventListener("click", () => {
            const bulan = document.getElementById("bulan").value;
            const tahun = document.getElementById("tahun").value;

            const bulanNama = {
                "01": "Januari",
                "02": "Februari",
                "03": "Maret",
                "04": "April",
                "05": "Mei",
                "06": "Juni",
                "07": "Juli",
                "08": "Agustus",
                "09": "September",
                "10": "Oktober",
                "11": "November",
                "12": "Desember",
                "all": "Semua Bulan"
            };

            const tampilText = `Menampilkan data untuk: ${bulanNama[bulan]} ${tahun}`;
            document.getElementById("hasilTampil").innerText = tampilText;

            Swal.fire({
                icon: 'success',
                title: 'Data Ditampilkan',
                text: tampilText,
                timer: 2000,
                showConfirmButton: false
            });

            fetch(`page/laporan/get_transaksi_barang_masuk.php?bulan=${bulan}&tahun=${tahun}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Data diterima:", data); // Memeriksa data yang diterima

                    const dataRows = document.getElementById("dataRows");
                    if (data.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Kosong',
                            text: 'Tidak ada data untuk bulan dan tahun ini.',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        dataRows.innerHTML = '';
                        return;
                    }

                    // Menyusun data berdasarkan kode_masuk
                    const groupedData = {};

                    // Kelompokkan data berdasarkan kode_masuk
                    data.forEach(item => {
                        if (!groupedData[item.kode_masuk]) {
                            groupedData[item.kode_masuk] = {
                                kode_masuk: item.kode_masuk,
                                items: []
                            };
                        }
                        item.items.forEach(subItem => {
                            // Pastikan untuk mengganti data yang kosong menjadi default (misalnya '-')
                            groupedData[item.kode_masuk].items.push({
                                nama_barang: subItem.nama_barang || '-',
                                jumlah: subItem.jumlah || '-',
                                satuan: subItem.satuan || '-',
                                harga: subItem.harga || '-',
                                total: subItem.total || '-',
                                nama_supplier: subItem.nama_supplier || '-',
                                tanggal_masuk: subItem.tanggal_masuk || '-',
                                keterangan: subItem.keterangan || '-'
                            });
                        });
                    });

                    let rows = '';
                    let no = 1;

                    Object.values(groupedData).forEach(group => {
                        let rowContent = `
                            <tr>
                                <td data-label="No" rowspan="${group.items.length}">${no++}</td>
                                <td data-label="Kode Transaksi" rowspan="${group.items.length}">
                                    <a href="page/barangmasuk/detail.php?kode=${group.kode_masuk}">
                                        ${group.kode_masuk}
                                    </a>
                                </td>
                        `;

                        group.items.forEach((item, index) => {
                            if (index > 0) {
                                rowContent += '<tr>';
                            }

                            rowContent += `
                                <td data-label="Nama Barang">${item.nama_barang}</td>
                                <td data-label="Jumlah">${item.jumlah}</td>
                                <td data-label="Satuan">${item.satuan}</td>
                                <td data-label="Harga">${item.harga}</td>
                                <td data-label="Total">${item.total}</td>
                                <td data-label="Nama Supplier">${item.nama_supplier}</td>
                                <td data-label="Tanggal Masuk">${item.tanggal_masuk}</td>
                                <td data-label="Keterangan">${item.keterangan}</td>
                            </tr>
                            `;
                        });

                        rows += rowContent;
                    });

                    dataRows.innerHTML = rows;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('Terjadi kesalahan saat mengambil data.');
                });
        });
    });

    function customPrint() {
        const bulan = document.getElementById("bulan").value;
        const tahun = document.getElementById("tahun").value;

        const bulanNama = {
            "01": "Januari",
            "02": "Februari",
            "03": "Maret",
            "04": "April",
            "05": "Mei",
            "06": "Juni",
            "07": "Juli",
            "08": "Agustus",
            "09": "September",
            "10": "Oktober",
            "11": "November",
            "12": "Desember",
            "all": "Semua Bulan"
        };

        const judulLaporan = `Laporan Barang Masuk - ${bulanNama[bulan]} ${tahun}`;
        const table = document.getElementById("dataTable").outerHTML;

        const logoURL = "logoBarokah.png";

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
                }
                .kop h2 {
                    font-size: 16px;
                    margin: 0;
                    font-weight: normal;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 30px;
                }
                th, td {
                    text-align: center;
                    vertical-align: middle !important;
                    border: 1px solid #ddd;
                    padding: 6px;
                    font-size: 12px;
                }
                th {
                    background-color: #f8f9fa;
                }
            </style>
        </head>
        <body>
            <div class="kop">
                <img src="${logoURL}" alt="Logo">
                <h1>Inventori Barokah Sedaya Usaha</h1>
                <h2>${judulLaporan}</h2>
            </div>
            ${table}
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