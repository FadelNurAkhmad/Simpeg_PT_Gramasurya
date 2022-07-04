<?php
$filename    = "Rekap Presensi scanlog";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Rekap Presensi');
$sheet->setCellValue("A1", "REKAP PRESENSI");
$sheet->setCellValue("A3", "Tanggal Scan");
$sheet->setCellValue("B3", "Tanggal");
$sheet->setCellValue("C3", "Jam");
$sheet->setCellValue("D3", "PIN");
$sheet->setCellValue("E3", "NIP");
$sheet->setCellValue("F3", "Nama");
$sheet->setCellValue("G3", "Jabatan");
$sheet->setCellValue("H3", "SN");

$i = 4;
$tampilPres    = mysqli_query($koneksi, "SELECT * FROM att_log ORDER BY scan_date DESC LIMIT 100");

if (!empty($_POST['periode_awal']) && !empty($_POST['periode_akhir'])) {
    $tampilCari = mysqli_query($koneksi, "SELECT * FROM att_log WHERE DATE(scan_date) >= '$_POST[periode_awal]' AND DATE(scan_date) <= '$_POST[periode_akhir]'");

    $no = 0;
    while ($cari = mysqli_fetch_array($tampilCari, MYSQLI_ASSOC)) {
        $no++;
        $myvalue = $cari['scan_date'];
        $datetime = new DateTime($myvalue);

        $date = $datetime->format('Y-m-d');
        $time = $datetime->format('H:i:s');

        $tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$cari[pin]'");
        $peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);

        $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
        $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
        $jabb = isset($jab['pembagian1_nama']) ? $jab['pembagian1_nama'] : '';

        $sheet->setCellValue("A" . $i, $no);
        $sheet->setCellValue("B" . $i, $cari['scan_date']);
        $sheet->setCellValue("C" . $i, $date);
        $sheet->setCellValue("D" . $i, $time);
        $sheet->setCellValue("E" . $i, $cari['pin']);
        $sheet->setCellValue("F" . $i, $peg['pegawai_nip']);
        $sheet->setCellValue("G" . $i, $peg['pegawai_nama']);
        $sheet->setCellValue("H" . $i, $jabb);
        $sheet->setCellValue("I" . $i, $cari['sn']);
        $i++;
    }
}

if (empty($_POST['periode_awal']) && empty($_POST['periode_akhir'])) {
    $no = 0;
    while ($pres    = mysqli_fetch_array($tampilPres, MYSQLI_ASSOC)) {
        $no++;


        $tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$pres[pin]'");
        $peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);

        $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
        $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
        $jabb = isset($jab['pembagian1_nama']) ? $jab['pembagian1_nama'] : '';

        $myvalue = $pres['scan_date'];
        $datetime = new DateTime($myvalue);

        $tanggal = $datetime->format('Y-m-d');
        $jam = $datetime->format('H:i:s');

        $sheet->setCellValue("A" . $i, $no);
        $sheet->setCellValue("B" . $i, $pres['scan_date']);
        $sheet->setCellValue("C" . $i, $tanggal);
        $sheet->setCellValue("D" . $i, $jam);
        $sheet->setCellValue("E" . $i, $pres['pin']);
        $sheet->setCellValue("F" . $i, $peg['pegawai_nip']);
        $sheet->setCellValue("G" . $i, $peg['pegawai_nama']);
        $sheet->setCellValue("H" . $i, $jabb);
        $sheet->setCellValue("I" . $i, $pres['sn']);
        $i++;
    }
}

$writer = new Xlsx($spreadsheet);
$file    = "../../assets/excel/$filename.xlsx";
$writer->save("$file");
