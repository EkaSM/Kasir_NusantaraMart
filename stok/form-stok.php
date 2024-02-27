<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-stok.php";

$title = "Form Stok Barang - NusantaraMart";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

// Jika barang dihapus
if ($msg == 'deleted') {
    $idbrg = $_GET['idbrg'];
    $idstok = $_GET['idstok'];
    $qty = $_GET['qty'];
    $tgl = $_GET['tgl'];
    delete($idbrg, $idstok, $qty);
    echo "<script>
        alert('Barcode berhasil dihapus...');
            document.location = 'form-stok.php?tgl=$tgl';
        </script>";
}


$kode = @$_GET['pilihbrg'] ? @$_GET['pilihbrg'] : '';
if ($kode) {
    $selectBrg = getData("SELECT * FROM tbl_barang WHERE id_barang = '$kode'")[0];
}

if (isset($_POST['addbrg'])) {
    $tgl = $_POST['tglNota'];
    if (insert($_POST)) {
        echo "<script>
            document.location = 'form-stok.php?tgl=$tgl';
        </script>";
    }
}

// Jika simpan diklik
if (isset($_POST['simpan'])) {
    if (simpan($_POST)) {
        echo "<script>
            alert('Data stok barang berhasil disimpan..');
            document.location = 'form-stok.php?msg=sukses';
        </script>";
    }
}
$noStok = generateNo();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Stok Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=$main_url ?>stok">Stok Barang</a></li>
              <li class="breadcrumb-item active">Tambah Stok</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
    <section>
        <div class="container-fluid">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline card-warning p-3">
                            <div class="form-group row mb-2">
                            <label for="noNota" class="col-sm-1 
                                col-form-label">No Stok</label>
                                <div class="col-sm-5 ">
                                    <input type="text" name="nostok"
                                    class="form-control" id="noNota" value="<?= 
                                    $noStok?>">
                                </div>
                                <label for="tglNota" class="col-sm-1 
                                col-form-label">Tgl Nota</label>
                                <div class="col-sm-5">
                                    <input type="date" name="tglNota"
                                    class="form-control" id="tglNota" value="<?= 
                                    @$_GET['tgl'] ? $_GET['tgl'] : date('Y-m-d') 
                                    ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="kodeBrg" class="col-sm-1 
                                col-form-label">Barang</label>
                                <div class="col-sm-11">
                                    <select name="kodeBrg" id="kodeBrg" class="form-control">
                                        <option value="">-- Pilih Barang --</option>
                                        <?php
                                        $barang = getData("SELECT * FROM tbl_barang");
                                        foreach ($barang as $brg){ ?>
                                            <option value="?pilihbrg=<?= $brg['id_barang']?> 
                                            <?= @$_GET['pilihbrg'] == $brg['id_barang'] ? 'selected' : null ?>">
                                            <?= $brg['id_barang'] . " | " . $brg['nama_barang']?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card pt-1 pb-2 px-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="hidden" value="<?= @$_GET
                                ['pilihbrg'] ? $selectBrg['id_barang'] : ''?>" name="kodeBrg">
                                <label for="namaBrg">Nama Barang</label>
                                <input type="text" name="namaBrg" 
                                class="form-control form-control-sm" id="namaBrg"
                                value="<?= @$_GET
                                ['pilihbrg'] ? $selectBrg['nama_barang'] : ''?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="stok">Stok Sekarang</label>
                                <input type="number" name="stok" 
                                class="form-control form-control-sm" id="stok"
                                value="<?= @$_GET
                                ['pilihbrg'] ? $selectBrg['stock'] : ''?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="stokmin">Stok Minimal</label>
                                <input type="number" name="stokmin" 
                                class="form-control form-control-sm" id="stokmin"
                                value="<?= @$_GET
                                ['pilihbrg'] ? $selectBrg['stock_minimal'] : ''?>"  readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" 
                                class="form-control form-control-sm" id="satuan"
                                value="<?= @$_GET
                                ['pilihbrg'] ? $selectBrg['satuan'] : ''?>"  readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" name="qty" 
                                class="form-control form-control-sm" id="qty"
                                value="<?= @$_GET
                                ['pilihbrg'] ?  1 : '' ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-info btn-block"
                    name="addbrg"><i class="fas fa-cart-plus fa-sm"></i> Tambah Barang</button>
                </div>
                <div class="card card-outline card-success table-responsive px-2">
                    <table class="table table-sm table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th class="text-right">Qty</th>
                                <th class="text-center" width="10%">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no = 1;
                            $brgDetail = getData("SELECT * FROM tbl_stok_detail
                            WHERE no_stok = '$noStok'");
                            foreach ($brgDetail as $detail) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $detail['kode_brg']?></td>
                                    <td><?= $detail['nama_brg']?></td>
                                    <td><?= $detail['satuan']?></td>
                                    <td class="text-right"><?= $detail['qty']?></td>
                                    <td class="text-center">
                                        <a href="?idbrg=<?= $detail['kode_brg'] 
                                        ?>&idstok=<?= $detail['no_stok'] 
                                        ?>&qty=<?= $detail['qty'] 
                                        ?>&tgl=<?= $detail['tgl_stok'] 
                                        ?>&msg=deleted" class="btn btn-sm btn-danger"
                                        title="hapus barang" onclick="return 
                                        confirm('Anda yakun akan menghapus barang ini ?')">
                                        <i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 p-2">
                        <div class="form-group row mb-2">
                            <label for="userr" class="col-sm-3 col-form-label
                            col-form-label-sm">User</label>
                            <div class="col-sm-9">
                                <select name="user" id="user"
                                class="form-control form-control-sm">
                                    <?php
                                    $users = getData("SELECT * FROM
                                    tbl_user");
                                    foreach ($users as $user) { ?>
                                        <option value="<?= $user['fullname']?>">
                                        <?= $user['fullname'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-2">
                        <button type="submit" name="simpan" id="simpan"
                        class="btn btn-primary btn-sm btn-block">
                        <i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        let pilihbrg = document.getElementById('kodeBrg');
        let tgl =document.getElementById('tglNota');
        pilihbrg.addEventListener('change', function(){
            document.location.href = this.options[this.selectedIndex].value + '&tgl=' + tgl.value;
        })
    </script>
<?php
require "../template/footer.php";
?>