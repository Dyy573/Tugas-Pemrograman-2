<?php

$sessionUserId = $_SESSION['id_user'];

if (isset($_POST['simpan_masuk'])) {
    $kode_masuk = $_POST['kode_masuk'];
    $id_barangs = $_POST['id_barang'];
    $jumlahs = $_POST['jumlah'];
    $hargas = $_POST['harga'];
    $totals = $_POST['total'];
    $total_keseluruhan = $_POST['total_keseluruhan'];
    $id_supplier = $_POST['id_supplier'];
    $id_user = $_POST['id_user'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'] ?? '';

    foreach ($id_barangs as $i => $id_barang) {
        $jumlah = $jumlahs[$i];
        $harga = $hargas[$i];
        $total = $totals[$i];

        $conn->query("INSERT INTO barangmasuk (kode_masuk, id_barang, id_supplier, jumlah, harga, total, tanggal_masuk, keterangan, id_user)
            VALUES ('$kode_masuk', '$id_barang', '$id_supplier', '$jumlah', '$harga', '$total', '$tanggal', '$keterangan', '$id_user')");

        $conn->query("UPDATE databarang SET stok = stok + $jumlah WHERE id_barang = $id_barang");
    }

    echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Barang berhasil ditambahkan.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '?page=barangmasuk';
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

<!-- Modal Tambah Barang -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-row">
                        <?php
                        $tanggal_hari_ini = date('Ymd');
                        $prefix = "TRM-$tanggal_hari_ini";
                        $cekKode = $conn->query("SELECT kode_masuk FROM barangmasuk 
                            WHERE kode_masuk LIKE '$prefix%' 
                            ORDER BY kode_masuk DESC LIMIT 1");

                        if ($cekKode->num_rows > 0) {
                            $lastKode = $cekKode->fetch_assoc()['kode_masuk'];
                            $lastUrutan = (int)substr($lastKode, -3);
                            $nextUrutan = $lastUrutan + 1;
                        } else {
                            $nextUrutan = 1;
                        }

                        $kode = $prefix . "-" . str_pad($nextUrutan, 3, "0", STR_PAD_LEFT);
                        ?>
                        <div class="form-group col-md-4">
                            <label>Kode Transaksi</label>
                            <input type="text" name="kode_masuk" class="form-control" value="<?= $kode ?>" readonly required>
                        </div>

                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($sessionUserId) ?>">

                        

                        <div class="form-group col-md-4">
                            <label>Supplier</label>
                            <select name="id_supplier" class="form-control" required>
                                <option value="">-- Pilih Supplier --</option>
                                <?php
                                $supplier = $conn->query("SELECT * FROM supplier");
                                while ($s = $supplier->fetch_assoc()) {
                                    echo "<option value='{$s['id_supplier']}'>{$s['nama_supplier']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label><i class="fas fa-calendar mr-1"></i> Tanggal Masuk</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <hr>

                    <div id="barang-container"></div>
                    <button type="button" class="btn btn-success btn-sm mb-3" onclick="tambahBarang()">+ Tambah Barang</button>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label font-weight-bold">Total Keseluruhan</label>
                        <div class="col-md-4">
                            <input type="text" id="total-keseluruhan" class="form-control" readonly value="0">
                            <input type="hidden" name="total_keseluruhan" id="total-keseluruhan-hidden" value="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan (opsional)</label>
                        <textarea name="keterangan" class="form-control" placeholder="Keterangan umum transaksi"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan_masuk" class="btn btn-primary">Simpan Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function tambahBarang() {
        const container = document.getElementById("barang-container");
        const row = document.createElement("div");
        row.classList.add("row", "mb-3");

        row.innerHTML = `
        <div class="col-md-3">
            <label>Barang</label>
            <select name="id_barang[]" class="form-control barang-select"  onchange="updateHarga(this)">
                <option value="">-- Pilih Barang --</option>
                <?php
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
        <div class="col-md-2">
            <label>Harga</label>
            <input type="number" name="harga[]" class="form-control harga-saat-ini" >
        </div>
        <div class="col-md-2">
            <label>Jumlah</label>
            <input type="number" name="jumlah[]" class="form-control jumlah-input"   oninput="hitungJumlah(this); updateTotalRow(this);">
        </div>
        <div class="col-md-2">
            <label>Total</label>
            <input type="number" name="total[]" class="form-control total-row" readonly value="0">
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        `;

        container.appendChild(row);
    }

    function hapusBarang(btn) {
        btn.closest('.row').remove();
        updateTotalKeseluruhan();
    }

    function updateHarga(selectEl) {
        const harga = parseFloat(selectEl.options[selectEl.selectedIndex].getAttribute('data-harga')) || 0;
        const row = selectEl.closest('.row');
        row.querySelector('.harga-saat-ini').value = harga;
        row.querySelector('.jumlah-input').value = 1;
        row.querySelector('.total-row').value = harga.toFixed(2);
        updateTotalKeseluruhan();
    }

    function hitungJumlah(inputEl) {
        let jumlah = parseInt(inputEl.value) || 1;
        if (jumlah < 1) {
            inputEl.value = 1;
            jumlah = 1;
        }
    }

    function updateTotalRow(inputEl) {
        const row = inputEl.closest('.row');
        const harga = parseFloat(row.querySelector('.harga-saat-ini').value) || 0;
        const jumlah = parseInt(inputEl.value) || 1;
        const total = harga * jumlah;
        row.querySelector('.total-row').value = total.toFixed(2);

        updateTotalKeseluruhan();
    }

    function updateTotalKeseluruhan() {
        let total = 0;
        document.querySelectorAll('.total-row').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('total-keseluruhan').value = total.toFixed(2);
        document.getElementById('total-keseluruhan-hidden').value = total.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', tambahBarang);
</script>
