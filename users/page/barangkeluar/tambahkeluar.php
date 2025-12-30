<?php
$sessionUserId = $_SESSION['id_user'];
if (isset($_POST['simpan_keluar'])) {
    $kode_keluar = $_POST['kode_keluar'];
    $id_barangs = $_POST['id_barang'];
    $jumlahs = $_POST['jumlah'];
    $hargas = $_POST['harga'];
    $totals = $_POST['total'];
    $total_keseluruhan = $_POST['total_keseluruhan'];
    $tanggal = $_POST['tanggal'];
    $id_user = $_POST['id_user'];
    $keterangan = $_POST['keterangan'] ?? '';
    $status = 'dipinjam';
    $id_pelanggan = $_POST['id_pelanggan'];

    foreach ($id_barangs as $i => $id_barang) {
        $jumlah = $jumlahs[$i];
        $harga = $hargas[$i];
        $total = $totals[$i];

        // Cek stok barang
        $stok = $conn->query("SELECT stok FROM databarang WHERE id_barang = '$id_barang'")->fetch_assoc()['stok'];
        if ($jumlah > $stok) continue; // Lewati jika stok kurang

        // Simpan ke barangkeluar
        $conn->query("INSERT INTO barangkeluar 
        (kode_keluar, id_barang, id_pelanggan, jumlah, harga, total, tanggal_keluar, id_user, keterangan, status)
        VALUES 
        ('$kode_keluar', '$id_barang', '$id_pelanggan', '$jumlah', '$harga', '$total', '$tanggal', '$id_user', '$keterangan', '$status')");

        $conn->query("UPDATE databarang SET stok = stok - $jumlah WHERE id_barang = '$id_barang'");
    }

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data barang keluar berhasil disimpan.',
        }).then(() => {
            window.location.href = '?page=barangkeluar';
        });
    </script>";
}
?>

<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Tambah Barang Keluar -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-row">
                        <?php
                        $tanggal_hari_ini = date('Ymd');
                        $prefix = "TRK-$tanggal_hari_ini";
                        $cekKode = $conn->query("SELECT kode_keluar FROM barangkeluar 
                            WHERE kode_keluar LIKE '$prefix%' 
                            ORDER BY kode_keluar DESC LIMIT 1");

                        if ($cekKode->num_rows > 0) {
                            $lastKode = $cekKode->fetch_assoc()['kode_keluar'];
                            $lastUrutan = (int)substr($lastKode, -3);
                            $nextUrutan = $lastUrutan + 1;
                        } else {
                            $nextUrutan = 1;
                        }

                        $kode = $prefix . "-" . str_pad($nextUrutan, 3, "0", STR_PAD_LEFT);
                        ?>
                        <div class="form-group col-md-4">
                            <label>Kode Transaksi</label>
                            <input type="text" name="kode_keluar" class="form-control" value="<?= $kode ?>" readonly required>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Tanggal Keluar</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        
                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($sessionUserId) ?>">

                        

                        <div class="form-group col-md-4">
                            <label>Pelanggan</label>
                            <select name="id_pelanggan" class="form-control" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                <?php
                                $pelanggan = $conn->query("SELECT id_pelanggan, nama_pelanggan FROM pelanggan");
                                while ($p = $pelanggan->fetch_assoc()) {
                                    echo "<option value='{$p['id_pelanggan']}'>{$p['nama_pelanggan']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div id="barang-keluar-container"></div>
                    <button type="button" class="btn btn-success btn-sm mb-3" onclick="tambahBarangKeluar()">+ Tambah Barang</button>

                    <!-- Tambahan Total Keseluruhan -->
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label font-weight-bold">Total Keseluruhan</label>
                        <div class="col-md-4">
                            <input type="text" id="total-keseluruhan-keluar" class="form-control" readonly value="0">
                            <input type="hidden" name="total_keseluruhan" id="input-total-keseluruhan">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan (opsional)</label>
                        <textarea name="keterangan" class="form-control" placeholder="Keterangan umum transaksi(isi alamat untuk invoice)"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan_keluar" class="btn btn-primary">Simpan Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function tambahBarangKeluar() {
        const container = document.getElementById("barang-keluar-container");
        const row = document.createElement("div");
        row.classList.add("row", "mb-3");

        row.innerHTML = `
        <div class="col-md-3">
            <label>Barang</label>
            <select name="id_barang[]" class="form-control barang-select" required onchange="updateHargaKeluar(this)">
                <option value="">-- Pilih Barang --</option>
                <?php
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
        if ($b['stok'] <= 0) continue; // Lewati barang dengan stok 0
        $harga = isset($b['harga']) ? $b['harga'] : 0;
        echo "<option value='{$b['id_barang']}' data-harga='{$harga}' data-stok='{$b['stok']}'>
{$b['nama_barang']} (Stok: {$b['stok']})
</option>";
    }
    echo "</optgroup>";
}
?>

            </select>
        </div>
        <div class="col-md-2">
            <label>Harga</label>
            <input type="number" name="harga[]" class="form-control harga-saat-ini" >
        </div>
        <div class="col-md-2">
            <label>Jumlah</label>
            <input type="number" name="jumlah[]" class="form-control jumlah-input" required min="0" 
                   oninput="hitungJumlah(this); updateTotalRow(this);">
        </div>
        <div class="col-md-2">
            <label>Total Harga</label>
            <input type="number" class="form-control total-harga-row" readonly value="0">
            <input type="hidden" name="total[]" class="total-hidden">
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarangKeluar(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        `;

        container.appendChild(row);
    }

    function hapusBarangKeluar(btn) {
        btn.closest('.row').remove();
        updateTotalKeseluruhanKeluar();
    }

    function updateHargaKeluar(selectEl) {
    const option = selectEl.options[selectEl.selectedIndex];
    const harga = option.getAttribute('data-harga') || '0';
    const stok = option.getAttribute('data-stok') || '0';

    const row = selectEl.closest('.row');
    row.querySelector('.harga-saat-ini').value = harga;
    const jumlahInput = row.querySelector('.jumlah-input');
    jumlahInput.setAttribute('data-stok', stok);
    jumlahInput.value = '';

    row.querySelector('.total-harga-row').value = 0;
    row.querySelector('.total-hidden').value = 0;

    updateTotalKeseluruhanKeluar();
}


    function hitungJumlah(inputEl) {
        let jumlah = parseInt(inputEl.value) || 0;
        if (jumlah < 1) {
            inputEl.value = 1;
            jumlah = 1;
        }
    }

    function updateTotalRow(inputEl) {
    const row = inputEl.closest('.row');
    const harga = parseFloat(row.querySelector('.harga-saat-ini').value) || 0;
    const jumlah = parseInt(inputEl.value) || 0;
    const stok = parseInt(inputEl.getAttribute('data-stok')) || 0;

    if (jumlah > stok) {
        Swal.fire({
            icon: 'warning',
            title: 'Stok Tidak Cukup',
            text: `Jumlah melebihi stok (${stok} tersedia).`,
        });

        inputEl.value = stok;
        row.querySelector('.total-harga-row').value = (stok * harga).toFixed(2);
        row.querySelector('.total-hidden').value = (stok * harga).toFixed(2);
    } else {
        const totalHarga = harga * jumlah;
        row.querySelector('.total-harga-row').value = totalHarga.toFixed(2);
        row.querySelector('.total-hidden').value = totalHarga.toFixed(2);
    }

    updateTotalKeseluruhanKeluar();
}


    function updateTotalKeseluruhanKeluar() {
        let total = 0;
        document.querySelectorAll('.total-harga-row').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('total-keseluruhan-keluar').value = total.toFixed(2);
        document.getElementById('input-total-keseluruhan').value = total.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', tambahBarangKeluar);
</script>
