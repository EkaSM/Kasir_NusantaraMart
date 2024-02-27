<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-barang.php";

$title = "Laporan Stok - NusantaraMart";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Data Stock Barang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data Stok Barang</h3>
                    <a href="<?=$main_url ?>stok/form-stok.php" 
                    class="btn-sm btn-primary float-right"><i class="fas fa-plus fa-sm"></i> Add Stok</a>
                    <a href="<?= $main_url?>report/r-stok.php" 
                    class="btn btn-sm btn-outline-primary float-right mr-3" target="_blank">
                    <i class="fas fa-print"></i> Cetak</a>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Barang</th>
                                <th>Nama Barang</th>
                                <th class="text-center">Stok Sekarang</th>
                                <th class="text-center">Stok Minimal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $barang = getData("SELECT * FROM tbl_barang");
                            foreach ($barang as $brg) { ?>
                                <tr>
                                    <td><?= $no++?></td>
                                    <td><?= $brg['id_barang'] ?></td>
                                    <td><?= $brg['nama_barang'] ?></td>
                                    <td class="text-center"><?= $brg['stock'] ?></td>
                                    <td class="text-center"><?= $brg['stock_minimal'] ?></td>
                                    <td>
                                      <?php
                                        if ($brg['stock'] < $brg['stock_minimal']) {
                                          echo '<span class="text-danger">Stok Kurang
                                          </span>';
                                        } else {
                                          echo '<span class="text-success">Stok Cukup
                                          </span>';
                                        }
                                      ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php
require "../template/footer.php";
?>