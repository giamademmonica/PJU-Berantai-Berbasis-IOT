<?php
include 'koneksi.php';
// Mengambil ID terakhir yang ada di tabel log
$query = mysqli_query($conn, "SELECT id FROM log_pju ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_assoc($query);
echo $data['id'];
?>