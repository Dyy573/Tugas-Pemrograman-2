<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Tambah -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id_barang" placeholder="Masukkan ID Barang" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" placeholder="Masukkan Nama Barang" required>
                    </div>

                    <div class="form-group">
                        <label for="id_jenis">Jenis Barang</label>
                        <select name="id_jenis" class="form-control" required>
                            <option value="">Pilih Jenis Barang</option>
                            <?php
                            $sql = $conn->query("SELECT * FROM jenisbarang ORDER BY id_jenis");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='{$data['id']}.{$data['id_jenis']}'>{$data['nama_jenis']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_satuan">Satuan</label>
                        <select name="id_satuan" class="form-control" required>
                            <option value="">Pilih Satuan</option>
                            <?php
                            $sql = $conn->query("SELECT * FROM satuan ORDER BY id_satuan");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='{$data['id']}.{$data['id_satuan']}'>{$data['satuan']}</option>";
                            }
                            ?>
                        </select>
                    </div>

            
                    

                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" name="stok" placeholder="Masukkan Stok Barang" value="0" required readonly>
                    </div>

                    <!-- Footer dengan tombol -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Simpan data barang baru
if (isset($_POST['simpan'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];

    // Pecah id_jenis
    $id_jenis = $_POST['id_jenis'];
    $pecah_jenis = explode(".", $id_jenis);
    $id_jenis = $pecah_jenis[1];

    // Pecah id_satuan
    $id_satuan = $_POST['id_satuan'];
    $pecah_satuan = explode(".", $id_satuan);
    $id_satuan = $pecah_satuan[1];

    $stok = $_POST['stok'];
   

    // Simpan ke database
    $sql = $conn->query("INSERT INTO databarang 
        (id_barang, nama_barang, id_jenis, id_satuan, stok) 
        VALUES 
        ('$id_barang', '$nama_barang', '$id_jenis', '$id_satuan', '$stok')");

    // Feedback
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    if ($sql) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil disimpan!',
                    showConfirmButton: true
                }).then(function() {
                    window.location.href = '?page=databarang';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menyimpan data',
                    text: 'Terjadi kesalahan saat menyimpan data.',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
}
?>