<?php
include "koneksi.php";
if(isset($_POST['tambah_brg'])){
    $deskripsi= $_POST['deskripsi'];
    $nama_brg = $_POST['nama_brg'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $query = "INSERT INTO barang (deskripsi, nama_brg, stok, harga) VALUES ('$deskripsi', '$nama_brg', '$stok', '$harga')";
    if(mysqli_query($conn, $query)){
        echo "<script> alert('Barang Berhasil Ditambahkan'); </script>";
        echo "<script> window.location.href= 'barang.php' </script>";
    } else{
        echo "Gagal menambah barang";
    }
}

include "koneksi.php";
if (isset($_GET['hapus'])) {
    $id_brg = $_GET['hapus'];
    $query = "DELETE FROM barang where id_brg='$id_brg' ";
    if(mysqli_query($conn, $query)){
        echo "<script> alert('Barang Berhasil Dihapus'); </script>";
        echo "<script> window.location.href= 'barang.php' </script>";
    } else{
        echo "Gagal menghapus barang";
    }
}

include "koneksi.php";
if(isset($_POST['edit_barang'])){
    $id_brg = $_POST['id_brg'];
    $deskripsi = $_POST['deskripsi'];
    $nama_brg = $_POST['nama_brg'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $query = "UPDATE barang SET deskripsi ='$deskripsi',nama_brg = '$nama_brg',stok = '$stok',harga = '$harga'
    WHERE id_brg = '$id_brg'";
    if(mysqli_query($conn, $query)){
        echo "<script> alert('Barang Berhasil Diedit'); </script>";
        echo "<script> window.location.href= 'barang.php' </script>";
    } else{
        echo "Gagal mengedit barang";
    }
}
?>
