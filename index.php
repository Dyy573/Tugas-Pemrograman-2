<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Barokah Sedaya Usaha - Sistem Inventori</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes glow {
      0%, 100% {
        box-shadow: 0 0 15px #3b82f6, 0 0 30px #3b82f6;
      }
      50% {
        box-shadow: 0 0 40px #60a5fa, 0 0 60px #60a5fa;
      }
    }

    @keyframes slideIn {
      0% {
        opacity: 0;
        transform: translateY(60px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes flash {
      0%, 100% {
        opacity: 0.2;
      }
      50% {
        opacity: 1;
      }
    }

    @keyframes progress {
      0% {
        width: 0%;
      }
      100% {
        width: 100%;
      }
    }

    .glow {
      animation: glow 2.5s infinite ease-in-out;
    }

    .fade-slide-in {
      animation: slideIn 1.3s ease-out forwards;
    }

    .dot-flash span {
      animation: flash 1.2s infinite;
    }

    .dot-flash span:nth-child(2) {
      animation-delay: 0.2s;
    }

    .dot-flash span:nth-child(3) {
      animation-delay: 0.4s;
    }

    .progress-bar {
      animation: progress 4.5s ease-out forwards;
    }
  </style>
  <script>
    setTimeout(() => {
      window.location.href = "login.php";
    }, 4500);
  </script>
</head>

<body class="bg-gradient-to-tr from-blue-950 via-blue-900 to-blue-800 min-h-screen flex items-center justify-center text-white font-sans relative overflow-hidden">

  <!-- Animasi Background Blur -->
  <div class="absolute w-[600px] h-[600px] bg-blue-500 bg-opacity-20 blur-3xl top-[-200px] left-[-150px] rounded-full animate-pulse"></div>
  <div class="absolute w-[400px] h-[400px] bg-cyan-400 bg-opacity-20 blur-2xl bottom-[-150px] right-[-100px] rounded-full animate-ping"></div>

  <!-- Konten -->
  <div class="text-center fade-slide-in z-10">
    
    <!-- Logo -->
    <div class="mb-8">
      <div class="mx-auto w-32 h-32 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center glow border-4 border-blue-500 shadow-2xl overflow-hidden">
        <img src="images/logobarokah.png" alt="Logo Barokah Sedaya Usaha" class="w-24 h-24 object-contain" />
      </div>
    </div>

    <!-- Judul -->
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-wider text-blue-100 drop-shadow-md">
      Barokah Sedaya Usaha
    </h1>
    <p class="text-blue-300 mt-2 mb-6 text-lg italic tracking-wide">
      Sistem Inventori 
    </p>

    <!-- Loading Text -->
    <div class="dot-flash text-xl text-blue-100 font-mono mb-5 tracking-wider">
      Memuat<span>.</span><span>.</span><span>.</span>
    </div>

    <!-- Progress Bar -->
    <div class="w-72 h-3 bg-white bg-opacity-20 rounded-full mx-auto overflow-hidden shadow-inner">
      <div class="h-full bg-blue-500 glow progress-bar rounded-full"></div>
    </div>

    <p class="text-sm text-blue-200 mt-6">
      Mohon tunggu, sistem sedang dipersiapkan...
    </p>
  </div>
</body>
</html>
