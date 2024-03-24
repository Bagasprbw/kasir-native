<?php
    session_start();
    require_once('koneksi.php');
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    $id_brg = $_GET['id_brg'];
    $query = "SELECT * FROM barang where id_brg = '$id_brg'";
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
                                <div class="card login-form mb-0">
                                    <div class="card-body pt-5">
                                        <?php foreach ($data_barang as $data){ ?>
                                        <form class="form-valide" action="_barang_model.php" method="post" novalidate="novalidate">
                                            <h4>Edit Produk</h4>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">Nama Barang <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="hidden" name="id_brg" value="<?= $data['id_brg'] ?>">
                                                    <input type="text" class="form-control" id="val-username" name="nama_brg" value="<?= $data['nama_brg'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">deskripsi <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-username" name="deskripsi"  value="<?= $data['deskripsi'] ?>" id="deskripsi">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-email">Stok <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="form-control" id="val-email" name="stok" value="<?= $data['stok'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-password">Harga <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="form-control" id="val-password" name="harga" value="<?= $data['harga'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" name="edit_barang" class="btn btn-warning">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php } ?>
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