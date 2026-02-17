<?php
include "koneksi.php";

// 1. Tangkap data dari ESP32
$id_unit  = $_POST['id'] ?? ''; 
$mode     = $_POST['mode'] ?? '';
$pir      = $_POST['pir'] ?? '';
$distance = $_POST['distance'] ?? '';
$lamp     = $_POST['lamp'] ?? '';

if (!empty($id_unit)) {
    
    // 2. SESUAIKAN DENGAN STRUKTUR GAMBAR:
    // id_pju -> device_id
    // lamp   -> lamp_status
    $sql = "INSERT INTO log_pju (device_id, mode, pir, distance, lamp_status) 
            VALUES ('$id_unit', '$mode', '$pir', '$distance', '$lamp')";
    
    if (mysqli_query($conn, $sql)) {
        echo "✅ Log Berhasil Disimpan";
    } else {
        echo "❌ Database Error: " . mysqli_error($conn);
    }
} else {
    echo "⚠️ Tidak ada data yang diterima";
}
?>