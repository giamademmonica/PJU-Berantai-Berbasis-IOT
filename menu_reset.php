<?php
include 'koneksi.php';
session_start();
if ($_SESSION['status'] != "login") { header("location:login.php"); }

// Kita tidak perlu lagi query nama_wifi karena kolomnya sudah dihapus
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Connection - PJU</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #0f172a; color: white; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .card { background: #1e293b; padding: 30px; border-radius: 24px; width: 420px; box-shadow: 0 20px 50px rgba(0,0,0,0.3); text-align: center; }
        
        .btn-reset { 
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            width: 100%; padding: 20px; border-radius: 16px; border: 1px solid #334155; 
            background: #1e293b; color: white; text-decoration: none; margin-bottom: 15px; 
            transition: 0.3s; 
        }
        .btn-reset:hover { border-color: #ef4444; background: rgba(239, 68, 68, 0.1); transform: translateY(-2px); }
        
        .unit-name { font-weight: 600; font-size: 16px; color: #ef4444; }
        .unit-desc { font-size: 11px; color: #94a3b8; margin-top: 4px; }

        .btn-back { display: inline-block; margin-top: 10px; color: #94a3b8; text-decoration: none; font-size: 13px; }
        .btn-back:hover { color: white; }
        .alert { color: #22c55e; font-size: 13px; margin-bottom: 20px; font-weight: 600; background: rgba(34, 197, 94, 0.1); padding: 10px; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="margin-bottom: 10px;">Reset Connection</h2>
        <p style="color: #64748b; font-size: 13px; margin-bottom: 25px;">Pilih unit untuk memutuskan koneksi WiFi & masuk ke mode konfigurasi:</p>

        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'reset_diproses'): ?>
            <p class="alert">✅ Perintah reset berhasil dikirim!</p>
        <?php endif; ?>
        
        <a href="aksi_reset_koneksi.php?id=1" class="btn-reset" onclick="return confirm('Reset WiFi PJU 1?')">
            <span class="unit-name">⚙️ Reset WiFi PJU 1</span>
            <span class="unit-desc">Klik untuk mengganti jaringan WiFi</span>
        </a>

        <a href="aksi_reset_koneksi.php?id=2" class="btn-reset" onclick="return confirm('Reset WiFi PJU 2?')">
            <span class="unit-name">⚙️ Reset WiFi PJU 2</span>
            <span class="unit-desc">Klik untuk mengganti jaringan WiFi</span>
        </a>

        <a href="aksi_reset_koneksi.php?id=3" class="btn-reset" onclick="return confirm('Reset WiFi PJU 3?')">
            <span class="unit-name">⚙️ Reset WiFi PJU 3</span>
            <span class="unit-desc">Klik untuk mengganti jaringan WiFi</span>
        </a>
        
        <a href="index.php" class="btn-back">← Kembali ke Dashboard</a>
    </div>
</body>
</html>