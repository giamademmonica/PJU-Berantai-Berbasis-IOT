<?php
include "koneksi.php";
// Memastikan tidak ada output sebelum echo data
ob_clean(); 

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '1';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'clear') {
    mysqli_query($conn, "UPDATE kontrol_perangkat SET reset_request=0 WHERE id='$id'");
    echo "OK_CLEARED";
    exit();
}

$sql = mysqli_query($conn, "SELECT reset_request FROM kontrol_perangkat WHERE id='$id'");
$data = mysqli_fetch_array($sql);

// Pastikan output hanya RESET atau NORMAL tanpa spasi/enter
if(isset($data['reset_request']) && $data['reset_request'] == 1) {
    echo "RESET"; 
} else {
    echo "NORMAL";
}
exit();