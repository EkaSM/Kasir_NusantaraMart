<?php

if (userLogin()['level'] == 1) {
    header("location:" . $main_url ."error-page.php");
    exit();
}
function generateNo(){
    global $koneksi;

    $queryNo = mysqli_query($koneksi, "SELECT max(no_jual) as maxno FROM 
    tbl_jual_head");
    $row = mysqli_fetch_assoc($queryNo);
    $maxno = $row["maxno"];

    $noUrut = (int) substr($maxno, 2, 4);
    $noUrut++;
    $maxno = 'PJ' . sprintf("%04s", $noUrut);

    return $maxno;
}

function totalJual($noJual){
    global $koneksi;

    $totalJual = mysqli_query($koneksi, "SELECT sum(jml_harga) AS total FROM
    tbl_jual_detail WHERE no_jual = '$noJual'");
    $data = mysqli_fetch_assoc($totalJual);
    $total = $data["total"];

    return $total;
}
function insert($data){
    global $koneksi;

    $no = mysqli_real_escape_string($koneksi, $data['nojual']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $kode = mysqli_real_escape_string($koneksi, $data['barcode']);
    $nama = mysqli_real_escape_string($koneksi, $data['namaBrg']);
    $qty = mysqli_real_escape_string($koneksi, $data['qty']);
    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $jmlharga = mysqli_real_escape_string($koneksi, $data['jmlHarga']);
    $stok = mysqli_real_escape_string($koneksi, $data['stok']);

    // Cek barang apakah sudah diinput?
    $cekbrg = mysqli_query($koneksi, "SELECT * FROM tbl_jual_detail WHERE
    no_jual = '$no' AND barcode = '$kode'");
    if (mysqli_num_rows($cekbrg)) {
        echo "<script>
                alert('Barcode sudah ada, anda harus menghapusnya dulu jika ingin mengubah qty nya..');
            </script>";
        return false;
    }

    // Qty tidak boleh 0 
    if (empty($qty)) {
        echo "<script>
            alert('Qty tidak boleh kosong..');
        </script>";
        return false;
    } else if ($qty > $stok) {
        echo "<script>
            alert('Stok barang tidak mencukupi..');
        </script>";
        return false;
    } else {
        $sqlJual = "INSERT INTO tbl_jual_detail VALUES (null, '$no', '$tgl',
        '$kode', '$nama', $qty, $harga, $jmlharga)";
        mysqli_query($koneksi, $sqlJual);
    }

    mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock - $qty WHERE
    barcode = '$kode'");

    mysqli_affected_rows($koneksi);
}

// function insert($data){
//     global $koneksi;

//     $no = mysqli_real_escape_string($koneksi, $data['nojual']);
//     $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
//     $kode = mysqli_real_escape_string($koneksi, $data['barcode']);
//     $nama = mysqli_real_escape_string($koneksi, $data['namaBrg']);
//     $qty = 1; // Set qty awal ke 1
//     $harga = mysqli_real_escape_string($koneksi, $data['harga']);
//     $jmlharga = mysqli_real_escape_string($koneksi, $data['jmlHarga']);
//     $stok = mysqli_real_escape_string($koneksi, $data['stok']);

//     // Cek barang apakah sudah diinput
//     $cekbrg = mysqli_query($koneksi, "SELECT * FROM tbl_jual_detail WHERE no_jual = '$no' AND barcode = '$kode'");
//     if (mysqli_num_rows($cekbrg)) {
//         // Jika barang sudah ada, tambahkan 1 ke kuantitasnya
//         $sqlUpdateQty = "UPDATE tbl_jual_detail SET qty = qty + 1 WHERE no_jual = '$no' AND barcode = '$kode'";
//         mysqli_query($koneksi, $sqlUpdateQty);
//     } else {
//         // Jika barang belum ada, tambahkan barang baru dengan qty 1
//         $sqlJual = "INSERT INTO tbl_jual_detail VALUES (null, '$no', '$tgl', '$kode', '$nama', $qty, $harga, $jmlharga)";
//         mysqli_query($koneksi, $sqlJual);
//     }

//     // Kurangi stok barang dari database
//     mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock - $qty WHERE barcode = '$kode'");

//     return mysqli_affected_rows($koneksi);
// }


function delete($barcode, $idjual, $qty){
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_jual_detail WHERE barcode = '$barcode' AND
    no_jual = '$idjual'";
    mysqli_query($koneksi, $sqlDel);

    mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock + $qty WHERE
    id_barang = '$barcode'");

    return mysqli_affected_rows($koneksi);
}

function simpan($data) {
    global $koneksi;

    $nojual = mysqli_real_escape_string($koneksi, $data['nojual']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $total = mysqli_real_escape_string($koneksi, $data['total']);
    $customer = mysqli_real_escape_string($koneksi, $data['customer']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['ketr']);
    $bayar = mysqli_real_escape_string($koneksi, $data['bayar']);
    $kembalian = mysqli_real_escape_string($koneksi, $data['kembalian']);

    $sqljual = "INSERT INTO tbl_jual_head VALUES ('$nojual','$tgl','$customer','$total','$keterangan',$bayar,$kembalian)";
    mysqli_query($koneksi, $sqljual);

    return mysqli_affected_rows($koneksi);
}
