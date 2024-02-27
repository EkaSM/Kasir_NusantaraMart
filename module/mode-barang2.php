<?php

if (userLogin()['level'] == 2) {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function generateId(){
    global $koneksi;

    $queryId = mysqli_query($koneksi, "SELECT max(id_barang) as maxid FROM tbl_barang");
    $data = mysqli_fetch_array($queryId);
    $maxId = $data['maxid'];

    $noUrut = (int) substr($maxId, 4, 3);
    $noUrut++;
    $maxId = "BRG-" . sprintf("%03s", $noUrut);

    return $maxId;
}

function insert($data){
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['kode']);
    $barcode = mysqli_real_escape_string($koneksi, $data['barcode']);
    $name = mysqli_real_escape_string($koneksi, $data['name']);
    $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
    $harga_beli = mysqli_real_escape_string($koneksi, $data['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi, $data['harga_jual']);
    // $stock = mysqli_real_escape_string($koneksi, $data['stock']);
    $stockmin = mysqli_real_escape_string($koneksi, $data['stock_minimal']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);
    

    $cekBarcode = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE barcode = 
    '$barcode'");
    if (mysqli_num_rows($cekBarcode)) {
        echo '<script>
        alert("Kode barcode sudah ada, barang gagal ditambahkan")</script>';
        return false;
    }

    // Upload gambar barang
    if ($gambar != null) {
        $gambar = uploadimg(null, $id);
    } else {
        $gambar = 'brg.png';
    }

    //Vadli Gambar
    if ($gambar == '') {
        return false;   
    }

    $sqlBarang = "INSERT INTO tbl_barang VALUE ('$id', '$barcode', 
    '$name', $harga_beli, $harga_jual, 0, '$satuan', $stockmin, '$gambar')";
    mysqli_query($koneksi, $sqlBarang);

    return mysqli_affected_rows($koneksi); 
}

function delete($id, $gbr) {
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_barang WHERE id_barang = '$id'";
    mysqli_query($koneksi, $sqlDel);
    if ($gbr != 'brg.png') {
        unlink('../asset/image/' . $gbr);
    }

    return mysqli_affected_rows($koneksi);
}

function update($data){
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['kode']);
    $barcode = mysqli_real_escape_string($koneksi, $data['barcode']);
    $name = mysqli_real_escape_string($koneksi, $data['name']);
    $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
    $harga_beli = mysqli_real_escape_string($koneksi, $data['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi, $data['harga_jual']);
    // $stock = mysqli_real_escape_string($koneksi, $data['stock']);
    $stockmin = mysqli_real_escape_string($koneksi, $data['stock_minimal']);
    $gbrLama = mysqli_real_escape_string($koneksi, $data['oldImg']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);

    //Barcode lama
    $queryBarcode = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE id_barang = '$id'");
    $dataBrg = mysqli_fetch_assoc($queryBarcode);
    $curBarcode = $dataBrg['barcode'];
    // Barcode baru input
    $cekBarcode = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE barcode = 
    '$barcode'");

    // Cek apakah barcode diganti ?
    if ($barcode != $curBarcode) {
        // If barcode ada
        if (mysqli_num_rows($cekBarcode)) {
            echo '<script>
            alert("Kode barcode sudah ada, barang gagal diperbarui")</script>';
            return false;
        }
    }
    
    // Cek gambar
    if ($gambar != null) {
        $url = "index.php";
        if ($gbrLama == 'brg.png') {
            $nmgbr = $id;
        } else {
            $nmgbr = $id . '-' . rand(10, 1000);
        }
        $imgBrg = uploadimg($url, $nmgbr);
        if ($gbrLama != 'brg.png') {
            @unlink('../asset/image/'. $gbrLama);
        }
    } else {
        $imgBrg = $gbrLama;
    }

    mysqli_query($koneksi, "UPDATE tbl_barang SET 
                            barcode = '$barcode',
                            nama_barang = '$name',
                            harga_beli = $harga_beli,
                            harga_jual = $harga_jual,
                            satuan = '$satuan',
                            stock_minimal = $stockmin,
                            gambar = '$imgBrg'
                            WHERE id_barang = '$id'
                            ");
                
    return mysqli_affected_rows($koneksi);
}