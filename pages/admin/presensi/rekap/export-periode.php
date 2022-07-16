<?php
if (isset($_GET['periodeawal']) && isset($_GET['periodeakhir'])) {
    $periode_awal = $_GET['periodeawal'];
    $periode_akhir = $_GET['periodeakhir'];
}

function timeScan($attribute)
{
    $datetime = new DateTime($attribute);
    $jam = $datetime->format('H:i:s');
    return $jam;
}

$filename    = "Rekap Presensi periode";

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Rekap Presensi');
$sheet->setCellValue("A1", "REKAP PRESENSI");
$sheet->setCellValue("A3", "Pin");
$sheet->setCellValue("B3", "NIP");
$sheet->setCellValue("C3", "Nama");
$sheet->setCellValue("D3", "Jabatan");
$sheet->setCellValue("E3", "Periode");
$sheet->setCellValue("F3", "Hadir");
$sheet->setCellValue("G3", "Izin");
$sheet->setCellValue("H3", "Terlambat");


$i = 4;


// mengambil data pegawai untuk rekapperiode
$tampilPeg3    = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id ASC LIMIT 100");


if (!empty($periode_awal) && !empty($periode_akhir)) {
 
    $no=0;

    $begin = new DateTime($periode_awal);
    $end = new DateTime($periode_akhir);
    $end->modify("+1 day");
    $interval = $begin->diff($end);
    $interval->m > '1';
        while ($peg3    = mysqli_fetch_array($tampilPeg3, MYSQLI_ASSOC)) {
            $no++;

            $tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$peg3[pin]'");
            $peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);

            $tampilCari = mysqli_query($koneksi, "SELECT SUM(jk_count_as) AS hadir, SUM(late) AS terlambat FROM shift_result WHERE tgl_shift >= '$periode_awal' AND tgl_shift <= '$periode_akhir' AND pegawai_id = '$peg3[pegawai_id]'");
            $cari = mysqli_fetch_array($tampilCari, MYSQLI_ASSOC);

            $tampilJabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
            $jab    = mysqli_fetch_array($tampilJabatan, MYSQLI_ASSOC);
            $jabatan        = isset($jab) ? $jab['pembagian1_nama'] : '';



            $terlambat = $cari['terlambat'];

            $sheet->setCellValue("A" . $i, $peg3['pegawai_pin']);
            $sheet->setCellValue("B" . $i, $peg3['pegawai_nip']);
            $sheet->setCellValue("C" . $i, $peg3['pegawai_nama']);
            $sheet->setCellValue("D" . $i, $jabatan);
            $sheet->setCellValue("E" . $i, $begin->format("F").'/'.$begin->format("Y"));
            $sheet->setCellValue("F" . $i, $cari['hadir']);
            $sheet->setCellValue("G" . $i, $cari['hadir']);
            $sheet->setCellValue("H" . $i, $terlambat);
          
            $i++;
        }
    
}


$writer = new Xlsx($spreadsheet);
$file    = "../../assets/excel/$filename.xlsx";
$writer->save("$file");

header("location:$file");
