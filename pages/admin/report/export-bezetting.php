<?php

$filename    = "Report Bezetting";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Report Bezetting');
$sheet->setCellValue("A1", "REPORT BEZETTING");
$sheet->setCellValue("A3", "No");
$sheet->setCellValue("B3", "Nama");
$sheet->setCellValue("C3", "TTL");
$sheet->setCellValue("D3", "NIP");
$sheet->setCellValue("E3", "Jabatan");
$sheet->setCellValue("F3", "Pendidikan Terakhir");
$sheet->setCellValue("G3", "UMUR");
$sheet->setCellValue("H3", "Ket.");


$expPeg    = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id JOIN tb_pegawai ON pegawai_d.pegawai_id=tb_pegawai.pegawai_id ORDER BY urut_pangkat DESC");
$i    = 4; //Dimulai dengan baris ke dua
$no    = 1;


while ($peg    = mysqli_fetch_array($expPeg)) {
    //ttl
    if (isset($peg['tempat_lahir'])) {
        $pie = '' . $peg['tempat_lahir'];
    } else {
        $pie = '' . isset($peg['tempat_lahir']);
    }

    if (isset($peg['tgl_lahir'])) {
        $pie1 = '/' . $peg['tgl_lahir'];
    } else {
        $pie1 = '' . isset($peg['tgl_lahir']);
    }
    //status
    if ($peg['pegawai_status'] == '1') {
        $pgw = 'Aktif';
    }
    if ($peg['pegawai_status'] == '2') {
        $pgw = 'Non-Aktif';
    }
    $expeg2 = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]' AND status='Akhir'");
    $peg2 = mysqli_fetch_array($expeg2, MYSQLI_ASSOC);
    $pegg = isset($peg2['tingkat']) ? $peg2['tingkat'] : '';

    $idJab = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]' ");
    $hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
    $hjab1 = isset($hjab['jabatan']) ? $hjab['jabatan'] : '';


    $lhr    = new DateTime($peg['tgl_lahir']);
    $today    = new DateTime();
    $selisih    = $today->diff($lhr);

    $expUni    = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
    $uni    = mysqli_fetch_array($expUni);
    $uni    = mysqli_fetch_array($expUni);

    $sheet->setCellValue("A" . $i, $no);
    $sheet->setCellValue("B" . $i, $peg['pegawai_nama']);
    $sheet->setCellValue("C" . $i, $pie . $pie1);
    $sheet->setCellValue("D" . $i, $peg['pegawai_nip']);
    $sheet->setCellValue("E" . $i, $hjab1);
    $sheet->setCellValue("F" . $i, $pegg);
    $sheet->setCellValue("G" . $i, $selisih->y);
    $sheet->setCellValue("H" . $i, $pgw);



    $no++;
    $i++;
}

$writer = new Xlsx($spreadsheet);
$file    = "../../assets/excel/$filename.xlsx";
$writer->save("$file");
