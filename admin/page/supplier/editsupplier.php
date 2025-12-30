<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Edit Supplier -->
<div class="modal fade" id="formModal-edit<?php echo $data['id_supplier']; ?>" tabindex="-1" role="dialog" aria-labelledby="formModalLabel<?php echo $data['id_supplier']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel<?php echo $data['id_supplier']; ?>">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" class="form-control" name="id_supplier" value="<?php echo $data['id_supplier']; ?>">

                    <div class="form-group">
                        <label for="nama_supplier<?php echo $data['id_supplier']; ?>">Nama Supplier</label>
                        <input type="text" class="form-control" name="nama_supplier" id="nama_supplier<?php echo $data['id_supplier']; ?>" value="<?php echo $data['nama_supplier']; ?>" placeholder="Masukkan Nama Supplier" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat<?php echo $data['id_supplier']; ?>">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat<?php echo $data['id_supplier']; ?>" placeholder="Masukkan Alamat Supplier" required><?php echo $data['alamat']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="telepon<?php echo $data['id_supplier']; ?>">Telepon</label>
                        <input type="text" class="form-control" name="telepon" id="telepon<?php echo $data['id_supplier']; ?>" value="<?php echo $data['telepon']; ?>" placeholder="Masukkan Nomor Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="email<?php echo $data['id_supplier']; ?>">Email</label>
                        <input type="email" class="form-control" name="email" id="email<?php echo $data['id_supplier']; ?>" value="<?php echo $data['email']; ?>" placeholder="Masukkan Email Supplier">
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
    $id = $_POST['id_supplier'];
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    $update = $conn->query("UPDATE supplier SET nama_supplier = '$nama_supplier', alamat = '$alamat', telepon = '$telepon', email = '$email' WHERE id_supplier = '$id'");

    if ($update) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data supplier berhasil diupdate.',
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
                text: 'Data supplier gagal diupdate.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>