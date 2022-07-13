<?php
$filename    = "Daftar Pegawai";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Daftar Pegawai');
$sheet->setCellValue("A1", "DAFTAR PEGAWAI");
$sheet->setCellValue("A3", "No. Urut");
$sheet->setCellValue("B3", "ID");
$sheet->setCellValue("C3", "NIP");
$sheet->setCellValue("D3", "Nama");
$sheet->setCellValue("E3", "Tempat Lahir");
$sheet->setCellValue("F3", "Tgl. Lahir");
$sheet->setCellValue("G3", "Agama");
$sheet->setCellValue("H3", "Jenis Kelamin");
$sheet->setCellValue("I3", "Gol Darah");
$sheet->setCellValue("J3", "Status Nikah");
$sheet->setCellValue("K3", "Status");
$sheet->setCellValue("L3", "Alamat");
$sheet->setCellValue("M3", "Telp");
$sheet->setCellValue("N3", "Email");
// $sheet->setCellValue("O3", "Gol/Ruang");
// $sheet->setCellValue("P3", "Pangkat");
$sheet->setCellValue("O3", "Jabatan");
$sheet->setCellValue("P3", "Pendidikan");
$sheet->setCellValue("Q3", "Unit Kerja");
$sheet->setCellValue("R3", "Tgl. Pensiun");

$expPeg    = mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id= tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id ");
$i    = 4; //Dimulai dengan baris ke dua
$no    = 1;
while ($peg    = mysqli_fetch_array($expPeg)) {
    if ($peg['agama'] == '1') {
        $agama = 'Islam';
    } else if ($peg['agama'] == '2') {
        $agama = 'Katolik';
    } else if ($peg['agama'] == '3') {
        $agama = 'Protestan';
    } else if ($peg['agama'] == '4') {
        $agama = 'Hindu';
    }

    if ($peg['gender'] == '1') {
        $gender = 'Laki-laki';
    } else {
        $gender = 'Perempuan';
    }

    if ($peg['gol_darah'] == '1') {
        $goldar = 'A+';
    } else if ($peg['gol_darah'] == '2') {
        $goldar = 'B+';
    } else if ($peg['gol_darah'] == '3') {
        $goldar = 'O+';
    } else if ($peg['gol_darah'] == '4') {
        $goldar = 'A-';
    } else if ($peg['gol_darah'] == '5') {
        $goldar = 'AB+';
    } else if ($peg['gol_darah'] == '6') {
        $goldar = 'B-';
    } else if ($peg['gol_darah'] == '7') {
        $goldar = 'O-';
    } else if ($peg['gol_darah'] == '8') {
        $goldar = 'AB-';
    }

    if ($peg['stat_nikah'] == '1') {
        $stat = 'Sudah Menikah';
    } else if ($peg['stat_nikah'] == '2') {
        $stat = 'Belum Menikah';
    } else if ($peg['stat_nikah'] == '3') {
        $stat = 'Janda / Duda';
    }

    if ($peg['pegawai_status'] == '1') {
        $pgw = 'Aktif';
    } else if ($peg['pegawai_status'] == '0') {
        $pgw = 'Non-Aktif';
    } else if ($peg['pegawai_status'] == '2') {
        $pgw = 'Berhenti';
    }

    $expUni    = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
    $uni    = mysqli_fetch_array($expUni);

    $se = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
    $see = isset($peg['jabatan']) ? $peg['jabatan'] : '';

    $uni1 = isset($uni1['nama']) ? $uni['nama'] : '';
    $peg1 = isset($peg['sekolah']) ? $peg['sekolah'] : '';

    $sheet->setCellValue("A" . $i, $no);
    $sheet->setCellValue("B" . $i, $peg['pegawai_id']);
    $sheet->setCellValue("C" . $i, $peg['pegawai_nip']);
    $sheet->setCellValue("D" . $i, $peg['pegawai_nama']);
    $sheet->setCellValue("E" . $i, $peg['tempat_lahir']);
    $sheet->setCellValue("F" . $i, $peg['tgl_lahir']);
    $sheet->setCellValue("G" . $i, $agama);
    $sheet->setCellValue("H" . $i, $gender);
    $sheet->setCellValue("I" . $i, $goldar);
    $sheet->setCellValue("J" . $i, $stat);
    $sheet->setCellValue("K" . $i, $pgw);
    $sheet->setCellValue("L" . $i, $peg['alamat']);
    $sheet->setCellValue("M" . $i, $peg['pegawai_telp']);
    $sheet->setCellValue("N" . $i, $peg['email']);
    // $sheet->setCellValue("O" . $i, $peg['urut_pangkat']);
    // $sheet->setCellValue("P" . $i, $peg['pangkat']);
    $sheet->setCellValue("O" . $i, $see);
    $sheet->setCellValue("P" . $i, $peg1);
    $sheet->setCellValue("Q" . $i, $uni1);
    $sheet->setCellValue("R" . $i, $peg['tgl_pensiun']);
    $no++;
    $i++;
}

$writer = new Xlsx($spreadsheet);
$file    = "../../assets/excel/$filename.xlsx";
$writer->save("$file");
