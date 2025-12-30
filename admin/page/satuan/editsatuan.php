<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Edit -->
<div class="modal fade" id="formModal-edit<?php echo $data['id_satuan']; ?>" tabindex="-1" role="dialog" aria-labelledby="formModalLabel<?php echo $data['id_satuan']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel<?php echo $data['id_satuan']; ?>">Edit Satuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" class="form-control" name="id_satuan" value="<?php echo $data['id_satuan']; ?>">

                    <div class="form-group">
                        <label for="satuan<?php echo $data['id_satuan']; ?>">Satuan</label>
                        <input type="text" class="form-control" name="satuan" id="satuan<?php echo $data['id_satuan']; ?>" value="<?php echo $data['satuan']; ?>" placeholder="Masukkan Nama Satuan" required>
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
    $id = $_POST['id_satuan'];
    $satuan = $_POST['satuan'];

    $update = $conn->query("UPDATE satuan SET satuan = '$satuan' WHERE id_satuan = '$id'");

    if ($update) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil diupdate.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?page=satuan';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Data gagal diupdate.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>