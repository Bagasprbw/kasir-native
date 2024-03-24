<?php
    session_start();
    require_once('koneksi.php');
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    $record_psn=mysqli_query($conn, "SELECT * FROM pesanan");
    $output_record_psn=mysqli_num_rows($record_psn);
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
      <title>Order</title>
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
                                    <h1>Data Pemesan/Orderan</h1><hr>
                                    <button class="btn btn-warning btn-sm" >Total : <?= $output_record_psn ?></button>
                                    <!-- modal input -->
                                    <button type="button" class="btn btn-primary mt-0 btn-sm" data-toggle="modal" data-target="#modalpesanan"><i class="fa fa-plus"></i> 
                                        Add Orderan
                                    </button><br><br>
                                    <button type="button" class="btn btn-success mt-0 btn-sm" data-toggle="modal" data-target="#modalpelanggan"><i class="fa fa-plus"></i> 
                                        Add Pelanggan
                                    </button>
                                    <div class="modal fade" id="modalpesanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Orderan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="_pesanan_model.php" method="post">
                                                    <div class="modal-body">
                                                        <!-- inpputttttt -->
                                                        <label class="col-form-label" for="val-email">Pilih Pelanggan :</label>
                                                        <select name="id_pelanggan" class="form-control">
                                                            <?php
                                                                $getpelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
                                                                while ($plgn = mysqli_fetch_array($getpelanggan)) {
                                                                    $id_pelanggan = $plgn['id_pelanggan'];
                                                                    $nama_pelanggan = $plgn['nama_pelanggan'];
                                                                    $alamat = $plgn['alamat'];
                                                            ?>
                                                            <option value="<?= $id_pelanggan; ?>">
                                                                <?= $nama_pelanggan; ?> - <?= $alamat; ?>  
                                                            </option>   

                                                            <?php
                                                                }
                                                            ?>
                                                        </select><br><br><br>
                                                        <!-- inpputttttt end -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="tambah_pesanan">Simpan</button>
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
                                                <th>No</th>
                                                <th>Id Pesanan</th>
                                                <th>Tanggal Pesanan</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Jumlah Barang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0 ?>
                                            <?php
                                            $getpesanan = mysqli_query($conn,
                                                "SELECT * FROM pesanan p, pelanggan plgn WHERE p.id_pelanggan=plgn.id_pelanggan order by tanggal_pesanan DESC"
                                            );
                                            while ($p = mysqli_fetch_array($getpesanan)) {
                                                $id_pesanan = $p['id_pesanan'];
                                                $tanggal_pesanan = $p['tanggal_pesanan'];
                                                $nama_pelanggan = $p['nama_pelanggan'];
                                                $alamat = $p['alamat'];

                                                //hitung jumlah brg pesanan
                                                $hitungjumlah = mysqli_query($conn, "SELECT * FROM detail_pesanan WHERE id_pesanan='$id_pesanan'");
                                                if ($hitungjumlah) {
                                                    $jumlah = mysqli_num_rows($hitungjumlah);
                                                } else {
                                                    echo "Halahh Mbohh Mumett" . mysqli_error($conn);
                                                }

                                            ?>
                                            <?php $no++ ?>
                                            <tr>
                                                <td scope="row"><?= $no; ?></td>
                                                <td><?= $id_pesanan ?></td>
                                                <td><?= $tanggal_pesanan ?></td>
                                                <td><?= $nama_pelanggan ?> - <?= $alamat; ?></td>
                                                <td><?= $jumlah; ?></td>
                                                <td class="text-white">
                                                    <!-- hapus -->
                                                    <a onclick="return confirm('Apakah anda yakin??')" class="btn btn-danger btn-sm" href="_pesanan_model.php?hapus=<?= $p['id_pesanan'] ?>"><i class="fa fa-trash"></i></a>
                                                    <!--Histori-->
                                                    <a class="btn btn-warning btn-sm" href="_history.php?id_psn=<?= $id_pesanan; ?>"><i class="fa fa-history"></i></a>
                                                    
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

<!-- modal untuk tambah pelanggan pada orderan -->
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
                    <button type="submit" class="btn btn-primary" name="tambah_pelanggan2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>