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

$id = $_GET['id'];
$tgl = $_GET['tgl'];
$stoks = getData("SELECT * FROM tbl_stok_detail WHERE no_stok = '$id'");

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detail Penambahan Stok</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=$main_url ?>laporan-stok">Laporan Penambahan Stok</a></li>
              <li class="breadcrumb-item active">Detail Penambahan Stok</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Rincian Barang</h3>
                    <button type="button" class="btn btn-sm btn-success float-right"><?= $tgl ?></button>
                    <button type="button" class="btn btn-sm btn-warning float-right mr-1"><?= $id ?></button>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th class="text-center">Tambah Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($stoks as $stok) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $stok['kode_brg'] ?></td>
                                    <td><?= $stok['nama_brg'] ?></td>
                                    <td><?= $stok['satuan'] ?></td>
                                    <td class="text-center"><?=  $stok['qty'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </section>
<?php
require "../template/footer.php";
?>