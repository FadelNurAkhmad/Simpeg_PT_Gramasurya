<?php
$filename    = "Report Nominatif";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Report Nominatif');
$sheet->setCellValue("A1", "REPORT NOMINATIF");
$sheet->setCellValue("A3", "No");
$sheet->setCellValue("B3", "Nama");
$sheet->setCellValue("C3", "TTL / NIP / Agama");
$sheet->setCellValue("D3", "Jenis Kelamin");
$sheet->setCellValue("E3", "Jabatan");
$sheet->setCellValue("F3", "TMT");
$sheet->setCellValue("G3", "Pendidikan / Jurusan / T.Lulus");
$sheet->setCellValue("H3", "Alamat & Telp");
$sheet->setCellValue("I3", "Ket");


$expPeg    = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id JOIN tb_pegawai ON pegawai_d.pegawai_id=tb_pegawai.pegawai_id ORDER BY urut_pangkat DESC");
// $expeg1 = mysqli_query($koneksi, "SELECT * FROM pegawai_d WHERE pegawai_id='[pegawai_id]'");

$i    = 4; //Dimulai dengan baris ke dua
$no    = 1;



while ($peg    = mysqli_fetch_array($expPeg)) {
    $expeg2 = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]'AND status='Akhir'");
    $peg2 = mysqli_fetch_array($expeg2, MYSQLI_ASSOC);

    $expeg3 = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
    $peg3 = mysqli_fetch_array($expeg3, MYSQLI_ASSOC);

    if ($peg['pegawai_status'] == '1') {
        $pgw = 'Aktif';
    }
    if ($peg['agama'] == '1') {
        $agama = 'Islam';
    }
    if ($peg['gender'] == '1') {
        $gender = 'Laki-laki';
    } else {
        $gender = 'Perempuan';
    }
    $expUni    = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
    $uni    = mysqli_fetch_array($expUni);

    $sheet->setCellValue("A" . $i, $no);
    $sheet->setCellValue("B" . $i, $peg['pegawai_nama']);
    $sheet->setCellValue("C" . $i, $peg['tempat_lahir'] . '/' . $peg['tgl_lahir'] . '/' . $peg['pegawai_nip'] . '/' . $agama);
    $sheet->setCellValue("D" . $i, $gender);
    $sheet->setCellValue("E" . $i, (isset($peg3['jabatan'])) ? $peg3['jabatan'] : "");
    $sheet->setCellValue("F" . $i, (isset($peg3['tmt_jabatan'])) ? $peg3['tmt_jabatan'] : "");
    $sheet->setCellValue("G" . $i, ((isset($peg2['tingkat'])) ? $peg2['tingkat'] : "") . '/' . ((isset($peg2['jurusan'])) ? $peg2['jurusan'] : "") . '/' . ((isset($peg2['tgl_ijazah'])) ? $peg2['tgl_ijazah'] : ""));
    $sheet->setCellValue("H" . $i, $peg['alamat'] . '/' . $peg['pegawai_telp']);
    $sheet->setCellValue("I" . $i, $pgw);


    $no++;
    $i++;
}

$writer = new Xlsx($spreadsheet);
$file    = "../../assets/excel/$filename.xlsx";
$writer->save("$file");
