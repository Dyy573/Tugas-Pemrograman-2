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
                <h5 class="modal-title" id="formModalLabel">Tambah Satuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Masukkan Nama Satuan" required>
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
    $satuan = trim($_POST['satuan']);

    // Validasi apakah input kosong
    if (!empty($satuan)) {
        $sql = $conn->query("INSERT INTO satuan (satuan) VALUES ('$satuan')");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil disimpan.',
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
                    text: 'Terjadi kesalahan saat menyimpan data.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Peringatan!',
                text: 'Satuan tidak boleh kosong.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>