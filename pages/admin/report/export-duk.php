<?php

$filename    = "Report DUK";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Report DUK');
$sheet->setCellValue("A1", "REPORT DUK");
$sheet->setCellValue("A3", "No");
$sheet->setCellValue("B3", "Nama");
$sheet->setCellValue("C3", "TTL");
$sheet->setCellValue("D3", "NIP");
$sheet->setCellValue("E3", "Jabatan");
$sheet->setCellValue("F3", "TMT");
$sheet->setCellValue("G3", "Pendidikan Akhir / Asal");
$sheet->setCellValue("H3", "Tahun Lulus");
$sheet->setCellValue("I3", "ket.");;


$expPeg    = mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id= tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id ");
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
    //
    if ($peg['pegawai_status'] == '1') {
        $pgw = 'Aktif';
    }
    if ($peg['pegawai_status'] == '2') {
        $pgw = 'Non-Aktif';
    }
    $expeg2 = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]' AND status='Akhir'");
    $peg2 = mysqli_fetch_array($expeg2, MYSQLI_ASSOC);

    //sekolah
    if (isset($peg2['tingkat'])) {
        $tkt = $peg2['tingkat'];
    } else {
        $tkt = '' . isset($peg2['tingkat']);
    }
    if (isset($peg2['nama_sekolah'])) {
        $skl = '/' . $peg2['nama_sekolah'];
    } else {
        $skl = '' . isset($peg2['nama_sekolah']);
    }
    //tgl ijzh
    $peg1 = isset($peg2['tgl_ijazah']) ? $peg2['tgl_ijazah'] : '';

    $expeg3 = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
    $peg3 = mysqli_fetch_array($expeg3, MYSQLI_ASSOC);
    $pegi = isset($peg3['jabatan']) ? $peg3['jabatan'] : '';
    $pegii = isset($peg3['tmt_jabatan']) ? $peg3['tmt_jabatan'] : '';

    $expUni    = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
    $uni    = mysqli_fetch_array($expUni);

    $sheet->setCellValue("A" . $i, $no);
    $sheet->setCellValue("B" . $i, $peg['pegawai_nama']);
    $sheet->setCellValue("C" . $i,  $pie . $pie1);
    $sheet->setCellValue("D" . $i, $peg['pegawai_nip']);
    $sheet->setCellValue("E" . $i, $pegi);
    $sheet->setCellValue("F" . $i, $pegii);
    $sheet->setCellValue("G" . $i, $tkt . $skl);
    $sheet->setCellValue("H" . $i, $peg1);
    $sheet->setCellValue("I" . $i, $pgw);


    $no++;
    $i++;
}

$writer = new Xlsx($spreadsheet);
$file    = "../../assets/excel/$filename.xlsx";
$writer->save("$file");
