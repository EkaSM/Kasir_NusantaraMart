<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];
$dataJual = getData("SELECT* FROM tbl_jual_head WHERE tgl_jual BETWEEN '$tgl1' AND '$tgl2'");
$totalKeseluruhan = 0; // Inisialisasi total keseluruhan


// Ubah format tanggal menjadi format yang lebih mudah dibaca
$tgl1_formatted = date('d M Y', strtotime($tgl1));
$tgl2_formatted = date('d M Y', strtotime($tgl2));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
</head>
<body>
    
    <div style="text-align: center;">
        <h1 style="margin-bottom: -15px;">Rekap Laporan Penjualan</h1>
        <h2 style="margin-bottom: 15px;">NusantaraMart</h2>
        <h3 style="margin-top: 15px;">Periode :</h3>
        <h3 style="margin-bottom: 15px; "><?= $tgl1_formatted ?>   s/d   <?= $tgl2_formatted ?></h3>
    </div>

    <table align="center">
        <thead>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px;" size="3" color="grey">
                </td>
            </tr>
            <tr>
                <th>No</th>
                <th style="width: 150px;">Tgl Penjualan</th>
                <th style="width: 150px;">ID Penjualan</th>
                <th style="width: 150px;">Customer</th>
                <th>Total Penjualan</th>
            </tr>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px; margin-top: 1px" size="3" color="grey">
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataJual as $data) {
                $totalKeseluruhan += $data['total']; // Menambahkan total penjualan ke total keseluruhan
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td align="center"><?= in_date($data['tgl_jual']) ?></td>
                    <td align="center"><?= $data['no_jual'] ?></td>
                    <td align="center"><?= $data['customer'] ?></td>
                    <td align="right"><?= number_format($data['total'], 0, ',', '.') ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px; margin-top: 1px" size="3" color="grey">
                </td>
            </tr>
            <tr>
                <td colspan="4" align="right"><strong>Total Keseluruhan : </strong></td>
                <td align="right"><strong><?= number_format($totalKeseluruhan, 0, ',', '.') ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>
