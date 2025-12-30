<style>
    @media (max-width: 768px) {
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<!-- Modal Edit User -->
<div class="modal fade" id="formModal-edit<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="formModalLabel<?php echo $data['id_user']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel<?php echo $data['id_user']; ?>">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body dengan Form -->
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">

                    <div class="form-group">
                        <label for="username<?php echo $data['id_user']; ?>">Username</label>
                        <input type="text" class="form-control" name="username" id="username<?php echo $data['id_user']; ?>" value="<?php echo $data['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap<?php echo $data['id_user']; ?>">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap<?php echo $data['id_user']; ?>" value="<?php echo $data['nama_lengkap']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password Baru (Opsional)</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password Baru">
                    </div>
                    <div class="form-group">
                        <label for="role<?php echo $data['id_user']; ?>">Role</label>
                        <select class="form-control" name="role" id="role<?php echo $data['id_user']; ?>" required>
                            <option value="admin" <?php echo ($data['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="users" <?php echo ($data['role'] == 'users') ? 'selected' : ''; ?>>User</option>
                            
                        </select>
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
    $id = $_POST['id_user'];
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // 🔍 Cek apakah username sudah digunakan oleh user lain
    $cek = $conn->query("SELECT * FROM user WHERE username = '$username' AND id_user != '$id'");
    if ($cek->num_rows > 0) {
        // Username sudah ada → tampilkan pesan error
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Username sudah digunakan oleh user lain!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {
        // 🔧 Buat query UPDATE
        $updateQuery = "UPDATE user SET 
                        username = '$username', 
                        nama_lengkap = '$nama_lengkap', 
                        role = '$role'";

        // Tambahkan password hanya jika diisi
        if (!empty($password)) {
            $updateQuery .= ", password = '$password'";
        }

        $updateQuery .= " WHERE id_user = '$id'";

        // Jalankan query update
        $update = $conn->query($updateQuery);

        if ($update) {
            echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data user berhasil diupdate.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '?page=user';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengupdate data!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }
}
?>
