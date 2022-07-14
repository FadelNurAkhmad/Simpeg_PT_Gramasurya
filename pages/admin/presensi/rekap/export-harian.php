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

$filename    = "Rekap Presensi harian";

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Rekap Presensi');
$sheet->setCellValue("A1", "REKAP PRESENSI");
$sheet->setCellValue("A3", "Tanggal");
$sheet->setCellValue("B3", "Jadwal Kerja");
$sheet->setCellValue("C3", "Shift");
$sheet->setCellValue("D3", "PIN");
$sheet->setCellValue("E3", "NIP");
$sheet->setCellValue("F3", "Nama");
$sheet->setCellValue("G3", "Jabatan");
$sheet->setCellValue("H3", "Jam Masuk");
$sheet->setCellValue("I3", "Scan Masuk");
$sheet->setCellValue("J3", "Terlambat");
$sheet->setCellValue("K3", "Scan Istirahat1");
$sheet->setCellValue("L3", "Scan Istirahat2");
$sheet->setCellValue("M3", "Jam Pulang");
$sheet->setCellValue("N3", "Scan Pulang");

$i = 4;

// mengambil data pegawai untuk rekapharian
$tampilPeg2    = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id ASC LIMIT 100");


if (!empty($periode_awal) && !empty($periode_akhir)) {
    while ($peg    = mysqli_fetch_array($tampilPeg2, MYSQLI_ASSOC)) {
        $tampilCari = mysqli_query($koneksi, "SELECT * FROM shift_result WHERE tgl_shift >= '$periode_awal' AND tgl_shift <= '$periode_akhir' AND pegawai_id = '$peg[pegawai_id]'");
        while ($cari = mysqli_fetch_array($tampilCari, MYSQLI_ASSOC)) {

            $jdwM    = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id='$cari[jdw_kerja_m_id]'");
            $jdw    = mysqli_fetch_array($jdwM, MYSQLI_ASSOC);

            $tampilJk    = mysqli_query($koneksi, "SELECT * FROM jam_kerja WHERE jk_id='$cari[jk_id]'");
            $jk    = mysqli_fetch_array($tampilJk, MYSQLI_ASSOC);

            $tampilJabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
            $jab    = mysqli_fetch_array($tampilJabatan, MYSQLI_ASSOC);

            $tgls           = isset($cari['tgl_shift']) ? $cari['tgl_shift'] : '';
            $jadwalKerja    = isset($jdw) ? $jdw['jdw_kerja_m_name'] : "";
            $shift          = isset($jk) ? $jk['jk_name'] : "Libur";
            $jabatan        = isset($jab) ? $jab['pembagian1_nama'] : '';
            $jamMasuk       = isset($jk) ? $jk['jk_bcin'] : "00:00:00";
            $jamKeluar      = isset($jk) ? $jk['jk_ecout'] : "00:00:00";

            $scanIn     = timescan($cari['scan_in']);
            $breakin    = timescan($cari['break_in']);
            $breakout   = timescan($cari['break_out']);
            $scanOut    = timescan($cari['scan_out']);

            $terlambat = $cari['late_minute'];

            $sheet->setCellValue("A" . $i, $tgls);
            $sheet->setCellValue("B" . $i, $jadwalKerja);
            $sheet->setCellValue("C" . $i, $shift);
            $sheet->setCellValue("D" . $i, $peg['pegawai_pin']);
            $sheet->setCellValue("E" . $i, $peg['pegawai_nip']);
            $sheet->setCellValue("F" . $i, $peg['pegawai_nama']);
            $sheet->setCellValue("G" . $i, $jabatan);
            $sheet->setCellValue("H" . $i, $jamMasuk);
            $sheet->setCellValue("I" . $i, $scanIn);
            $sheet->setCellValue("J" . $i, $terlambat);
            $sheet->setCellValue("K" . $i, $breakin);
            $sheet->setCellValue("L" . $i, $breakout);
            $sheet->setCellValue("M" . $i, $jamKeluar);
            $sheet->setCellValue("N" . $i, $scanOut);
            $i++;
        }
    }
}


if (empty($periode_awal) && empty($periode_akhir)) {
    while ($peg    = mysqli_fetch_array($tampilPeg2, MYSQLI_ASSOC)) {
        $tampilPres2 = mysqli_query($koneksi, "SELECT * FROM shift_result WHERE pegawai_id = '$peg[pegawai_id]' ORDER BY tgl_shift DESC LIMIT 100");
        while ($pres2 = mysqli_fetch_array($tampilPres2, MYSQLI_ASSOC)) {

            $jdwM       = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id='$pres2[jdw_kerja_m_id]'");
            $jdw    = mysqli_fetch_array($jdwM, MYSQLI_ASSOC);

            $tampilJk    = mysqli_query($koneksi, "SELECT * FROM jam_kerja WHERE jk_id='$pres2[jk_id]'");
            $jk    = mysqli_fetch_array($tampilJk, MYSQLI_ASSOC);

            $tampilJabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
            $jab    = mysqli_fetch_array($tampilJabatan, MYSQLI_ASSOC);

            $tgls           = isset($pres2['tgl_shift']) ? $pres2['tgl_shift'] : '';
            $jadwalKerja    = isset($jdw) ? $jdw['jdw_kerja_m_name'] : "";
            $shift          = isset($jk) ? $jk['jk_name'] : "Libur";
            $jabatan        = isset($jab) ? $jab['pembagian1_nama'] : '';
            $jamMasuk       = isset($jk) ? $jk['jk_bcin'] : "00:00:00";
            $jamKeluar      = isset($jk) ? $jk['jk_ecout'] : "00:00:00";

            $scanIn     = timescan($pres2['scan_in']);
            $breakin    = timescan($pres2['break_in']);
            $breakout   = timescan($pres2['break_out']);
            $scanOut    = timescan($pres2['scan_out']);

            $terlambat = $pres2['late_minute'];

            $sheet->setCellValue("A" . $i, $tgls);
            $sheet->setCellValue("B" . $i, $jadwalKerja);
            $sheet->setCellValue("C" . $i, $shift);
            $sheet->setCellValue("D" . $i, $peg['pegawai_pin']);
            $sheet->setCellValue("E" . $i, $peg['pegawai_nip']);
            $sheet->setCellValue("F" . $i, $peg['pegawai_nama']);
            $sheet->setCellValue("G" . $i, $jabatan);
            $sheet->setCellValue("H" . $i, $jamMasuk);
            $sheet->setCellValue("I" . $i, $scanIn);
            $sheet->setCellValue("J" . $i, $terlambat);
            $sheet->setCellValue("K" . $i, $breakin);
            $sheet->setCellValue("L" . $i, $breakout);
            $sheet->setCellValue("M" . $i, $jamKeluar);
            $sheet->setCellValue("N" . $i, $scanOut);
            $i++;
        }
    }
}

$writer = new Xlsx($spreadsheet);
$file    = "../../assets/excel/$filename.xlsx";
$writer->save("$file");

header("location:$file");
