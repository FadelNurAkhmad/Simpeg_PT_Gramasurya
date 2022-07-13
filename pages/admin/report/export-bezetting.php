<?php

$filename    = "Report Bezetting";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Report Bezetting');
$sheet->setCellValue("A1", "REPORT BEZETTING");
$sheet->setCellValue("A3", "No");
$sheet->setCellValue("B3", "Nama / TTL");
$sheet->setCellValue("C3", "NIP");
$sheet->setCellValue("D3", "Jabatan");
$sheet->setCellValue("E3", "Pendidikan Terakhir");
$sheet->setCellValue("F3", "UMUR");
$sheet->setCellValue("G3", "Ket.");


$expPeg    = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id JOIN tb_pegawai ON pegawai_d.pegawai_id=tb_pegawai.pegawai_id ORDER BY urut_pangkat DESC");
$i    = 4; //Dimulai dengan baris ke dua
$no    = 1;


while ($peg    = mysqli_fetch_array($expPeg)) {
    if ($peg['pegawai_status'] == '1') {
        $pgw = 'Aktif';
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
    $sheet->setCellValue("B" . $i, $peg['pegawai_nama'] . '/' . $peg['tempat_lahir'] . '/' . $peg['tgl_lahir']);
    $sheet->setCellValue("C" . $i, $peg['pegawai_nip']);
    $sheet->setCellValue("D" . $i, $hjab1);
    $sheet->setCellValue("E" . $i, $pegg);
    $sheet->setCellValue("F" . $i, $selisih->y);
    $sheet->setCellValue("G" . $i, $pgw);



    $no++;
    $i++;
}

$writer = new Xlsx($spreadsheet);
$file    = "../../assets/excel/$filename.xlsx";
$writer->save("$file");
