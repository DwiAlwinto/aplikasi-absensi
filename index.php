<?php
    // Pastikan tidak ada output sebelumnya
    ob_start();

    // Lakukan pengalihan
    header("Location: auth/login.php");

    // Pastikan semua output sudah dikirimkan
    ob_end_flush();
    exit();
?>
