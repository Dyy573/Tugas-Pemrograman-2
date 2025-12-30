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

    #dataTable td[data-label="Detail Barang"] ul {
        padding-left: 18px;
        margin: 0;
        list-style-type: disc;
        color: #555;
        font-size: 0.9rem;
    }

    /* Buttons */
    .btn-xs {
        padding: 0.35rem 0.8rem;
        font-size: 0.85rem;
        line-height: 1;
        border-radius: 6px;
        transition: background-color 0.3s ease, color 0.3s ease;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .btn-warning.btn-xs {
        background-color: #f39c12;
        color: #fff;
        border: none;
    }
    .btn-warning.btn-xs:hover {
        background-color: #d68910cc;
        color: #fff;
        box-shadow: 0 4px 10px rgba(243,156,18,0.6);
    }

    .btn-danger.btn-xs {
        background-color: #e74c3c;
        color: #fff;
        border: none;
    }
    a.btn {
      color: #fff !important;          /* teks putih */
      text-decoration: none !important; /* hilangkan underline */
    }
    .btn-danger.btn-xs:hover {
        background-color: #c0392bcc;
        box-shadow: 0 4px 10px rgba(231,76,60,0.7);
    }

    .btn-xs i {
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

    /* Badge style */
    .badge {
        font-size: 0.85rem;
        padding: 4px 8px;
        border-radius: 8px;
        font-weight: 500;
    }

    .badge-warning {
        background-color: #f39c12;
        color: #fff;
    }

    .badge-success {
        background-color: #27ae60;
        color: #fff;
    }

    .badge-danger {
        background-color: #e74c3c;
        color: #fff;
    }

    .badge-secondary {
        background-color: #95a5a6;
        color: #fff;
    }

    .badge-info {
        background-color: #17a2b8;
        color: #fff;
        font-size: 0.85rem;
        padding: 4px 8px;
        border-radius: 8px;
        font-weight: 500;
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

        /* Badge status untuk Tanggal Keluar */
        #dataTable td[data-label="Tanggal Keluar"] .badge-info {
            background: #fbbf24;
            color: #92400e;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-top: 5px;
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
        #dataTable td[data-label="Pelanggan"]::before,
        #dataTable td[data-label="Tanggal Keluar"]::before,
        #dataTable td[data-label="User"]::before,
        #dataTable td[data-label="Status"]::before,
        #dataTable td[data-label="Keterangan"]::before {
            color: #6b7280;
            font-weight: 500;
        }

        /* Container untuk Detail Barang */
        #dataTable td[data-label="Detail Barang"] {
            background: #f8fafc;
            margin: 0 -20px;
            padding: 15px 20px;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
        }

        #dataTable td[data-label="Detail Barang"]::before {
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            width: 100%;
        }

        /* Style untuk list items */
        #dataTable td[data-label="Detail Barang"] ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        #dataTable td[data-label="Detail Barang"] li {
            background: #fff;
            padding: 10px 15px;
            margin: 8px 0;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            font-size: 0.9rem;
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

        /* Style untuk pelanggan dan user */
        #dataTable td[data-label="Pelanggan"],
        #dataTable td[data-label="User"] {
            font-weight: 500;
            color: #374151;
        }

        /* Style untuk keterangan */
        #dataTable td[data-label="Keterangan"] {
            color: #6b7280;
            font-style: italic;
        }

        /* Style untuk status */
        #dataTable td[data-label="Status"] .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-top: 5px;
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
        <h1 class="mt-4 mb-4"><i class="fas fa-box-open"></i> Transaksi Barang Keluar</h1>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Transaksi Keluar</h5>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formModal">
                <i class="fas fa-plus mr-1"></i> Tambah Barang Keluar
            </button>
        </div>

        <div class="card-body p-3 p-md-4 bg-white rounded">
            <div class="table-responsive">
                <table class="table table-borderless table-sm" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Detail Barang</th>
                            <th>Pelanggan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Keluar</th>
                            <th>Status</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $conn->query("
                            SELECT 
                                bk.kode_keluar,
                                GROUP_CONCAT(
                                    CONCAT(
                                        db.nama_barang, 
                                        ' (', bk.jumlah, ' ', s.satuan, 
                                        
                                        ')'
                                    ) 
                                    SEPARATOR '||'
                                ) AS detail_barang,
                                p.nama_pelanggan,
                                MAX(bk.keterangan) AS keterangan,
                                MAX(bk.tanggal_keluar) AS tanggal_keluar,
                                MAX(bk.status) AS status,
                                MAX(u.username) AS username,
                                MAX(bk.id_keluar) AS id_keluar,
                                SUM(bk.total) AS grand_total
                            FROM barangkeluar bk
                            JOIN databarang db ON bk.id_barang = db.id_barang
                            JOIN satuan s ON db.id_satuan = s.id_satuan
                            JOIN user u ON bk.id_user = u.id_user
                            LEFT JOIN pelanggan p ON bk.id_pelanggan = p.id_pelanggan
                            GROUP BY bk.kode_keluar
                            ORDER BY MAX(bk.id_keluar) DESC
                        ");

                        while ($data = $sql->fetch_assoc()) {
                        ?>
                            <tr style="cursor: pointer;" >
                                <td data-label="No"><?= $no++; ?></td>
                                <td data-label="Kode Transaksi" style="color:#2980b9; font-weight: 600; text-decoration:none;">
                                    <a href="?page=detailkeluar&kode=<?= $data['kode_keluar']; ?>" style="color:#2980b9; text-decoration:none;">
                                        <?= $data['kode_keluar']; ?>
                                    </a>
                                </td>
                                <td data-label="Detail Barang" class="text-left">
                                    <ul>
                                        <?php 
                                            $items = explode('||', $data['detail_barang']);
                                            foreach ($items as $item) {
                                                echo "<li>$item</li>";
                                            }
                                        ?>
                                    </ul>
                                </td>
                                <td data-label="Pelanggan"><?= htmlspecialchars($data['nama_pelanggan']); ?></td>
                                <td data-label="Keterangan"><?= htmlspecialchars($data['keterangan']); ?></td>
                                <td data-label="Tanggal Keluar">
                                    <span class="badge-info"><?= date('d-m-Y', strtotime($data['tanggal_keluar'])); ?></span>
                                </td>
                                <td data-label="Status" id="status-<?= $data['kode_keluar']; ?>">
                                    <span class="badge 
                                        <?= $data['status'] === 'dipinjam' ? 'badge-warning text-dark' : 
                                            ($data['status'] === 'selesai' ? 'badge-success text-white' : 
                                            ($data['status'] === 'ditolak' ? 'badge-danger text-white' : 'badge-secondary')); ?>">
                                        <?= $data['status']; ?>
                                    </span>
                                </td>
                                <td data-label="User"><?= htmlspecialchars($data['username']); ?></td>
                                <td data-label="Aksi">
                                    <!-- Kalau tombol edit dan hapus jangan sampai ikut klik ke detail -->
                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#formModal-edit-multi-<?= $data['kode_keluar']; ?>" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="confirmHapus('<?= $data['kode_keluar']; ?>')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                <?php require 'editkeluar.php'; ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php require 'tambahkeluar.php'; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmHapus(kode_keluar) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `?page=barangkeluar&aksi=hapuskeluar&kode_keluar=${kode_keluar}`;
            }
        });
    }

    function updateStatusKeluar() {
        fetch("page/barangkeluar/get_pending.php")
            .then(response => response.json())
            .then(data => {
                // Group data by kode_keluar for status updates
                const groupedStatus = {};
                data.forEach(item => {
                    if (!groupedStatus[item.kode_keluar]) {
                        groupedStatus[item.kode_keluar] = item.status;
                    }
                });

                // Update status for each group
                Object.keys(groupedStatus).forEach(kodeKeluar => {
                    const statusElement = document.getElementById(`status-${kodeKeluar}`);
                    if (statusElement) {
                        const status = groupedStatus[kodeKeluar];
                        let badgeClass = '';
                        if (status === 'dipinjam') {
                            badgeClass = 'badge-warning text-dark';
                        } else if (status === 'selesai') {
                            badgeClass = 'badge-success text-white';
                        } else if (status === 'ditolak') {
                            badgeClass = 'badge-danger text-white';
                        } else {
                            badgeClass = 'badge-secondary';
                        }

                        statusElement.innerHTML = `<span class="badge ${badgeClass}">${status}</span>`;
                    }
                });
            })
            .catch(error => console.error('Error updating status:', error));
    }

    window.onload = updateStatusKeluar;
    setInterval(updateStatusKeluar, 5000);
</script>