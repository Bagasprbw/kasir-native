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
<html>
<head>
    <title>Nota Pembelian</title>
    <style>
        .print-button {
        display: block;
        }

    /* Tombol cetak disembunyikan saat dicetak */
        @media print {
            .print-button {
                display: none;
            }
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        p {
            font-weight: bold;
        }

        h2 {
            text-align: center;
        }
        h3{
            margin-top: 0;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }
        .td1 {
            text-align: right;
        }
        #thx {
            text-align: center;
            font-weight: bold;
            font-family: 'Oswald', sans-serif;
        }
    </style>
</head>
<body>
    <h2>BUKTI PEMBELIAN</h2>
    <h3>Toko Elektronik Bagas Jaya</h3><br><br>

    <h4>Id pesanan : <?= $id_psn ?></h2>
    <h4>Nama Pelanggan : <?= $nm_plgn ?></h2>
    <table>
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Jumlah Beli</th>
            <th>Total Harga</th>
        </tr>
        <?php $no = 0 ?>
        <?php
        $totalharga = 0;
        $get = mysqli_query($conn,
            "SELECT * FROM detail_pesanan p, barang br WHERE p.id_brg=br.id_brg AND id_pesanan='$id_psn'"
        );
        while ($p = mysqli_fetch_array($get)) {
            $id_detailpesanan = $p['id_detailpesanan'];
            $deskripsi = $p['deskripsi'];
            $qty = $p['qty'];
            $harga = $p['harga'];
            $nama_brg = $p['nama_brg'];
            $subtotal = $qty * $harga;
            $totalharga += $subtotal;
            //hitung kembalian
            
        ?>
        <?php $no++ ?>
        <tr>
            <td scope="row"><?= $no; ?></td>
            <td><?= $nama_brg ?> - <?= $deskripsi ?></td>
            <td><?= number_format($harga) ?></td>
            <td><?= $qty ?></td>
            <td>Rp.<?= number_format($subtotal) ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th colspan="4" class="td1">Total Harga </th>
            <th>Rp.<?=number_format($totalharga)?></th>
        </tr>
    </table>
    ...
    <p>Total Harga: Rp. <?=number_format($totalharga)?></p>
    <p>Jumlah Bayar: Rp. <?= number_format($_SESSION['bayar'], 0, ',', '.')?></p>
    <p>Kembalian: Rp. <?= number_format($_SESSION['kembalian'], 0, ',', '.') ?></p> <br>

    <h3 id="thx">Terima kasih atas pesanannya !</h3><br>

    <button class="print-button" onclick="printPage()">Cetak</button>

<script>
    function printPage() {
        window.print();
    }
</script>
</body>
</html>
