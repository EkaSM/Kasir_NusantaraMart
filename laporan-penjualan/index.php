<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-barang.php";

$title = "Laporan Penjualan - NusantaraMart";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

// Set default tanggal
$tgl1_default = date("Y-m-d");
$tgl2_default = date("Y-m-d");

// Jika filter tanggal diisi, gunakan nilai dari filter, jika tidak gunakan default tanggal
$tgl1_filter = isset($_GET['tgl1']) ? $_GET['tgl1'] : $tgl1_default;
$tgl2_filter = isset($_GET['tgl2']) ? $_GET['tgl2'] : $tgl2_default;

// Query dengan filter tanggal
$penjualan = getData("SELECT * FROM tbl_jual_head WHERE tgl_jual BETWEEN '$tgl1_filter' AND '$tgl2_filter'");

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Penjualan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data Penjualan</h3>
                    <!-- Filter Tanggal -->
                    <form class="form-inline float-right" method="GET" action="">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="tgl1" class="mr-2">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tgl1" name="tgl1" value="<?= $tgl1_filter ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="tgl2" class="mr-2">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tgl2" name="tgl2" value="<?= $tgl2_filter ?>">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-filter"></i> Filter</button>
                    </form>
                </div>
                <div class="card-body table-responsive p-3">
                   <!-- Tombol Cetak -->
                   <div class="text-right mb-2">
                        <a href="../report/r-jual.php?tgl1=<?= $tgl1_filter ?>&tgl2=<?= $tgl2_filter ?>" class="btn btn-sm btn-outline-primary mr-2">
                            <i class="fas fa-print"></i> Cetak
                        </a>
                    </div>
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Penjualan</th>
                                <th>Tgl Penjualan</th>
                                <th>Customer</th>
                                <th>Total Penjualan</th>
                                <th style="width: 10%;" class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penjualan as $jual) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $jual['no_jual'] ?></td>
                                    <td><?= in_date($jual['tgl_jual']) ?></td>
                                    <td><?= $jual['customer'] ?></td>
                                    <td class="text-center">
                                        <?= number_format($jual['total'], 0, ",", ".") ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="detail-penjualan.php?id=<?= $jual['no_jual'] ?>&tgl=<?= in_date($jual['tgl_jual']) ?>" class="btn btn-sm btn-warning" title="Rincian barang"><b>Detail</b></a>
                                        <a href="../report/r-struk.php?nota=<?= $jual['no_jual'] ?>" class="btn btn-sm btn-success" title="Cetak Nota"><i class="fas fa-scroll"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Tombol Cetak
                <div class="card-footer">
                    <a href="../report/r-jual.php?tgl1=<?= $tgl1_filter ?>&tgl2=<?= $tgl2_filter ?>" class="btn btn-sm btn-outline-primary float-right">
                        <i class="fas fa-print"></i> Cetak
                    </a>
                </div> -->
            </div>
        </div>
    </section>

<?php
require "../template/footer.php";
?>
