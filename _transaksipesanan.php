<?php
    session_start();
    require_once('koneksi.php');
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    
    // Inisialisasi variabel bayar dan kembalian dengan nilai awal 0
    $bayar = 0;
    $kembalian = 0;

    if (isset($_POST['bayar'])) {
        $bayar = $_POST['bayar'];
        $kembalian = $_POST['kembalian'];
    }
    
    // Menyimpan nilai bayar dan kembalian ke dalam sesi
    $_SESSION['bayar'] = $bayar;
    $_SESSION['kembalian'] = $kembalian;

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
      <title>View pesanan</title>
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
                                    <div class="full invoice_blog padding_infor_info pb-0 ml-0 pl-0">
                                        <h4>#Order Details</h4>
                                        <p>
                                            <strong>ID pesanan : </strong><?= $id_psn ?><br> 
                                            <strong>Nama Pelanggan : </strong><?= $nm_plgn ?><br> 
                                        </p><hr>
                                    </div>
                                    <!-- modal input -->
                                    <a href="order.php" class="btn btn-danger"><i class="fa fa-mail-reply"></i></a>
                                    <button type="button" class="btn btn-success mt-0 btn-sm" data-toggle="modal" data-target="#modalpilihbrg"><i class="fa fa-plus"></i> 
                                        Tambah Barang Pesanan
                                    </button>
                                    <div class="modal fade" id="modalpilihbrg" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Barang Pesanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="_pesanan_model.php" method="post">
                                                    <div class="modal-body">
                                                        <!-- inpputttttt -->
                                                        <label class="col-form-label" for="val-email">Pilih Barang :</label>
                                                        <select name="id_brg" class="form-control">
                                                            <?php
                                                                $getbrg = mysqli_query($conn, "SELECT * FROM barang WHERE id_brg NOT IN(SELECT id_brg FROM detail_pesanan WHERE id_pesanan='$id_psn')");
                                                                while ($plh_brg = mysqli_fetch_array($getbrg)) {
                                                                    $id_brg = $plh_brg['id_brg'];
                                                                    $nama_brg= $plh_brg['nama_brg'];
                                                                    $stok = $plh_brg['stok'];
                                                                    $deskripsi = $plh_brg['deskripsi'];
                                                            ?>
                                                            <option value="<?= $id_brg; ?>">
                                                                <?= $nama_brg; ?> - <?= $deskripsi; ?> ( stok: <?= $stok; ?> ) 
                                                            </option>   

                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <input type="number" class="form-control mt-3" name="qty" placeholder="Quantity" min="1">
                                                        <input type="hidden" class="form-control mt-3" name="id_psn" value="<?=$id_psn;?>">
                                                        <!-- inpputttttt end -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="add_brg_pesanan">Simpan</button>
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
                                                <th colspan="7" class="text-center">KERANJANG BELANJA</th>
                                            </tr>
                                        </thead>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Barang</th>
                                                <th>Id Barang</th>
                                                <th>Harga Satuan</th>
                                                <th>Quantity</th>
                                                <th>Sub-Total</th>
                                                <th>Aksi</th>
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
                                                //hitung kembalian
                                                if (isset($_POST['hitung_bayar'])) {
                                                    $bayar = $_POST['bayar'];
                                                    $kembalian = $bayar - $totalharga;
                                                    $_SESSION['kembalian'] = $kembalian;
                                                    if ($bayar < $totalharga) {
                                                        echo "<script> alert('Uang Kurang! Tolong masukan uang yang pas'); </script>";
                                                        echo "<script> window.location.href = document.referrer; </script>";
                                                        exit;
                                                        $kembalian = "none";
                                                    } else {
                                                        echo "<script> alert('Pembayaran berhasil!'); </script>";
                                                    }
                                                }                                                

                                            ?>
                                            <?php $no++ ?>
                                            <tr>
                                                <td scope="row"><?= $no; ?></td>
                                                <td><?= $nama_brg ?> - <?= $deskripsi ?></td>
                                                <td><?= $id_brg ?></td>
                                                <td><?= number_format($harga) ?></td>
                                                <td><?= $qty ?></td>
                                                <td>Rp.<?= number_format($subtotal) ?></td>
                                                <td class="text-white">
                                                    <!-- hapus -->
                                                    <a onclick="return confirm('Apakah anda yakin??')" class="btn btn-danger" href="_pesanan_model.php?hapus_brg_psn=<?= $p['id_detailpesanan'] ?>&id_psn=<?= $id_psn ?>"><i class="fa fa-trash"></i></a>

                                                    <!-- edit -->
                                                    <a class="btn btn-warning"  href="#" data-toggle="modal" data-target="#modaleditqty<?= $id_detailpesanan ?>"><i class="fa fa-edit"></a>
                                                    <!-- Modal Edit Quantity -->
                                                    <div class="modal fade" id="modaleditqty<?= $id_detailpesanan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Quantity</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="_pesanan_model.php" method="post">
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id_psn" value="<?= $id_psn ?>">
                                                                        <input type="hidden" name="id_detailpesanan" value="<?= $id_detailpesanan ?>">
                                                                        <div class="form-group">
                                                                            <label for="qty_baru" style="color: black;">Quantity Baru</label>
                                                                            <input type="number" class="form-control" id="qty_baru" name="qty_baru" value="<?= $qty ?>" min="1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary" name="edit_quantity">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ... -->
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table><hr>
                                    
                                    <form class="row g-3" action="" method="post">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Total Harga</label>
                                            <input type="text" name="totalharga" class="form-control" id="inputEmail4" value="<?= number_format($totalharga, 0, ',', '.') ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword4" class="form-label">Bayar</label>
                                            <input type="number" class="form-control" name="bayar" id="inputPassword4">
                                        </div>
                                        <div class="col-md-8 mb-3 mt-4">
                                            <label for="inputCity" class="form-label">Kembalian</label>
                                            <input type="text" class="form-control" name="kembalian" id="inputCity" value="<?= number_format($kembalian, 0, ',', '.') ?>" readonly>
                                        </div>
                                        <div class="col-md-1 mt-5">
                                            <button type="submit" name="hitung_bayar" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-md-3 mt-5">
                                            <a href="print.php?id_psn=<?= $id_psn ?>" target="_blank" class="btn btn-success">Cetak Nota</a>
                                        </div>
                                        
                                    </form>
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