<?php
    session_start();
    require_once('koneksi.php');
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }

    $record_ksr=mysqli_query($conn, "SELECT * FROM kasir");
    $output_record_ksr=mysqli_num_rows($record_ksr);

    $record_brg=mysqli_query($conn, "SELECT * FROM barang");
    $output_record_brg=mysqli_num_rows($record_brg);

    $record_plgn=mysqli_query($conn, "SELECT * FROM pelanggan");
    $output_record_plgn=mysqli_num_rows($record_plgn);

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
      <title>Pluto</title>
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
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Dashboard</h2>
                                </div>
                            </div>
                        </div>
                        <!-- ISI -->
                        <div class="row column1">
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30 yellow_bg">
                                    <div class="couter_icon">
                                        <div> 
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no"><?= $output_record_ksr ?></p>
                                            <p class="head_couter">Kasir</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_0 blue1_bg">
                                    <div class="couter_icon">
                                        <div> 
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no"><?= $output_record_brg ?></p>
                                            <p class="head_couter">Total Barang</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30 green_bg">
                                    <div class="couter_icon">
                                        <div> 
                                            <i class="fa fa-cloud-download"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no"><?= $output_record_plgn ?></p>
                                            <p class="head_couter">Total Pelanggan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30 red_bg">
                                    <div class="couter_icon">
                                        <div> 
                                            <i class="fa fa-comments-o"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no"><?= $output_record_psn ?></p>
                                            <p class="head_couter">Total Pemesan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="full white_shd">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>Total Amount</h2>
                                        </div>
                                    </div>
                                    <div class="full padding_infor_info">
                                        <div class="price_table">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Hari Ini</th>
                                                        <td>$250.30</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Bulan Ini</th>
                                                        <td>$10.34</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- END ISI -->
                    </div>
                  <!-- footer -->
                  <?php require_once('layout/_footer.php'); ?>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <?php require_once('layout/_js.php'); ?>
   </body>
</html>