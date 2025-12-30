<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Tambah pelanggan -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Masukkan Nama pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat pelanggan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">telepon</label>
                        <input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="Masukkan Nomor no_telepon" >
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
    $nama_pelanggan = trim($_POST['nama_pelanggan']);
    $alamat = trim($_POST['alamat']);
    $no_telepon = trim($_POST['no_telepon']);
    

    // Validasi apakah input kosong
    if (!empty($nama_pelanggan) && !empty($alamat)) {
        $sql = $conn->query("INSERT INTO pelanggan (nama_pelanggan, alamat, no_telepon) VALUES ('$nama_pelanggan', '$alamat', '$no_telepon')");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data pelanggan berhasil disimpan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '?page=pelanggan';
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data pelanggan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Peringatan!',
                text: 'Nama pelanggan, alamat, dan no_telepon tidak boleh kosong.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>