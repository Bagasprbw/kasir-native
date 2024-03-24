<?php
session_start();
include "koneksi.php";
//tambah pesanan sesuai pelanggan => langsung ke transaksi
if(isset($_POST['tambah_pesanan'])){
    $id_pelanggan = $_POST['id_pelanggan'];
    $query = "INSERT INTO pesanan (id_pelanggan) VALUES ('$id_pelanggan')";
    
    if(mysqli_query($conn, $query)){
        $id_pesanan = mysqli_insert_id($conn);
        echo "<script> window.location.href= '_transaksipesanan.php?id_psn=" . $id_pesanan . "' </script>";
    } else{
        echo "Gagal menambah orderan/pesanan";
    }
}

//hapus pemesan
include "koneksi.php";
if (isset($_GET['hapus'])) {
    $id_pesanan = $_GET['hapus'];

    // Hapus data pesanan dari tabel pesanan
    $query_pesanan = "DELETE FROM pesanan WHERE id_pesanan='$id_pesanan'";
    mysqli_query($conn, $query_pesanan);

    // Hapus data barang pesanan dari tabel detail_pesanan
    $query_detail_pesanan = "DELETE FROM detail_pesanan WHERE id_pesanan='$id_pesanan'";
    mysqli_query($conn, $query_detail_pesanan);

    echo "<script> alert('Pemesanan ini berhasil dihapus'); </script>";
    echo "<script> window.location.href= 'order.php' </script>";
} else {
    echo "Gagal hhhhhhh menghapus pesanan/orderan";
}

?>
<?php
//detail pesanan/orderan---_transaksipesanan,php

//hapus barang pesanan
include "koneksi.php";
if (isset($_GET['hapus_brg_psn'])) {
    $id_detailpesanan = $_GET['hapus_brg_psn'];

    $query_barang = "SELECT id_brg, qty FROM detail_pesanan WHERE id_detailpesanan='$id_detailpesanan'";
    $result_barang = mysqli_query($conn, $query_barang);
    $barang = mysqli_fetch_assoc($result_barang);

    $id_brg = $barang['id_brg'];
    $qty = $barang['qty'];

    $query_hapus = "DELETE FROM detail_pesanan WHERE id_detailpesanan='$id_detailpesanan' ";
    if (mysqli_query($conn, $query_hapus)) {
        // Mengembalikan stok barang yang dihapus
        $query_update = "UPDATE barang SET stok = stok + '$qty' WHERE id_brg='$id_brg'";
        if (mysqli_query($conn, $query_update)) {
            echo "<script> alert('Berhasil Dihapus'); </script>";
            echo "<script> window.location.href= '_transaksipesanan.php?id_psn={$_GET['id_psn']}'; </script>";
            exit;
        } else {
            echo "Gagal mengembalikan stok";
        }
    } else {
        echo "Gagal menghapus";
    }
}


//insert barang pesanan
include "koneksi.php";
if(isset($_POST['add_brg_pesanan'])){
    $id_brg= $_POST['id_brg'];
    $id_psn= $_POST['id_psn'];
    $qty= $_POST['qty'];
    //hitung stok sekarang
    $hitung1=mysqli_query($conn, "SELECT * FROM barang WHERE id_brg='$id_brg'");
    $hitung2=mysqli_fetch_array($hitung1);
    $stoksekarang=$hitung2['stok'];
    
    if($stoksekarang >= $qty) {
        // pengurangan stok
        $selisih = $stoksekarang - $qty;
        // stok cukup
        $query_insert = "INSERT INTO detail_pesanan (id_pesanan, id_brg, qty) VALUES ('$id_psn', '$id_brg', '$qty')";
        // update pengurangan stok
        $query_update = "UPDATE barang SET stok='$selisih' WHERE id_brg='$id_brg'";
    
        // Eksekusi query insert dan update
        $insert_result = mysqli_query($conn, $query_insert);
        $update_result = mysqli_query($conn, $query_update);
    
        if($insert_result && $update_result){
            echo "<script> alert('Barang Pesanan Berhasil Ditambahkan'); window.location.href='_transaksipesanan.php?id_psn=$id_psn';</script>";
        } else{
            echo "<script> alert('Gagal menambah barang pesanan'); window.location.href='_transaksipesanan.php?id_psn=$id_psn';</script>";
        }
    } else {
        // stok tidak cukup
        echo "<script> alert('Stok tidak mencukupi'); window.location.href='_transaksipesanan.php?id_psn=$id_psn';</script>";
    }
    
}
// Edit quantity (mengurangi dan mengembalikan stok sesuai jumlsh yg di pesan)
if (isset($_POST['edit_quantity'])) {
    $id_detailpesanan = $_POST['id_detailpesanan'];
    $qty_baru = $_POST['qty_baru'];

    $query_pesanan = "SELECT * FROM detail_pesanan WHERE id_detailpesanan='$id_detailpesanan'";
    $result_pesanan = mysqli_query($conn, $query_pesanan);
    $row_pesanan = mysqli_fetch_assoc($result_pesanan);
    $qty_lama = $row_pesanan['qty'];
    $id_brg = $row_pesanan['id_brg'];

    // Mengembalikan stok barang sebelunya
    $query_update_stok = "UPDATE barang SET stok = stok + '$qty_lama' WHERE id_brg = '$id_brg'";
    mysqli_query($conn, $query_update_stok);

    // Mengurangi stok barang baru
    $query_update_qty = "UPDATE detail_pesanan SET qty='$qty_baru' WHERE id_detailpesanan='$id_detailpesanan'";
    if (mysqli_query($conn, $query_update_qty)) {
        // Mengupdate stok barang baru
        $query_update_stok = "UPDATE barang SET stok = stok - '$qty_baru' WHERE id_brg = '$id_brg'";
        mysqli_query($conn, $query_update_stok);

        echo "<script> alert('Quantity berhasil diubah'); </script>";
        echo "<script> window.location.href= '_transaksipesanan.php?id_psn={$_POST['id_psn']}'; </script>";
        exit;
    } else {
        echo "Gagal mengubah quantity";
    }
}

?>



