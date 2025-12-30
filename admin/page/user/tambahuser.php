<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Tambah User -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role" required>
                            <option value="admin">Admin</option>
                            <option value="users">User</option>
                        </select>
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
if (isset($_POST['simpan'])) {
    $username = trim($_POST['username']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $role = trim($_POST['role']);
    $password = ($_POST['password']); // Mengamankan password

    // Validasi apakah input kosong
    if (!empty($username) && !empty($nama_lengkap) && !empty($role) && !empty($_POST['password'])) {
        $sql = $conn->query("INSERT INTO user (username, password, role, nama_lengkap) VALUES ('$username', '$password', '$role', '$nama_lengkap')");

        if ($sql) {
            echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'User berhasil ditambahkan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '?page=user';
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data user.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Peringatan!',
                text: 'Semua kolom harus diisi!',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>