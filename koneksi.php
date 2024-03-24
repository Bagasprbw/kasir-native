<?php
    $namahost="127.0.0.1";
    $user="root";
    $password="";
    $database="apk_kasir";
    $conn=mysqli_connect('localhost','root','','apk_kasir');
    if(!$conn) {
        echo "Database Error";
    }
?>