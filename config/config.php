<?php

date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'nm';

$koneksi =mysqli_connect($host, $user, $pass, $dbname);

// if ($dbconnect-> connect_error) {
//     echo 'Koneksi gagal';
//     exit();
// }
// else {
//     echo 'Koneksi berhasil';
// }

$main_url = 'http://localhost/kasirpenak/';
