<?php
session_start();
require_once('koneksi.php');
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_GET['id_pelanggan'])) {
    $id_pelanggan = $_GET['id_pelanggan'];
    $query = "SELECT p.*, b.nama_brg, d.qty FROM pesanan p JOIN detail_pesanan d ON p.id_pesanan = d.id_pesanan JOIN barang b ON d.id_brg = b.id_brg WHERE p.id_pelanggan='$id_pelanggan' ORDER BY p.tanggal_pesanan DESC";
    $data_riwayat = mysqli_query($conn, $query);
    $query_plgn = "SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
    $data_plgn = mysqli_query($conn, $query_plgn);
    $result_plgn = mysqli_fetch_assoc($data_plgn);
    $nama_pelanggan = $result_plgn['nama_pelanggan'];

} else {
    header("Location: pelanggan.php");
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
    <title>Riwayat Pembelian</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- link css -->
    <?php require_once('layout/_css.php'); ?>
</head>
<body class="dashboard dashboard_2">
<div class="full_container">
    <div class="inner_container">
        <!-- Sidebar -->
        <?php require_once('layout/_sidebar.php'); ?>
        <!-- End Sidebar -->
        <!-- Right Content -->
        <div id="content">
            <!-- Topbar -->
            <br>
            <?php require_once('layout/_topbar.php'); ?>
            <!-- End Topbar -->
            <!-- Dashboard Inner -->
            <div class="midde_cont">
                <!-- Isi -->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head mb-0">
                            <div class="heading1 margin_0">
                                <a href="pelanggan.php" class="btn btn-danger"><i class="fa fa-mail-reply"></i></a>
                            </div>
                            <h3 class="ml-5">Riwayat Pembelian</h3>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-sm">
                                <table class="table table-bordered">
                                <h4 style="color:grey;">
                                    <i class="fa fa-user"></i> : <?= $nama_pelanggan; ?>
                                </h4>
                                    <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Nama Barang</th>
                                        <th>qty</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 0; ?>
                                    <?php foreach ($data_riwayat as $row){ ?>
                                        <?php $no++; ?>
                                        <tr>
                                            <td scope="row"><?= $no; ?></td>
                                            <td><?= $row['tanggal_pesanan']; ?></td>
                                            <td><?= $row['nama_brg']; ?></td>
                                            <td><?= $row['qty']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Isi End -->
            </div>
            <!-- End Dashboard Inner -->
        </div>
    </div>
</div>
<!-- jQuery -->
<?php require_once('layout/_js.php'); ?>
</body>
</html>
