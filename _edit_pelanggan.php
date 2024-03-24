<?php
    session_start();
    require_once('koneksi.php');
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    $id_pelanggan = $_GET['id_pelanggan'];
    $query = "SELECT * FROM pelanggan where id_pelanggan = '$id_pelanggan'";
    $data_pelanggan = mysqli_query($conn,$query);
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
      <title>Edit Pelanggan</title>
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
            
            <!-- end topbar -->
            <!-- dashboard inner -->
                <div class="midde_cont">
                    <!-- isi -->
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="card login-form mb-0">
                                    <div class="card-body pt-5">
                                        <?php foreach ($data_pelanggan as $plgn){ ?>
                                        <form class="form-valide" action="_pelanggan_model.php" method="post" novalidate="novalidate">
                                            <h4>Edit Pelanggan</h4>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">Nama Pelanggan <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="hidden" name="id_pelanggan" value="<?= $plgn['id_pelanggan'] ?>">
                                                    <input type="text" class="form-control" id="val-username" name="nama_pelanggan" value="<?= $plgn['nama_pelanggan'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">Telp <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-username" name="telp"  value="<?= $plgn['telp'] ?>" id="deskripsi">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-email">Alamat <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-email" name="alamat" value="<?= $plgn['alamat'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" name="edit_plgn" class="btn btn-warning">Simpan</button>
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