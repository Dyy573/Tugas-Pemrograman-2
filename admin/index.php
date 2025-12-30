<?php
require '../koneksi.php';
require '../auth.php'; // Cek login
require '../auth_role.php';
require_role(['admin']); // hanya admin yang bisa akses
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventori Barokah</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
        <a class="navbar-brand" href="?page=home">Barokah Sedaya Usaha</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Menampilkan user yang sedang login -->
                        <div class="sb-sidenav-menu-heading text-center">
                            <!-- Menambahkan Logo di atas Teks -->
                            <img src="../images/logoBarokah.png" alt="Logo" class="img-fluid mb-2" style="max-width: 60px;">

                            <?php
                            // Mengambil role pengguna dari session
                            $role = isset($_SESSION['role']) ? $_SESSION['username'] : 'Tidak di Kenal'; // Default "Guest" jika tidak ada session
                            ?>

                            <div class="font-weight-bold" style="font-size: 16px;">Masuk sebagai :
                                <span class="text-uppercase" style="color: #28a745;">
                                    <?php echo ucfirst($role); // Menampilkan role dengan huruf pertama kapital 
                                    ?>
                                </span>
                            </div>

                        </div>

                        <!-- Menu utama -->
                        <a class="nav-link" href="?page=home">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Master</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                            Data
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="?page=databarang">Data Barang</a>
                                <a class="nav-link" href="?page=jenisbarang">Jenis Barang</a>
                                <a class="nav-link" href="?page=satuan">Satuan</a>
                                <a class="nav-link" href="?page=supplier">Data Supplier</a>
                                <a class="nav-link" href="?page=pelanggan">Data Pelanggan</a>
                                <a class="nav-link" href="?page=user">Data Pengguna</a>
                            </nav>
                        </div>

                        <div class="sb-sidenav-menu-heading">Transaksi</div>
                        <a class="nav-link" href="?page=barangmasuk">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-down"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="?page=barangkeluar">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-up"></i></div>
                            Barang Keluar
                        </a>

                        <div class="sb-sidenav-menu-heading">Notifikasi</div>
                        
                        <a class="nav-link" href="?page=inboxkeluar">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-up"></i></div>
                            Barang Dipinjam
                        </a>

                        <div class="sb-sidenav-menu-heading">Laporan</div>
                        <a class="nav-link" href="?page=laporan_barangmasuk">
                            <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                            Laporan Barang Masuk
                        </a>
                        <a class="nav-link" href="?page=laporan_barangkeluar">
                            <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                            Laporan Barang Keluar
                        </a>
                        <a class="nav-link" href="?page=laporan_stok">
                            <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                            Laporan Stok
                        </a>

                    </div>
                </div>
                <!-- Footer dengan tombol Logout -->
                <div class="sb-sidenav-footer bg-light text-center">
                    <a href="../logout.php" class="btn btn-danger w-100">Logout</a>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <!-- Content -->

                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : '';
                if (isset($_GET['aksi'])) {
                    $aksi = $_GET['aksi'];
                } else {
                    $aksi = ""; // atau tindakan lain jika key tidak ada
                }

                if ($page == "") {
                    include "home.php";
                }
                if ($page == "home") {
                    include "home.php";
                }

                if ($page == "databarang") {
                    if ($aksi == "") {
                        include "page/databarang/databarang.php";
                    }
                    if ($aksi == "hapusbarang") {
                        include "page/databarang/hapusdata.php";
                    }
                }

                if ($page == "jenisbarang") {
                    if ($aksi == "") {
                        include "page/jenisbarang/jenisbarang.php";
                    }
                    if ($aksi == "hapusjenis") {
                        include "page/jenisbarang/hapusjenis.php";
                    }
                }

                if ($page == "satuan") {
                    if ($aksi == "") {
                        include "page/satuan/satuan.php";
                    }
                    if ($aksi == "hapussatuan") {
                        include "page/satuan/hapussatuan.php";
                    }
                }

                if ($page == "supplier") {
                    if ($aksi == "") {
                        include "page/supplier/supplier.php";
                    }
                    if ($aksi == "hapussupplier") {
                        include "page/supplier/hapussupplier.php";
                    }
                }

                if ($page == "pelanggan") {
                    if ($aksi == "") {
                        include "page/pelanggan/pelanggan.php";
                    }
                    if ($aksi == "hapuspelanggan") {
                        include "page/pelanggan/hapuspelanggan.php";
                    }
                }

                if ($page == "user") {
                    if ($aksi == "") {
                        include "page/user/user.php";
                    }
                    if ($aksi == "hapususer") {
                        include "page/user/hapususer.php";
                    }
                }

                if ($page == "barangmasuk") {
                    if ($aksi == "") {
                        include "page/barangmasuk/barangmasuk.php";
                    }
                    if ($aksi == "hapusmasuk") {
                        include "page/barangmasuk/hapusmasuk.php";
                    }
                }

                if ($page == "barangkeluar") {
                    if ($aksi == "") {
                        include "page/barangkeluar/barangkeluar.php";
                    }
                    if ($aksi == "hapuskeluar") {
                        include "page/barangkeluar/hapuskeluar.php";
                    }
                }

                if ($page == "laporan_barangmasuk") {
                    if ($aksi == "") {
                        include "page/laporan/laporan_barangmasuk.php";
                    }
                }

                if ($page == "laporan_barangkeluar") {
                    if ($aksi == "") {
                        include "page/laporan/laporan_barangkeluar.php";
                    }
                }

                if ($page == "laporan_stok") {
                    if ($aksi == "") {
                        include "page/laporan/laporan_stok.php";
                    }
                }

                if ($page == "inboxmasuk") {
                    if ($aksi == "") {
                        include "page/inboxmasuk/pesanmasuk.php";
                    }
                }

                if ($page == "inboxkeluar") {
                    if ($aksi == "") {
                        include "page/inboxkeluar/pesanmasuk.php";
                    }
                }

                if ($page == "detailmasuk") {
                    if ($aksi == "") {
                        include "page/barangmasuk/detail.php";
                    }
                }

                if ($page == "detailkeluar") {
                    if ($aksi == "") {
                        include "page/barangkeluar/detail.php";
                    }
                }

                ?>

            </main>

            <footer class="py-4 mt-auto"></footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/datatables-demo.js"></script>

</body>

</html>