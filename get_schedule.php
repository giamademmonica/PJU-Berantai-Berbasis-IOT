<?php
include '../iot_esp32/koneksi.php';

$query = mysqli_query($conn, "SELECT jadwal_on, jadwal_off FROM kontrol_perangkat WHERE id=1");
if ($data = mysqli_fetch_array($query)) {
    // Memastikan output hanya "HH:mm|HH:mm" tanpa spasi/enter
    $on = substr($data['jadwal_on'], 0, 5);
    $off = substr($data['jadwal_off'], 0, 5);
    echo trim($on . "|" . $off);
}
