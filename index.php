<?php
include 'koneksi.php';
session_start();
if ($_SESSION['status'] != "login") { header("location:login.php"); }

// Mengambil data dari tabel kontrol_perangkat untuk kontrol utama
$query = mysqli_query($conn, "SELECT * FROM kontrol_perangkat WHERE id=1");
$d = mysqli_fetch_array($query);

// Logika update mode dari dashboard
if (isset($_GET['set_mode'])) {
    $m = $_GET['set_mode'];
    mysqli_query($conn, "UPDATE kontrol_perangkat SET mode='$m' WHERE id=1");
    header("location:index.php");
}

// Logika update jadwal RTC dari dashboard
if (isset($_POST['update_time'])) {
    $on = $_POST['on'];
    $off = $_POST['off'];
    mysqli_query($conn, "UPDATE kontrol_perangkat SET jadwal_on='$on', jadwal_off='$off' WHERE id=1");
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PJU Dashboard Control</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #0f172a; color: white; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .card { background: #1e293b; padding: 30px; border-radius: 24px; width: 380px; box-shadow: 0 20px 50px rgba(0,0,0,0.3); text-align: center; }
        
        .status-container { background: #334155; padding: 15px; border-radius: 15px; margin-bottom: 25px; border-bottom: 4px solid #475569; }
        .status-label { font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; }
        
        .status-value { font-size: 26px; font-weight: 600; }
        .color-auto { color: #38bdf8; }
        .color-on { color: #22c55e; }
        .color-off { color: #ef4444; }

        .btn-group { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-bottom: 25px; }
        .btn-mode { padding: 12px 5px; border-radius: 12px; border: none; font-weight: 600; font-size: 13px; cursor: pointer; transition: 0.3s; color: #94a3b8; background: #334155; text-decoration: none; display: flex; align-items: center; justify-content: center; }
        
        .active-auto { background: #38bdf8 !important; color: white !important; box-shadow: 0 0 15px rgba(56, 189, 248, 0.4); }
        .active-on { background: #22c55e !important; color: white !important; box-shadow: 0 0 15px rgba(34, 197, 94, 0.4); }
        .active-off { background: #ef4444 !important; color: white !important; box-shadow: 0 0 15px rgba(239, 68, 68, 0.4); }

        .time-box { background: #334155; padding: 20px; border-radius: 15px; text-align: left; }
        label { font-size: 11px; color: #94a3b8; display: block; margin-bottom: 5px; font-weight: 600; }
        
        input[type="time"] { 
            width: 100%; background: #1e293b; border: 1px solid #475569; color: white; 
            padding: 12px; border-radius: 10px; margin-bottom: 15px; font-size: 16px;
            color-scheme: dark;
        }
        
        .btn-update { width: 100%; padding: 12px; border-radius: 10px; border: none; background: #6366f1; color: white; font-weight: 600; cursor: pointer; transition: 0.3s; margin-bottom: 10px; }
        .btn-update:hover { background: #4f46e5; transform: scale(1.02); }

        .btn-monitor { display: block; width: 100%; padding: 12px; border-radius: 10px; background: transparent; color: #38bdf8; text-decoration: none; font-weight: 600; font-size: 13px; text-align: center; border: 1px solid #38bdf8; transition: 0.3s; margin-bottom: 10px; }
        .btn-monitor:hover { background: rgba(56, 189, 248, 0.1); }

        /* Tombol Navigasi Reset */
        .btn-nav-reset { display: block; width: 100%; padding: 12px; border-radius: 10px; background: transparent; color: #ef4444; text-decoration: none; font-weight: 600; font-size: 13px; text-align: center; border: 1px solid #ef4444; transition: 0.3s; }
        .btn-nav-reset:hover { background: rgba(239, 68, 68, 0.1); }

        .logout { display: block; margin-top: 20px; font-size: 11px; color: #475569; text-decoration: none; }
    </style>
</head>
<body>

    <div class="card">
        <h2 style="margin-bottom: 5px;">PJU Smart System</h2>
        <p style="color: #64748b; font-size: 13px; margin-bottom: 20px;">Control Menu</p>

        <div class="status-container">
            <p class="status-label">Mode Saat Ini</p>
            <p class="status-value <?php 
                if($d['mode']=='AUTO') echo 'color-auto'; 
                elseif($d['mode']=='ON') echo 'color-on'; 
                else echo 'color-off'; 
            ?>">
                <?php echo strtoupper($d['mode'] ?? 'AUTO'); ?>
            </p>
        </div>

        <div class="btn-group">
            <a href="index.php?set_mode=AUTO" class="btn-mode <?php echo ($d['mode']=='AUTO') ? 'active-auto' : ''; ?>">AUTO</a>
            <a href="index.php?set_mode=ON" class="btn-mode <?php echo ($d['mode']=='ON') ? 'active-on' : ''; ?>">ON</a>
            <a href="index.php?set_mode=OFF" class="btn-mode <?php echo ($d['mode']=='OFF') ? 'active-off' : ''; ?>">OFF</a>
        </div>

        <form method="POST" class="time-box">
            <div style="display: flex; gap: 10px;">
                <div style="flex: 1;">
                    <label>NYALA (ON)</label>
                    <input type="time" name="on" step="60" required value="<?php echo substr($d['jadwal_on'] ?? '18:00',0,5); ?>">
                </div>
                <div style="flex: 1;">
                    <label>MATI (OFF)</label>
                    <input type="time" name="off" step="60" required value="<?php echo substr($d['jadwal_off'] ?? '06:00',0,5); ?>">
                </div>
            </div>
            <button type="submit" name="update_time" class="btn-update">Simpan Jadwal</button>
            
            <a href="monitor.php" class="btn-monitor">📊 Pantau Sensor & Log</a>
            
            <a href="menu_reset.php" class="btn-nav-reset">⚠️ Reset Connection Menu</a>
        </form>

        <a href="logout.php" class="logout">Logout</a>
    </div>

</body>
</html>