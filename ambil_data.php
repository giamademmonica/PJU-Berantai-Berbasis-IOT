<?php
include 'koneksi.php';

// Menangkap parameter 'device' dari URL, default ke PJU01
$device = isset($_GET['device']) ? $_GET['device'] : 'PJU01';

// Mengambil data log terbaru KHUSUS untuk device yang dipilih
$query = mysqli_query($conn, "SELECT * FROM log_pju WHERE device_id = '$device' ORDER BY id DESC LIMIT 15");

$results = [];
while($row = mysqli_fetch_assoc($query)) {
    $results[] = $row;
}

header('Content-Type: application/json');
echo json_encode($results);
?>