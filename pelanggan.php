<?php
    session_start();
    require_once('koneksi.php');
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    $query = "SELECT * FROM pelanggan order by nama_pelanggan ASC";
    $data_pelanggan = mysqli_query($conn,$query);
    //tampilkan jumlah record pelanggan
    $record_plgn=mysqli_query($conn, "SELECT * FROM pelanggan");
    $output_record_plgn=mysqli_num_rows($record_plgn);
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
      <title>Tabel Pelanggan</title>
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
                    <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head mb-0">
                                <div class="heading1 margin_0">
                                    <h2>KELOLA PELANGGAN</h2><hr>
                                    <button class="btn cur-p btn-outline-danger btn-sm" >Jumlah Pelanggan : <?= $output_record_plgn ?></button>
                                    <!-- modal input -->
                                    <button type="button" class="btn btn-success mt-0 btn-sm" data-toggle="modal" data-target="#modalpelanggan"><i class="fa fa-plus"></i> 
                                        Add Pelanggan
                                    </button>
                                    <div class="modal fade" id="modalpelanggan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Pelanggan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="_pelanggan_model.php" method="post">
                                                    <div class="modal-body">
                                                        <!-- inpputttttt -->
                                                        <input type="text" class="form-control mt-3" name="nama_pelanggan" placeholder="Nama Pelanggan">
                                                        <input type="text" class="form-control mt-3" name="telp" placeholder="telp">
                                                        <input type="text" class="form-control mt-3" name="alamat" placeholder="alamat">
                                                        <!-- inpputttttt end -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="tambah_pelanggan">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <!-- modal input end-->
                                </div>
                            </div>
                            <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Pelanggan</th>
                                                <th>No.Telp</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0 ?>
                                            <?php foreach ($data_pelanggan as $plgn){ ?>
                                            <?php $no++ ?>
                                            <tr>
                                                <td scope="row"><?= $no; ?></td>
                                                <td><?= $plgn['nama_pelanggan']; ?></td>
                                                <td><?= $plgn['telp']; ?></td>
                                                <td><?= $plgn['alamat']; ?></td>
                                                <td class="text-white">
                                                    <!-- hapus -->
                                                    <a onclick="return confirm('Apakah anda yakin??')" class="btn btn-danger" href="_pelanggan_model.php?hapus=<?= $plgn['id_pelanggan'] ?>"><i class="fa fa-trash"></i></a>
                                                    <!-- edit -->
                                                    <a class="btn btn-warning" href="_edit_pelanggan.php?id_pelanggan=<?= $plgn['id_pelanggan'] ?>"><i class="fa fa-edit"></a>
                                                    <a class="btn cur-p btn-outline-success" href="_riwayat.php?id_pelanggan=<?= $plgn['id_pelanggan'] ?>"><i class="fa fa-history"> Riwayat</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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