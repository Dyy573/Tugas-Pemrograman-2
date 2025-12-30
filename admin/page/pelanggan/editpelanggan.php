<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Edit pelanggan -->
<div class="modal fade" id="formModal-edit<?php echo $data['id_pelanggan']; ?>" tabindex="-1" role="dialog" aria-labelledby="formModalLabel<?php echo $data['id_pelanggan']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel<?php echo $data['id_pelanggan']; ?>">Edit pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" class="form-control" name="id_pelanggan" value="<?php echo $data['id_pelanggan']; ?>">

                    <div class="form-group">
                        <label for="nama_pelanggan<?php echo $data['id_pelanggan']; ?>">Nama pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan<?php echo $data['id_pelanggan']; ?>" value="<?php echo $data['nama_pelanggan']; ?>" placeholder="Masukkan Nama pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat<?php echo $data['id_pelanggan']; ?>">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat<?php echo $data['id_pelanggan']; ?>" placeholder="Masukkan Alamat pelanggan" required><?php echo $data['alamat']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon<?php echo $data['id_pelanggan']; ?>">Telepon</label>
                        <input type="text" class="form-control" name="no_telepon" id="no_telepon<?php echo $data['id_pelanggan']; ?>" value="<?php echo $data['no_telepon']; ?>" placeholder="Masukkan Nomor no_telepon" required>
                    </div>
                    

                    <!-- Footer dengan tombol -->
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
if (isset($_POST['edit'])) {
    $id = $_POST['id_pelanggan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    $update = $conn->query("UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', alamat = '$alamat', no_telepon = '$no_telepon' WHERE id_pelanggan = '$id'");

    if ($update) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data pelanggan berhasil diupdate.',
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
                text: 'Data pelanggan gagal diupdate.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>