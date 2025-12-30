<?php
session_start();

// Redirect jika sudah login
if (isset($_SESSION['role'])) {
  switch ($_SESSION['role']) {
    case 'admin':
      header('Location: admin');
      exit();
    case 'users':
      header('Location: users');
      exit();
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Sistem</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(15px);
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
      width: 100%;
      max-width: 400px;
      animation: slideIn 0.8s ease-in-out forwards;
      transform: translateY(50px);
      opacity: 0;
    }

    @keyframes slideIn {
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
    }

    .form-control,
    .form-select {
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
      border: none;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .form-control::placeholder {
      color: #ccc;
    }

    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 0 2px #00bcd4;
      color: white;
    }

    .btn-custom {
      background: #00bcd4;
      border: none;
      padding: 10px;
      font-weight: bold;
      transition: all 0.3s ease-in-out;
      border-radius: 8px;
    }

    .btn-custom:hover {
      background: #0097a7;
      transform: scale(1.05);
    }

    label {
      font-size: 0.9rem;
    }
    option{
      color: black;
    }
  </style>
</head>

<body>

  <div class="login-box">
    <h2>Selamat Datang</h2>
    <form action="proses_login.php" method="POST">
      <div class="form-group">
        <label for="username">Nama Pengguna</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required>
      </div>
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan kata sandi" required>
      </div>
      <div class="form-group">
        <label for="role">Peran</label>
        <select class="form-control" name="role" id="role" required>
          <option value="">-- Pilih Peran --</option>
          <option value="admin">Admin</option>
          <option value="users">User</option>
        </select>
      </div>
      <button type="submit" class="btn btn-custom btn-block">Masuk</button>
    </form>
  </div>

</body>

</html>
