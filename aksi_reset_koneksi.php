<?php
include "koneksi.php";

// Menangkap ID dari URL (1, 2, atau 3)
$id_unit = $_GET['id']; 

if(isset($id_unit)){
    // Update kolom reset_request menjadi 1 pada tabel kontrol_perangkat
    $query = mysqli_query($conn, "UPDATE kontrol_perangkat SET reset_request=1 WHERE id='$id_unit'");
    
    if($query){
        // Kembali ke menu reset dengan pesan sukses
        header("location:menu_reset.php?pesan=reset_diproses");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>