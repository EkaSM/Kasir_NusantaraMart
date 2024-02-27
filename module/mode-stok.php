<?php

function generateNo(){
    global $koneksi;

    $queryNo = mysqli_query($koneksi, "SELECT max(no_stok) as maxno FROM 
    tbl_stok");
    $row = mysqli_fetch_assoc($queryNo);
    $maxno = $row["maxno"];

    $noUrut = (int) substr($maxno, 2, 4);
    $noUrut++;
    $maxno = 'TS' . sprintf("%04s", $noUrut);

    return $maxno;
}

function insert($data){
    global $koneksi;

    $no = mysqli_real_escape_string($koneksi, $data['nostok']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $kode = mysqli_real_escape_string($koneksi, $data['kodeBrg']);
    $nama = mysqli_real_escape_string($koneksi, $data['namaBrg']);
    $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
    $qty = mysqli_real_escape_string($koneksi, $data['qty']);

    $cekbrg = mysqli_query($koneksi, "SELECT * FROM tbl_stok_detail WHERE
    no_stok = '$no' AND kode_brg = '$kode'");
    if (mysqli_num_rows($cekbrg)) {
        echo "<script>
                alert('Barang sudah ada, anda harus menghapusnya dulu jika ingin mengubah qty nya..');
            </script>";
        return false;
    }

    if (empty($qty)) {
        echo "<script>
            alert('Qty tidak boleh kosong..');
        </script>";
        return false;
    } else {
        $sqlstok = "INSERT INTO tbl_stok_detail VALUES (null, '$no', '$tgl',
        '$kode', '$nama', '$satuan', $qty)";
        mysqli_query($koneksi, $sqlstok);
    }

    mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock + $qty WHERE
    id_barang = '$kode'");

    mysqli_affected_rows($koneksi);
}

function delete($idbrg, $idstok, $qty){
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_stok_detail WHERE kode_brg = '$idbrg' AND
    no_stok = '$idstok'";
    mysqli_query($koneksi, $sqlDel);

    mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock - $qty WHERE
    id_barang = '$idbrg'");

    return mysqli_affected_rows($koneksi);
}

function simpan($data) {
    global $koneksi;

    $nostok = mysqli_real_escape_string($koneksi, $data['nostok']);
    $user = mysqli_real_escape_string($koneksi, $data['user']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);

    $sqlsave = "INSERT INTO tbl_stok VALUES ('$nostok','$user','$tgl')";
    mysqli_query($koneksi, $sqlsave);

    return mysqli_affected_rows($koneksi);
}
