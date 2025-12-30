<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Tambah Supplier -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Masukkan Nama Supplier" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat Supplier" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Masukkan Nomor Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email Supplier">
                    </div>

                    <!-- Footer dengan tombol -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div> <!-- end of .modal-content -->
    </div> <!-- end of .modal-dialog -->
</div> <!-- end of .modal -->

<?php
if (isset($_POST['simpan'])) {
    $nama_supplier = trim($_POST['nama_supplier']);
    $alamat = trim($_POST['alamat']);
    $telepon = trim($_POST['telepon']);
    $email = trim($_POST['email']);

    // Validasi apakah input kosong
    if (!empty($nama_supplier) && !empty($alamat) && !empty($telepon)) {
        $sql = $conn->query("INSERT INTO supplier (nama_supplier, alamat, telepon, email) VALUES ('$nama_supplier', '$alamat', '$telepon', '$email')");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data supplier berhasil disimpan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '?page=supplier';
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data supplier.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Peringatan!',
                text: 'Nama supplier, alamat, dan telepon tidak boleh kosong.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>