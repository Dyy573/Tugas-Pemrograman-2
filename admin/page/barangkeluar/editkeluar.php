<?php
$sessionUserId = $_SESSION['id_user'];
?>

<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>


<div class="modal fade" id="formModal-edit-multi-<?= $data['kode_keluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $data['kode_keluar']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $data['kode_keluar']; ?>">Edit Barang Keluar (Kode: <?= $data['kode_keluar']; ?>)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?php
                    // Ambil data barang keluar per kode_keluar
                    $items = $conn->query("SELECT bk.*, db.nama_barang, satuan.satuan FROM barangkeluar bk 
                        JOIN databarang db ON bk.id_barang = db.id_barang
                        JOIN satuan ON db.id_satuan = satuan.id_satuan
                        WHERE bk.kode_keluar = '{$data['kode_keluar']}'");

                    $totalKeseluruhan = 0;
                    ?>

                    <input type="hidden" name="kode_keluar" value="<?= $data['kode_keluar']; ?>">
                    <input type="hidden" name="id_user" value="<?= htmlspecialchars($sessionUserId); ?>">

                    <div class="form-group">
                        <label>Tanggal Keluar</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d', strtotime($data['tanggal_keluar'])); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select name="id_pelanggan" class="form-control" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            <?php
                            $pelanggan = $conn->query("SELECT id_pelanggan, nama_pelanggan FROM pelanggan");
                            while ($p = $pelanggan->fetch_assoc()) {
                                $selected = ($p['id_pelanggan'] == $data['id_pelanggan']) ? "selected" : "";
                                echo "<option value='{$p['id_pelanggan']}' $selected>{$p['nama_pelanggan']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div id="edit-barang-keluar-container-<?= $data['kode_keluar']; ?>">
                        <?php while ($item = $items->fetch_assoc()): 
                            $totalKeseluruhan += $item['total'];
                        ?>
                        <div class="row mb-3 edit-barang-row">
                            <input type="hidden" name="id_keluar[]" value="<?= $item['id_keluar']; ?>">
                            <div class="col-12 col-md-5">
                                <label>Barang</label>
                                <select name="id_barang[]" class="form-control barang-select" required onchange="updateHargaEdit(this)">
                                    <option value="">-- Pilih Barang --</option>
                                    <?php
                                    // Dropdown barang per jenis
                                    $jenisResult = $conn->query("SELECT * FROM jenisbarang");
                                    $jenisList = [];
                                    while ($j = $jenisResult->fetch_assoc()) {
                                        $jenisList[$j['id_jenis']] = $j['nama_jenis'];
                                    }

                                    $barangData = [];
                                    $barangResult = $conn->query("SELECT databarang.* FROM databarang");
                                    while ($b = $barangResult->fetch_assoc()) {
                                        $barangData[$b['id_jenis']][] = $b;
                                    }

                                    foreach ($barangData as $id_jenis => $barangs) {
                                        echo "<optgroup label='{$jenisList[$id_jenis]}'>";
                                        foreach ($barangs as $b) {
                                            $harga = isset($b['harga']) ? $b['harga'] : 0;
                                            $selected = ($b['id_barang'] == $item['id_barang']) ? "selected" : "";
                                            echo "<option value='{$b['id_barang']}' data-harga='{$harga}' $selected>
                                                {$b['nama_barang']} ({$b['stok']})
                                            </option>";
                                        }
                                        echo "</optgroup>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="col-6 col-md-2">
                                <label>Harga</label>
                                <input type="number" name="harga[]" class="form-control harga-edit" value="<?= $item['harga']; ?>" required>
                            </div>
                            <div class="col-6 col-md-2">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah[]" class="form-control jumlah-edit" min="1" value="<?= $item['jumlah']; ?>" required
                                    oninput="updateTotalEditRow(this)">
                            </div>
                            <div class="col-8 col-md-2">
                                <label>Total Harga</label>
                                <input type="number" class="form-control total-edit" readonly value="<?= number_format($item['total'], 2, '.', ''); ?>">
                                <input type="hidden" name="total[]" class="total-edit-hidden" value="<?= number_format($item['total'], 2, '.', ''); ?>">
                            </div>
                            <div class="col-4 col-md-1 d-flex align-items-end">
                               
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>

                    

                    <div class="form-group row">
                        <label class="col-6 col-md-3 font-weight-bold">Total Keseluruhan</label>
                        <div class="col-6 col-md-3">
                            <input type="text" id="total-keseluruhan-edit-<?= $data['kode_keluar']; ?>" class="form-control" readonly value="<?= number_format($totalKeseluruhan, 2, '.', ''); ?>">
                            <input type="hidden" name="total_keseluruhan" id="input-total-keseluruhan-edit-<?= $data['kode_keluar']; ?>" value="<?= number_format($totalKeseluruhan, 2, '.', ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan (opsional)</label>
                        <textarea name="keterangan" class="form-control"><?= htmlspecialchars($data['keterangan']); ?></textarea>
                    </div>
                </div>
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="update_keluar" class="btn btn-primary">Update Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    function updateHargaEdit(selectEl) {
        const option = selectEl.options[selectEl.selectedIndex];
        const harga = option.getAttribute('data-harga') || '0';

        const row = selectEl.closest('.row');
        row.querySelector('.harga-edit').value = harga;
        updateTotalEditRow(row.querySelector('.jumlah-edit'));
    }

    function updateTotalEditRow(inputEl) {
        const row = inputEl.closest('.row');
        const harga = parseFloat(row.querySelector('.harga-edit').value) || 0;
        const jumlah = parseInt(inputEl.value) || 0;
        const total = harga * jumlah;

        row.querySelector('.total-edit').value = total.toFixed(2);
        row.querySelector('.total-edit-hidden').value = total.toFixed(2);

        updateTotalKeseluruhanEdit();
    }

    function hapusEditBarangRow(btn) {
        btn.closest('.row').remove();
        updateTotalKeseluruhanEdit();
    }

    function tambahEditBarangRow(kodeKeluar) {
        const container = document.getElementById(`edit-barang-keluar-container-${kodeKeluar}`);
        const row = document.createElement('div');
        row.classList.add('row', 'mb-3', 'edit-barang-row');

        row.innerHTML = `
            <input type="hidden" name="id_keluar[]" value="">
            <div class="col-12 col-md-5">
                <label>Barang</label>
                <select name="id_barang[]" class="form-control barang-select" required onchange="updateHargaEdit(this)">
                    <option value="">-- Pilih Barang --</option>
                    <?php
                    // Barang dropdown (PHP bagian ini akan ter-parse)
                    $jenisResult = $conn->query("SELECT * FROM jenisbarang");
                    $jenisList = [];
                    while ($j = $jenisResult->fetch_assoc()) {
                        $jenisList[$j['id_jenis']] = $j['nama_jenis'];
                    }
                    $barangData = [];
                    $barangResult = $conn->query("SELECT databarang.*, satuan.satuan FROM databarang 
                        JOIN satuan ON databarang.id_satuan = satuan.id_satuan");
                    while ($b = $barangResult->fetch_assoc()) {
                        $barangData[$b['id_jenis']][] = $b;
                    }

                    foreach ($barangData as $id_jenis => $barangs) {
                        echo "<optgroup label='{$jenisList[$id_jenis]}'>";
                        foreach ($barangs as $b) {
                            $harga = isset($b['harga']) ? $b['harga'] : 0;
                            echo "<option value='{$b['id_barang']}' data-harga='{$harga}'>
                                {$b['nama_barang']} ({$b['satuan']})
                            </option>";
                        }
                        echo "</optgroup>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <label>Harga</label>
                <input type="number" name="harga[]" class="form-control harga-edit" required>
            </div>
            <div class="col-6 col-md-2">
                <label>Jumlah</label>
                <input type="number" name="jumlah[]" class="form-control jumlah-edit" min="1" value="1" required oninput="updateTotalEditRow(this)">
            </div>
            <div class="col-8 col-md-2">
                <label>Total Harga</label>
                <input type="number" class="form-control total-edit" readonly value="0.00">
                <input type="hidden" name="total[]" class="total-edit-hidden" value="0.00">
            </div>
            <div class="col-4 col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusEditBarangRow(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
    }

    function updateTotalKeseluruhanEdit() {
        let total = 0;
        document.querySelectorAll('.total-edit').forEach(input => {
            total += parseFloat(input.value) || 0;
        });

        const kodeKeluar = '<?= $data['kode_keluar']; ?>';

        document.getElementById(`total-keseluruhan-edit-${kodeKeluar}`).value = total.toFixed(2);
        document.getElementById(`input-total-keseluruhan-edit-${kodeKeluar}`).value = total.toFixed(2);
    }

    // Hitung total awal pas modal muncul
    document.addEventListener('DOMContentLoaded', () => {
        updateTotalKeseluruhanEdit();
    });
</script>

<?php
// proses_edit_multi.php

// Koneksi database (sesuaikan dengan konfigurasi kamu)

if (isset($_POST['update_keluar'])) {
    $kode_keluar = $_POST['kode_keluar'];
    $tanggal = $_POST['tanggal'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_user = $_POST['id_user'];
    $keterangan = $_POST['keterangan'] ?? '';
    $total_keseluruhan = $_POST['total_keseluruhan'];

    // Data array barang
    $id_keluar_arr = $_POST['id_keluar'];      // bisa kosong string untuk item baru
    $id_barang_arr = $_POST['id_barang'];
    $harga_arr = $_POST['harga'];
    $jumlah_arr = $_POST['jumlah'];
    $total_arr = $_POST['total'];

    // Update tanggal, pelanggan, keterangan di tabel barangkeluar
    // Asumsi di tabel barangkeluar ada kolom: kode_keluar, tanggal_keluar, id_pelanggan, id_user, keterangan

    // Bisa update data master dulu jika ada tabel master, atau update semua record barangkeluar yg sesuai kode_keluar:
    // Misal update tanggal, id_pelanggan, keterangan di semua record barangkeluar dengan kode_keluar ini

    $stmtUpdateMaster = $conn->prepare("UPDATE barangkeluar SET tanggal_keluar=?, id_pelanggan=?, id_user=?, keterangan=? WHERE kode_keluar=?");
    $stmtUpdateMaster->bind_param('sisss', $tanggal, $id_pelanggan, $id_user, $keterangan, $kode_keluar);
    $stmtUpdateMaster->execute();
    $stmtUpdateMaster->close();

    // Loop update setiap item
    foreach ($id_barang_arr as $index => $id_barang_baru) {
    $id_keluar = $id_keluar_arr[$index];
    $harga = $harga_arr[$index];
    $jumlah_baru = $jumlah_arr[$index];
    $total = $total_arr[$index];

    // Ambil stok barang terbaru sebelum update/insert
    $stok = $conn->query("SELECT stok FROM databarang WHERE id_barang = '$id_barang_baru'")->fetch_assoc()['stok'];

    // Jika jumlah yang ingin keluar lebih besar dari stok, lewati update/insert barang ini
    if ($jumlah_baru > $stok) {
        // Bisa tambahkan alert atau log jika perlu
        continue;
    }

    if (empty($id_keluar)) {
    // Barang baru, coba update stok dengan syarat stok cukup
    $conn->query("UPDATE databarang SET stok = stok - $jumlah_baru WHERE id_barang = '$id_barang_baru' AND stok >= $jumlah_baru");

    if ($conn->affected_rows == 0) {
        // Stok tidak cukup, lewati atau beri pesan error
        echo "<div class='alert alert-danger'>Stok barang ID $id_barang_baru tidak cukup.</div>";
        continue;  // atau return; kalau mau hentikan proses
    }

    // Insert barangkeluar jika stok cukup
    $stmtInsert = $conn->prepare("INSERT INTO barangkeluar (id_keluar,kode_keluar, id_barang, harga, jumlah, total, tanggal_keluar, id_pelanggan, id_user, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    // Bind param & execute ...
} else {
    // Ambil data lama dulu
    $resLama = $conn->query("SELECT id_barang, jumlah FROM barangkeluar WHERE id_keluar = '$id_keluar'");
    $dataLama = $resLama->fetch_assoc();
    $id_barang_lama = $dataLama['id_barang'];
    $jumlah_lama = $dataLama['jumlah'];

    // Kembalikan stok lama dulu
    $conn->query("UPDATE databarang SET stok = stok + $jumlah_lama WHERE id_barang = '$id_barang_lama'");

    // Kurangi stok baru dengan syarat stok cukup
    $conn->query("UPDATE databarang SET stok = stok - $jumlah_baru WHERE id_barang = '$id_barang_baru' AND stok >= $jumlah_baru");

    if ($conn->affected_rows == 0) {
        // Stok tidak cukup, rollback stok lama dan beri pesan error
        // Kembalikan stok lama lagi supaya tetap balance
        $conn->query("UPDATE databarang SET stok = stok - $jumlah_lama WHERE id_barang = '$id_barang_lama'");
        echo "<div class='alert alert-danger'>Stok barang ID $id_barang_baru tidak cukup.</div>";
        continue;  // atau return; tergantung kebutuhan
    }

    // Update barangkeluar jika stok cukup
    $stmtUpdate = $conn->prepare("UPDATE barangkeluar SET id_barang=?, harga=?, jumlah=?, total=?, tanggal_keluar=?, id_pelanggan=?, id_user=?, keterangan=? WHERE id_keluar=?");
    // Bind param & execute ...
}

}



    // Redirect kembali ke halaman list atau tampilkan pesan sukses
   echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil diperbarui.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '?page=barangkeluar';
            }
        });
    </script>";
}
