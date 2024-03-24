<?php
    session_start();
    require_once('koneksi.php');
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    
    if (isset($_GET['id_psn'])) {
        $id_psn = $_GET['id_psn'];
        // ambil nama pelanggan
        $tampil_nama_plgn = mysqli_query($conn, "SELECT * FROM pesanan p, pelanggan plgn WHERE p.id_pelanggan=plgn.id_pelanggan AND p.id_pesanan='$id_psn'");
        if (mysqli_num_rows($tampil_nama_plgn) > 0) {
            $np = mysqli_fetch_array($tampil_nama_plgn);
            $nm_plgn = $np['nama_pelanggan'];
        } else {
            $nm_plgn = ""; 
        }
    } else {
        header("Location: order.php");
    }   
    
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
      <title>History pesanan</title>
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
                                    <a href="order.php" class="btn btn-danger"><i class="fa fa-mail-reply"></i></a>
                                </div>
                                <h3 class="ml-5">History Pembelian</h3>
                            </div>
                            <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th colspan="1">Pelanggan :</th>
                                                <th colspan="5"><?= $nm_plgn ?></th>
                                            </tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Id Barang</th>
                                                <th>Harga Satuan</th>
                                                <th>Quantity</th>
                                                <th>Sub-Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0 ?>
                                            <?php
                                            $totalharga = 0;
                                            $get = mysqli_query($conn,
                                                "SELECT * FROM detail_pesanan p, barang br WHERE p.id_brg=br.id_brg AND id_pesanan='$id_psn'"
                                            );
                                            while ($p = mysqli_fetch_array($get)) {
                                                $id_brg = $p['id_brg'];
                                                $id_detailpesanan = $p['id_detailpesanan'];
                                                $deskripsi = $p['deskripsi'];
                                                $qty = $p['qty'];
                                                $harga = $p['harga'];
                                                $nama_brg = $p['nama_brg'];
                                                $subtotal = $qty * $harga;
                                                $totalharga += $subtotal;
                                            ?>
                                            <?php $no++ ?>
                                            <tr>
                                                <td scope="row"><?= $no; ?></td>
                                                <td><?= $nama_brg ?> - <?= $deskripsi ?></td>
                                                <td><?= $id_brg ?></td>
                                                <td><?= number_format($harga) ?></td>
                                                <td><?= $qty ?></td>
                                                <td>Rp.<?= number_format($subtotal) ?></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <th colspan="5" class="text-right">Total harga :</th>
                                                <th colspan="1">Rp.<?= number_format($totalharga, 0, ',', '.') ?></th>
                                            </tr>
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
