<?php $sessionUserId = $_SESSION['id_user']; ?>
<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<div class="modal fade" id="formModal-edit-multi-<?= $data['kode_masuk']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $data['kode_masuk']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $data['kode_masuk']; ?>">Edit Barang Masuk (Kode: <?= $data['kode_masuk']; ?>)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?php
                    $items = $conn->query("SELECT bm.*, db.nama_barang, satuan.satuan FROM barangmasuk bm
                        JOIN databarang db ON bm.id_barang = db.id_barang
                        JOIN satuan ON db.id_satuan = satuan.id_satuan
                        WHERE bm.kode_masuk = '{$data['kode_masuk']}'");

                    $totalKeseluruhan = 0;
                    ?>

                    <input type="hidden" name="kode_masuk" value="<?= $data['kode_masuk']; ?>">
                    <input type="hidden" name="id_user" value="<?= htmlspecialchars($sessionUserId); ?>">

                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d', strtotime($data['tanggal_masuk'])); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="id_supplier" class="form-control" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php
                            $supplier = $conn->query("SELECT id_supplier, nama_supplier FROM supplier");
                            while ($s = $supplier->fetch_assoc()) {
                                $selected = ($s['id_supplier'] == $data['id_supplier']) ? "selected" : "";
                                echo "<option value='{$s['id_supplier']}' $selected>{$s['nama_supplier']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div id="edit-barang-masuk-container-<?= $data['kode_masuk']; ?>">
                        <?php while ($item = $items->fetch_assoc()): 
                            $totalKeseluruhan += $item['total'];
                        ?>
                        <div class="row mb-3 edit-barang-row">
                            <input type="hidden" name="id_masuk[]" value="<?= $item['id_masuk']; ?>">
                            <div class="col-12 col-md-5">
                                <label>Barang</label>
                                <select name="id_barang[]" class="form-control barang-select" required onchange="updateHargaEdit(this)">
                                    <option value="">-- Pilih Barang --</option>
                                    <?php
                                    $jenisResult = $conn->query("SELECT * FROM jenisbarang");
                                    $jenisList = [];
                                    while ($j = $jenisResult->fetch_assoc()) {
                                        $jenisList[$j['id_jenis']] = $j['nama_jenis'];
                                    }

                                    $barangData = [];
                                    $barangResult = $conn->query("SELECT * FROM databarang");
                                    while ($b = $barangResult->fetch_assoc()) {
                                        $barangData[$b['id_jenis']][] = $b;
                                    }

                                    foreach ($barangData as $id_jenis => $barangs) {
                                        echo "<optgroup label='{$jenisList[$id_jenis]}'>";
                                        foreach ($barangs as $b) {
                                            $selected = ($b['id_barang'] == $item['id_barang']) ? "selected" : "";
                                            echo "<option value='{$b['id_barang']}' $selected>{$b['nama_barang']} ({$b['stok']})</option>";
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
                                <input type="number" name="jumlah[]" class="form-control jumlah-edit" value="<?= $item['jumlah']; ?>" required oninput="updateTotalEditRow(this)">
                            </div>
                            <div class="col-8 col-md-2">
                                <label>Total</label>
                                <input type="number" class="form-control total-edit" readonly value="<?= number_format($item['total'], 2, '.', ''); ?>">
                                <input type="hidden" name="total[]" class="total-edit-hidden" value="<?= number_format($item['total'], 2, '.', ''); ?>">
                            </div>
                            <div class="col-4 col-md-1 d-flex align-items-end">
                                <!-- Optional Delete Button -->
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>

                    <div class="form-group row">
                        <label class="col-6 col-md-3 font-weight-bold">Total Keseluruhan</label>
                        <div class="col-6 col-md-3">
                            <input type="text" id="total-keseluruhan-edit-<?= $data['kode_masuk']; ?>" class="form-control" readonly value="<?= number_format($totalKeseluruhan, 2, '.', ''); ?>">
                            <input type="hidden" name="total_keseluruhan" id="input-total-keseluruhan-edit-<?= $data['kode_masuk']; ?>" value="<?= number_format($totalKeseluruhan, 2, '.', ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan (opsional)</label>
                        <textarea name="keterangan" class="form-control"><?= htmlspecialchars($data['keterangan']); ?></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="update_masuk" class="btn btn-primary">Update Semua</button>
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

    function tambahEditBarangRow(kodeMasuk) {
        const container = document.getElementById(`edit-barang-masuk-container-${kodeMasuk}`);
        const row = document.createElement('div');
        row.classList.add('row', 'mb-3', 'edit-barang-row');

        row.innerHTML = `
            <input type="hidden" name="id_masuk[]" value="">
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

        const kodeMasuk = '<?= $data['kode_masuk']; ?>';

        document.getElementById(`total-keseluruhan-edit-${kodeMasuk}`).value = total.toFixed(2);
        document.getElementById(`input-total-keseluruhan-edit-${kodeMasuk}`).value = total.toFixed(2);
    }

    // Hitung total awal pas modal muncul
    document.addEventListener('DOMContentLoaded', () => {
        updateTotalKeseluruhanEdit();
    });
</script>

<?php
if (isset($_POST['update_masuk'])) {
    $kode_masuk = $_POST['kode_masuk'];
    $tanggal = $_POST['tanggal'];
    $id_supplier = $_POST['id_supplier'];
    $id_user = $_POST['id_user'];
    $keterangan = $_POST['keterangan'] ?? '';
    $total_keseluruhan = $_POST['total_keseluruhan'];

    $id_masuk_arr = $_POST['id_masuk'];
    $id_barang_arr = $_POST['id_barang'];
    $harga_arr = $_POST['harga'];
    $jumlah_arr = $_POST['jumlah'];
    $total_arr = $_POST['total'];

    // Update master data
    $stmtUpdateMaster = $conn->prepare("UPDATE barangmasuk SET tanggal_masuk=?, id_supplier=?, id_user=?, keterangan=? WHERE kode_masuk=?");
    $stmtUpdateMaster->bind_param('sisss', $tanggal, $id_supplier, $id_user, $keterangan, $kode_masuk);
    $stmtUpdateMaster->execute();
    $stmtUpdateMaster->close();

    foreach ($id_barang_arr as $index => $id_barang_baru) {
        $id_masuk = $id_masuk_arr[$index];
        $harga = $harga_arr[$index];
        $jumlah_baru = $jumlah_arr[$index];
        $total = $total_arr[$index];

        if (empty($id_masuk)) {
            // Tambah baru
            $conn->query("UPDATE databarang SET stok = stok + $jumlah_baru WHERE id_barang = '$id_barang_baru'");

            $stmtInsert = $conn->prepare("INSERT INTO barangmasuk (kode_masuk, id_barang, harga, jumlah, total, tanggal_masuk, id_supplier, id_user, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmtInsert->bind_param('siiddsiss', $kode_masuk, $id_barang_baru, $harga, $jumlah_baru, $total, $tanggal, $id_supplier, $id_user, $keterangan);
            $stmtInsert->execute();
            $stmtInsert->close();
        } else {
            // Update lama
            $resLama = $conn->query("SELECT id_barang, jumlah FROM barangmasuk WHERE id_masuk = '$id_masuk'");
            $dataLama = $resLama->fetch_assoc();
            $id_barang_lama = $dataLama['id_barang'];
            $jumlah_lama = $dataLama['jumlah'];

            // Update stok (kurangi stok lama, tambahkan stok baru)
            $conn->query("UPDATE databarang SET stok = stok - $jumlah_lama WHERE id_barang = '$id_barang_lama'");
            $conn->query("UPDATE databarang SET stok = stok + $jumlah_baru WHERE id_barang = '$id_barang_baru'");

            $stmtUpdate = $conn->prepare("UPDATE barangmasuk SET id_barang=?, harga=?, jumlah=?, total=?, tanggal_masuk=?, id_supplier=?, id_user=?, keterangan=? WHERE id_masuk=?");
            $stmtUpdate->bind_param('iiddsissi', $id_barang_baru, $harga, $jumlah_baru, $total, $tanggal, $id_supplier, $id_user, $keterangan, $id_masuk);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }
    }

    echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data barang masuk berhasil diperbarui.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '?page=barangmasuk';
        });
    </script>";
}
?>
