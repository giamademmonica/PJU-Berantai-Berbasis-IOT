<?php
include '../iot_esp32/koneksi.php';
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
    mysqli_query($conn, "UPDATE kontrol_perangkat SET mode='$mode' WHERE id=1");
    echo "OK";
}
?>