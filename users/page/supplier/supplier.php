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
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 16px rgba(0, 86, 179, 0.5);
        transform: scale(1.05);
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
        display: table-row;
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
        cursor: pointer;
    }

    #dataTable td {
        text-align: center;
        color: #34495e;
    }

    #dataTable td.text-left {
        text-align: left;
        padding-left: 25px;
    }

    /* Buttons */
    .btn-xs, .btn-sm {
        padding: 0.35rem 0.8rem;
        font-size: 0.85rem;
        line-height: 1;
        border-radius: 6px;
        transition: background-color 0.3s ease, color 0.3s ease;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .btn-warning.btn-xs, .btn-warning.btn-sm {
        background-color: #f39c12;
        color: #fff;
        border: none;
    }
    .btn-warning.btn-xs:hover, .btn-warning.btn-sm:hover {
        background-color: #d68910cc;
        color: #fff;
        box-shadow: 0 4px 10px rgba(243,156,18,0.6);
    }

    .btn-danger.btn-xs, .btn-danger.btn-sm {
        background-color: #e74c3c;
        color: #fff;
        border: none;
    }
    a.btn {
      color: #fff !important;          /* teks putih */
      text-decoration: none !important; /* hilangkan underline */
    }
    .btn-danger.btn-xs:hover, .btn-danger.btn-sm:hover {
        background-color: #c0392bcc;
        box-shadow: 0 4px 10px rgba(231,76,60,0.7);
    }

    .btn-xs i, .btn-sm i {
        vertical-align: middle;
    }

    /* Link improvements */
    #dataTable a {
        color: #3498db;
        font-weight: 600;
        transition: color 0.3s ease;
        text-decoration: none;
    }

    #dataTable a:hover {
        color: #1d6fa5;
        text-decoration: underline;
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

        /* Nama Supplier di bagian atas dengan style khusus */
        #dataTable td[data-label="Nama Supplier"] {
            background: #f8fafc;
            padding: 15px 20px 10px 20px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #3b82f6;
            border-bottom: 1px solid #e5e7eb;
            letter-spacing: 0.5px;
        }

        #dataTable td[data-label="Nama Supplier"]::before {
            display: none;
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

        /* Style khusus untuk field tertentu */
        #dataTable td[data-label="Alamat"]::before,
        #dataTable td[data-label="Telepon"]::before,
        #dataTable td[data-label="Email"]::before {
            color: #6b7280;
            font-weight: 500;
        }

        /* Container untuk tombol aksi */
        #dataTable td[data-label="Aksi"] {
            background: #f8fafc;
            margin: 0 -20px;
            padding: 15px 20px;
            text-align: center !important;
        }

        #dataTable td[data-label="Aksi"]::before {
            display: none;
        }

        #dataTable td[data-label="Aksi"] .btn {
            margin: 0 6px 8px 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
            border: none;
            min-width: 80px;
        }

        #dataTable td[data-label="Aksi"] .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        /* Button colors */
        #dataTable td[data-label="Aksi"] .btn-warning {
            background: #f59e0b;
            color: white;
        }

        #dataTable td[data-label="Aksi"] .btn-danger {
            background: #ef4444;
            color: white;
        }

        #dataTable td[data-label="Aksi"] .btn-primary {
            background: #3b82f6;
            color: white;
        }

        /* Hide nomor urut di mobile */
        #dataTable td[data-label="No"] {
            display: none;
        }

        /* Style untuk alamat, telepon, email */
        #dataTable td[data-label="Alamat"],
        #dataTable td[data-label="Telepon"],
        #dataTable td[data-label="Email"] {
            font-weight: 400;
            color: #374151;
        }

        /* Responsive untuk layar yang sangat kecil */
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
            
            #dataTable td[data-label="Aksi"] .btn {
                display: block;
                width: 100%;
                margin: 0 0 8px 0;
            }
        }
    }
</style>

<div class="container-fluid">
    <div class="bg-dashboard">
        <h1 class="mt-4 mb-4"><i class="fas fa-database"></i> Data Supplier</h1>
    </div>
    
    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Data Supplier</h5>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formModal">
                <i class="fas fa-plus mr-1"></i> Tambah Supplier
            </button>
        </div>
        
        <div class="card-body p-3 p-md-4 bg-white rounded">
            <div class="table-responsive">
                <table class="table table-borderless table-sm" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $conn->query("SELECT * FROM supplier");
                        while ($data = $sql->fetch_assoc()) {
                        ?>
                            <tr>
                                <td data-label="No"><?php echo $no++; ?></td>
                                <td data-label="Nama Supplier" style="color:#2980b9; font-weight: 600;">
                                    <?php echo htmlspecialchars($data['nama_supplier']); ?>
                                </td>
                                <td data-label="Alamat"><?php echo htmlspecialchars($data['alamat']); ?></td>
                                <td data-label="Telepon"><?php echo htmlspecialchars($data['telepon']); ?></td>
                                <td data-label="Email"><?php echo htmlspecialchars($data['email']); ?></td>
                                <td data-label="Aksi">
                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#formModal-edit<?php echo $data['id_supplier']; ?>" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs" onclick="hapusSupplier('<?php echo $data['id_supplier']; ?>')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                <?php require 'editsupplier.php'; ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php require 'tambahsupplier.php'; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function hapusSupplier(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data supplier ini akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '?page=supplier&aksi=hapussupplier&id=' + id;
            }
        });
    }
</script>