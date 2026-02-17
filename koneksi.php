<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "iot_project"; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    // Jangan pakai die() agar tidak mengirim teks ke ESP32
    // Cukup hentikan script secara diam-diam
    exit(); 
}
