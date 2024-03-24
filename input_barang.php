<?php
    session_start();
    require_once('koneksi.php');
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    $query = "SELECT * FROM barang order by nama_brg ASC";
    $data_barang = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Tabel Barang</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- link css -->
      <?php require_once('layout/_css.php'); ?>
   </head>
   <body class="dashboard dashboard_2">
      <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <?php require_once('layout/_sidebar.php'); ?>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
            <!-- topbar -->
            <br>
            <?php require_once('layout/_topbar.php'); ?>
            <!-- end topbar -->
            <!-- dashboard inner -->
                <div class="midde_cont">
                    <!-- isi -->
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="form-input-content">
                                    <div class="card login-form mb-0">
                                        <div class="card-body pt-5">
                                            <form class="form-valide" action="_barang_model.php" method="post" novalidate="novalidate">
                                                <h4>Tambah Produk</h4>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Nama Barang <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-username" name="nama_brg">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Deskripsi <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-username" name="deskripsi">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Stok <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="number" class="form-control" id="val-email" name="stok">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-password">Harga <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="number" class="form-control" id="val-password" name="harga">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit"name="tambah_brg" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <!-- isi end -->
                </div>
            <!-- end dashboard inner -->
            </div>
        </div>
      </div>
      <!-- jQuery -->
      <?php require_once('layout/_js.php'); ?>
   </body>
</html>