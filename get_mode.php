<?php
// Mematikan semua error reporting yang bisa mengotori output teks
error_reporting(0); 

include '../iot_esp32/koneksi.php';

$query = mysqli_query($conn, "SELECT mode FROM kontrol_perangkat WHERE id=1");
if ($query) {
    $data = mysqli_fetch_array($query);
    // echo trim($data['mode']); // Menggunakan trim untuk memastikan tidak ada spasi
    echo $data['mode'];
}
