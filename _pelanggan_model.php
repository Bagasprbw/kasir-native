<?php
include "koneksi.php";
if(isset($_POST['tambah_pelanggan'])){
    $nama_pelanggan= $_POST['nama_pelanggan'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $query = "INSERT INTO pelanggan (nama_pelanggan, telp, alamat) VALUES ('$nama_pelanggan', '$telp', '$alamat')";
    if(mysqli_query($conn, $query)){
        echo "<script> alert(' Berhasil Ditambahkan'); </script>";
        echo "<script> window.location.href= 'pelanggan.php' </script>";
    } else{
        echo "Gagal menambah pelanggan";
    }
}
//tambah pelanggan baru di order.php
include "koneksi.php";
if(isset($_POST['tambah_pelanggan2'])){
    $nama_pelanggan= $_POST['nama_pelanggan'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $query = "INSERT INTO pelanggan (nama_pelanggan, telp, alamat) VALUES ('$nama_pelanggan', '$telp', '$alamat')";
    if(mysqli_query($conn, $query)){
        echo "<script> alert(' Pelanggan Baru Berhasil Ditambahkan'); </script>";
        echo "<script> window.location.href= 'order.php' </script>";
    } else{
        echo "Gagal menambah pelanggan";
    }
}

include "koneksi.php";
if (isset($_GET['hapus'])) {
    $id_pelanggan = $_GET['hapus'];
    $query = "DELETE FROM pelanggan where id_pelanggan='$id_pelanggan' ";
    if(mysqli_query($conn, $query)){
        echo "<script> alert('pelanggan Berhasil Dihapus'); </script>";
        echo "<script> window.location.href= 'pelanggan.php' </script>";
    } else{
        echo "Gagal menghapus pelanggan";
    }
}

include "koneksi.php";
if(isset($_POST['edit_plgn'])){
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $query = "UPDATE pelanggan SET nama_pelanggan ='$nama_pelanggan', telp ='$telp', alamat='$alamat'
    WHERE id_pelanggan = '$id_pelanggan'";
    if(mysqli_query($conn, $query)){
        echo "<script> alert('Pelanggan sukses di rubah'); </script>";
        echo "<script> window.location.href= 'pelanggan.php' </script>";
    } else{
        echo "Gagal mengedit pelanggan";
    }
}
?>