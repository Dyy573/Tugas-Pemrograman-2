<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Edit -->
<div class="modal fade" id="formModal-edit<?php echo $data['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="formModalLabel<?php echo $data['id_barang']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel<?php echo $data['id_barang']; ?>">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" value="<?php echo $data['nama_barang']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Barang</label>
                        <select name="id_jenis" class="form-control" required>
                            <?php
                            $jenis_query = $conn->query("SELECT * FROM jenisbarang");
                            while ($jenis = $jenis_query->fetch_assoc()) {
                                $selected = ($jenis['id_jenis'] == $data['id_jenis']) ? 'selected' : '';
                                echo "<option value='" . $jenis['id_jenis'] . "' $selected>" . $jenis['nama_jenis'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Satuan</label>
                        <select name="id_satuan" class="form-control" required>
                            <?php
                            $satuan_query = $conn->query("SELECT * FROM satuan");
                            while ($satuan = $satuan_query->fetch_assoc()) {
                                $selected = ($satuan['id_satuan'] == $data['id_satuan']) ? 'selected' : '';
                                echo "<option value='" . $satuan['id_satuan'] . "' $selected>" . $satuan['satuan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- ✅ Tambahkan dropdown supplier -->
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="id_supplier" class="form-control" required>
                            <option value="">Pilih Supplier</option>
                            <?php
                            $supplier_query = $conn->query("SELECT * FROM supplier ORDER BY nama_supplier");
                            while ($supplier = $supplier_query->fetch_assoc()) {
                                $selected = ($supplier['id_supplier'] == $data['id_supplier']) ? 'selected' : '';
                                echo "<option value='" . $supplier['id_supplier'] . "' $selected>" . $supplier['nama_supplier'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" class="form-control" name="stok" value="<?php echo $data['stok']; ?>" required>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
// Update data barang
if (isset($_POST['edit'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $id_jenis = $_POST['id_jenis'];
    $id_satuan = $_POST['id_satuan'];
    $id_supplier = $_POST['id_supplier']; // ✅ Tambahkan
    $stok = $_POST['stok'];

    $sql = $conn->query("UPDATE databarang 
                         SET nama_barang='$nama_barang', 
                             id_jenis='$id_jenis', 
                             id_satuan='$id_satuan', 
                             stok='$stok', 
                             id_supplier='$id_supplier' 
                         WHERE id_barang='$id_barang'");

    if ($sql) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil diupdate!',
                icon: 'success',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?page=databarang';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Gagal mengupdate data',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>