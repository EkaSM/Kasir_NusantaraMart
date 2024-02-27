<?php

require "../config/config.php";
require "../config/functions.php";
require "../asset/fpdf/vendor/autoload.php";

$stokBrg = getData("SELECT * FROM tbl_barang");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,'Laporan Stok Barang',0,1,'C');
// Tampilkan waktu sekarang di bawah laporan stok
$pdf->Ln(10); // Tambahkan spasi vertikal
$pdf->Cell(0, 10, 'Pertanggal :' , 0, 1, 'C');
$pdf->Cell(0, 8,  date('d - M - Y'), 0, 1, 'C');
$pdf->Cell(0, 8,  date('H:i:s'), 0, 1, 'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,'','B',1);
$pdf->Cell(10,10,'No',0,0,'C');
$pdf->Cell(35,10,'Kode Barang',0,0);
$pdf->Cell(50,10,'Nama Barang',0,0);
$pdf->Cell(30,10,'Stock',0,0,'C');
$pdf->Cell(30,10,'Satuan',0,0);
$pdf->Cell(20,10,'Status',0,1,'C');
$pdf->Cell(190,1,'','T',1);

$pdf->SetFont('Arial','',12);
$no = 1;
foreach ($stokBrg as $stock) {
    $pdf->Cell(10,8,$no++,0,0,'C');
    $pdf->Cell(35,8,$stock['id_barang'],0,0);
    $pdf->Cell(50,8,$stock['nama_barang'],0,0);
    $pdf->Cell(30,8,$stock['stock'],0,0,'C');
    $pdf->Cell(30,8,$stock['satuan'],0,0);
      
    // Menambahkan kondisi if-else untuk menentukan status stok
    if ($stock['stock'] < $stock['stock_minimal']) {
        $status_stok = 'Kurang';
        $warna = [255, 0, 0]; // Merah untuk stok kurang
    } else {
        $status_stok = 'Cukup';
        $warna = [0, 255, 0]; // Hijau untuk stok cukup
    }
    
    // Set warna teks sesuai kondisi
    $pdf->SetTextColor($warna[0], $warna[1], $warna[2]);
    $pdf->Cell(20,8,$status_stok,0,1,'C');

     // Set warna teks kembali ke default (hitam)
     $pdf->SetTextColor(0);
}
$pdf->Cell(190,1,'','T',1);

$pdf->Output();
?>
