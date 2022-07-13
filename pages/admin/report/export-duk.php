<?php

$filename    = "Report DUK";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Report DUK');
$sheet->setCellValue("A1", "REPORT DUK");
$sheet->setCellValue("A3", "No");
$sheet->setCellValue("B3", "Nama / TTL");
$sheet->setCellValue("C3", "NIP");
$sheet->setCellValue("D3", "Jabatan");
$sheet->setCellValue("E3", "TMT");
$sheet->setCellValue("F3", "Pendidikan Akhir / Asal");
$sheet->setCellValue("G3", "Tahun Lulus");
$sheet->setCellValue("H3", "ket.");;


$expPeg    = mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id= tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id ");
$i    = 4; //Dimulai dengan baris ke dua
$no    = 1;

while ($peg    = mysqli_fetch_array($expPeg)) {
    if ($peg['pegawai_status'] == '1') {
        $pgw = 'Aktif';
    }
    $expeg2 = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]' AND status='Akhir'");
    $peg2 = mysqli_fetch_array($expeg2, MYSQLI_ASSOC);
    $pegg = isset($peg2['tingkat']) ? $peg2['tingkat'] : '';
    $pegg1 = isset($peg2['nama_sekolah']) ? $peg2['nama_sekolah'] : '';
    $peg1 = isset($peg2['tgl_ijazah']) ? $peg2['tgl_ijazah'] : '';

    $expeg3 = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
    $peg3 = mysqli_fetch_array($expeg3, MYSQLI_ASSOC);
    $pegi = isset($peg3['jabatan']) ? $peg3['jabatan'] : '';
    $pegii = isset($peg3['tmt_jabatan']) ? $peg3['tmt_jabatan'] : '';

    $expUni    = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
    $uni    = mysqli_fetch_array($expUni);

    $sheet->setCellValue("A" . $i, $no);
    $sheet->setCellValue("B" . $i, $peg['pegawai_nama'] . '/' . $peg['tempat_lahir'] . '/' . $peg['tgl_lahir']);
    $sheet->setCellValue("C" . $i, $peg['pegawai_nip']);
    $sheet->setCellValue("D" . $i, $pegi);
    $sheet->setCellValue("E" . $i, $pegii);
    $sheet->setCellValue("F" . $i, $pegg . '/' . $pegg1);
    $sheet->setCellValue("G" . $i, $peg1);
    $sheet->setCellValue("H" . $i, $pgw);


    $no++;
    $i++;
}

$writer = new Xlsx($spreadsheet);
$file    = "../../assets/excel/$filename.xlsx";
$writer->save("$file");
