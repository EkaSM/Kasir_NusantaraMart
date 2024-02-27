<?php


session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
  header("location: auth/login.php");
  exit();
}
require "config/config.php";
require "config/functions.php";

$title = "Dashboard - NusantaraMart";
require "template/header.php";
require "template/navbar.php";
require "template/sidebar.php";

$users = getData("SELECT * FROM tbl_user");
$userNum = count($users);

$cust = getData("SELECT * FROM tbl_customer");
$custNum = count($cust);

$barangs = getData("SELECT * FROM tbl_barang");
$barNum = count($barangs);
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   
    <!-- Main content -->
    <div class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php
            if (userLogin()['level'] == 1) {
          ?>
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $userNum ?></h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?=$main_url ?>user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $custNum ?></h3>

                <p>Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="<?=$main_url ?>customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $barNum ?></h3>

                <p>Barang</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-cart"></i>
              </div>
              <a href="<?=$main_url ?>barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <?php
            }
          ?>
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-outline card-danger">
              <div class="card-header text-info">
                <h5 class="card-title">Info Stok Barang</h5>
                <h5><a href="<?=$main_url ?>stok" class="float-right" title="laporan stok">
                <i class="fas fa-arrow-right"></i>
                </a></h5>
              </div>
              <table class="table">
                <tbody>
                  <?php
                    $stockMin = getData("SELECT * FROM tbl_barang WHERE stock < stock_minimal");
                    foreach ($stockMin as $min) { ?>
                      <tr>
                        <td><?= $min['nama_barang']?></td>
                        <td class="text-danger">Stock Kurang</td>
                      </tr>

                  <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card card-outline card-danger">
              <div class="card-header text-info">
                <h5>Omset Penjualan</h5>
              </div>
              <div class="card-body text-primary">
                <h2><span class="h4">Rp. </span><?= omset()?></h2>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
    <!-- /.content -->
<?php

require "template/footer.php";
?>