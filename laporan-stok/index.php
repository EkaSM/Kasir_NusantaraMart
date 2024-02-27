<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-barang.php";

$title = "Laporan Stok Masuk - NusantaraMart";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$stoks = getData("SELECT * FROM tbl_stok");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Stok Masuk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Laporan Penambahan Stok</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data Penambahan Stok</h3>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Stok</th>
                                <th>User</th>
                                <th class="text-center">Tgl Penambahan Stok</th>
                                <th style="width: 10%;" class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($stoks as $stok) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $stok['no_stok'] ?></td>
                                    <td><?= $stok['user'] ?></td>
                                    <td class="text-center"><?= in_date($stok['tgl_stok']) ?></td>
                                    <td class="text-center">
                                        <a href="detail-stok.php?id=<?= $stok['no_stok']?>
                                        &tgl=<?= in_date($stok['tgl_stok']) ?>" class="btn btn-sm btn-info" title="Rincian penambahan">Detail</a>
                                    </td>
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