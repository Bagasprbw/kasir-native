<?php
	session_start();
    include "koneksi.php";
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "SELECT * FROM kasir WHERE username='$username' AND password='$password'";
    $hasil = mysqli_query($conn, $query);
    if(mysqli_num_rows($hasil) == 1) {
        $data = mysqli_fetch_assoc($hasil);
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['username'] = $data['username'];
        header("Location: index.php");
    } else {
        echo"<script> alert('Username/password tidak ditemukan'); window.location.replace('login.php'); </script>";
    }

?>
