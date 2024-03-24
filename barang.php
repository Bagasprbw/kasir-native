<?php
    session_start();
    require_once('koneksi.php');
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    $query = "SELECT * FROM barang order by nama_brg ASC";
    $data_barang = mysqli_query($conn,$query);
    //total record barang
    $record_brg=mysqli_query($conn, "SELECT * FROM barang");
    $output_record_brg=mysqli_num_rows($record_brg);
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
                    <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head mb-0">
                                <div class="heading1 margin_0">
                                    <h2>Stok Barang</h2><hr>
                                    <button class="btn btn-warning btn-sm" >Jumlah Barang : <?= $output_record_brg; ?></button>
                                    <!-- modal input -->
                                    <button type="button" class="btn btn-success mt-0 btn-sm" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus"></i> 
                                        Tambah Barang
                                    </button>
                                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Produk</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="_barang_model.php" method="post">
                                                    <div class="modal-body">
                                                        <!-- inpputttttt -->
                                                        <input type="text" class="form-control mt-3" name="nama_brg" placeholder="Nama Barang">
                                                        <input type="text" class="form-control mt-3" name="deskripsi" placeholder="deskripsi">
                                                        <input type="number" class="form-control mt-3" name="stok" placeholder="Stok">
                                                        <input type="number" class="form-control mt-3" name="harga" placeholder="Harga /buah">
                                                        <!-- inpputttttt end -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="tambah_brg">Simpan</button>
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
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0 ?>
                                            <?php foreach ($data_barang as $data){ ?>
                                            <?php $no++ ?>
                                            <tr>
                                                <td scope="row"><?= $no; ?></td>
                                                <td><?= $data['nama_brg']; ?></td>
                                                <td><?= $data['deskripsi']; ?></td>
                                                <td><?= ($data['stok'] == 0) ? 'Stok Habis' : $data['stok']; ?></td>
                                                <td><?= number_format($data['harga'], 0, ',', '.'); ?></td>
                                                <td class="text-white">
                                                    <!-- hapus -->
                                                    <a onclick="return confirm('Apakah anda yakin??')" class="btn btn-danger" href="_barang_model.php?hapus=<?= $data['id_brg'] ?>"><i class="fa fa-trash"></i></a>
                                                    <!-- edit -->
                                                    <a class="btn btn-warning" href="_edit_brg.php?id_brg=<?= $data['id_brg'] ?>"><i class="fa fa-edit"></a>
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