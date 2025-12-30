<?php
$conn = mysqli_connect("localhost", "root", "", "db_bsu");

// Menyetujui banyak barang keluar sekaligus
if (isset($_GET['selesai'])) {
    $ids = explode(',', $_GET['selesai']);

    foreach ($ids as $id) {
        $id = (int)$id;

        $result = $conn->query("SELECT id_barang, jumlah FROM barangkeluar WHERE id_keluar = $id AND status = 'dipinjam'");
        if ($result && $result->num_rows > 0) {
            $item = $result->fetch_assoc();

            // Setuju dan kurangi stok
            $conn->query("UPDATE barangkeluar SET status = 'selesai' WHERE id_keluar = $id");

            $id_barang = (int)$item['id_barang'];
            $jumlah = (int)$item['jumlah'];
            $conn->query("UPDATE databarang SET stok = stok + $jumlah WHERE id_barang = $id_barang");
        }
    }

    header("Location: ../../index.php?page=inboxkeluar");
    exit;
}

// Menolak barang keluar
if (isset($_GET['ditolak'])) {
    $ids = explode(',', $_GET['ditolak']);

    foreach ($ids as $id) {
        $id = (int)$id;

        $result = $conn->query("SELECT id_keluar FROM barangkeluar WHERE id_keluar = $id AND status = 'dipinjam'");
        if ($result && $result->num_rows > 0) {
            $conn->query("UPDATE barangkeluar SET status = 'ditolak' WHERE id_keluar = $id");
        }
    }

    header("Location: ../../index.php?page=inboxkeluar");
    exit;
}
?>

<div class="container-fluid">
    <div class="bg-dashboard">
        <h1 class="mt-4 mb-4"><i class="fas fa-database"></i> Barang Keluar</h1>
        <button onclick="terimaSemua()" class="btn btn-success btn-sm mb-3">✅ Selesaikan Semua</button>
    </div>

    <div id="inbox-container"></div>
</div>

<script>
    function loadInbox() {
        fetch("page/inboxkeluar/get_pending.php")
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById("inbox-container");
                container.innerHTML = "";

                if (data.length === 0) {
                    container.innerHTML = `<div class="alert alert-info">Tidak ada permintaan baru untuk barang keluar.</div>`;
                    return;
                }

                data.forEach(item => {
                    const card = document.createElement("div");
                    card.className = "card mb-3 shadow-sm";

                    const idList = item.id_keluar.split(','); // untuk tombol terima/tolak
                    const itemList = createItemTable(item.nama_barang, item.jumlah);

                    card.innerHTML = `
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Kode Transaksi: <strong>${item.kode_keluar}</strong></h5>
                                    <p class="card-text">Tanggal Keluar: ${item.tanggal_keluar}</p>
                                    <p class="card-text">Keterangan: ${item.keterangan.split(',')[0]}</p>
                                    <a href="page/inboxkeluar/pesanmasuk.php?selesai=${idList.join(',')}" class="btn btn-success btn-sm mr-2">✅ Selesaikan</a>
                                    
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered table-sm mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Barang</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${itemList}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    `;

                    container.appendChild(card);
                });
            });
    }

    function createItemTable(namaBarangStr, jumlahStr) {
        const namaBarang = namaBarangStr.split(",");
        const jumlah = jumlahStr.split(",");
        let rows = "";
        for (let i = 0; i < namaBarang.length; i++) {
            rows += `<tr><td>${namaBarang[i]}</td><td class="text-right">${jumlah[i]}</td></tr>`;
        }
        return rows;
    }

    function terimaSemua() {
        Swal.fire({
            title: "Yakin ingin menyetujui semua barang keluar?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Terima Semua"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("page/inboxkeluar/terima_semua.php")
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Semua barang keluar berhasil selesai.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            loadInbox();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: result.message || 'Terjadi kesalahan.'
                            });
                        }
                    }).catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan!',
                            text: 'Tidak dapat terhubung ke server.'
                        });
                    });
            }
        });
    }

    loadInbox();
    setInterval(loadInbox, 5000);
</script>