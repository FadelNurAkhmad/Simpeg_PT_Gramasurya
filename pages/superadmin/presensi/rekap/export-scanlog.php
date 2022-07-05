
<?php
$filename    = "Rekap Presensi scanlog";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Rekap Presensi');
$sheet->setCellValue("A1", "REKAP PRESENSI");
$sheet->setCellValue("A3", "No");
$sheet->setCellValue("B3", "Tanggal Scan");
$sheet->setCellValue("C3", "Tanggal");
$sheet->setCellValue("D3", "Jam");
$sheet->setCellValue("E3", "PIN");
$sheet->setCellValue("F3", "NIP");
$sheet->setCellValue("G3", "Nama");
$sheet->setCellValue("H3", "Jabatan");
$sheet->setCellValue("I3", "SN");

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


        $sheet->setCellValue("A" . $i, $cari['scan_date']);
        $sheet->setCellValue("B" . $i, $date);
        $sheet->setCellValue("C" . $i, $time);
        $sheet->setCellValue("D" . $i, $cari['pin']);
        $sheet->setCellValue("E" . $i, $peg['pegawai_nip']);
        $sheet->setCellValue("F" . $i, $peg['pegawai_nama']);
        $sheet->setCellValue("G" . $i, $jabb);
        $sheet->setCellValue("H" . $i, $cari['sn']);
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
?>

<?php
$filename    = "Rekap Presensi harian";

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
$tampilPres    = mysqli_query($koneksi, "SELECT * FROM att_log ORDER BY scan_date DESC LIMIT 100");

// mengambil data pegawai untuk rekapharian
$tampilPeg2    = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id ASC LIMIT 100");

// mengambil data pegawai untuk rekapperiode
$tampilPeg3    = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id ASC LIMIT 100");


if (!empty($_POST['periode_awal']) && !empty($_POST['periode_akhir'])) {
    while ($peg    = mysqli_fetch_array($tampilPeg2, MYSQLI_ASSOC)) {
        $tampilCari = mysqli_query($koneksi, "SELECT * FROM shift_result WHERE tgl_shift >= '$_POST[periode_awal]' AND tgl_shift <= '$_POST[periode_akhir]' AND pegawai_id = '$peg[pegawai_id]'");
        while ($cari = mysqli_fetch_array($tampilCari, MYSQLI_ASSOC)) {

            $scan = timescan($cari['scan_in']);
            $breakin = timescan($cari['break_in']);
            $breakout = timescan($cari['break_out']);
            $scnout = timescan($cari['scan_out']);


            $jdwM    = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id='$cari[jdw_kerja_m_id]'");
            $jdw    = mysqli_fetch_array($jdwM, MYSQLI_ASSOC);

            $tampilJk    = mysqli_query($koneksi, "SELECT * FROM jam_kerja WHERE jk_id='$cari[jk_id]'");
            $jk    = mysqli_fetch_array($tampilJk, MYSQLI_ASSOC);
            $jkk = isset($jk['jk_name']) ? $jk['jk_name'] : '';

            $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
            $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
            $jabb = isset($jab['pembagian1_nama']) ? $jab['pembagian1_nama'] : '';
        }
        $myvalue = $cari['scan_date'];
        $datetime = new DateTime($myvalue);

        $date = $datetime->format('Y-m-d');
        $time = $datetime->format('H:i:s');

        $tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$cari[pin]'");
        $peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);

        $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
        $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
        $jabb = isset($jab['pembagian1_nama']) ? $jab['pembagian1_nama'] : '';

        $sheet->setCellValue("A" . $i, $cari['tgl_shift']);
        $sheet->setCellValue("B" . $i, $jdw['jdw_kerja_m_name']);
        $sheet->setCellValue("C" . $i, $jkk);
        $sheet->setCellValue("D" . $i, $peg['pegawai_pin']);
        $sheet->setCellValue("E" . $i, $peg['pegawai_nip']);
        $sheet->setCellValue("F" . $i, $peg['pegawai_nama']);
        $sheet->setCellValue("G" . $i, $jabb);
        $sheet->setCellValue("H" . $i, $jk['jk_bcin']);
        $sheet->setCellValue("I" . $i, $scan);
        $sheet->setCellValue("J" . $i, $breakin);
        $sheet->setCellValue("K" . $i, $breakout);
        $sheet->setCellValue("L" . $i, $scnout);
        $i++;
    }
}


if (empty($_POST['periode_awal']) && empty($_POST['periode_akhir'])) {
    while ($peg    = mysqli_fetch_array($tampilPeg2, MYSQLI_ASSOC)) {
        $tampilPres2 = mysqli_query($koneksi, "SELECT * FROM shift_result WHERE pegawai_id = '$peg[pegawai_id]' ORDER BY tgl_shift DESC LIMIT 100");
        while ($pres2 = mysqli_fetch_array($tampilPres2, MYSQLI_ASSOC)) {


            $tgls = isset($pres2['tgl_shift']) ? $pres2['tgl_shift'] : '';

            $scan = timescan($pres2['scan_in']);
            $breakin = timescan($pres2['break_in']);
            $breakout = timescan($pres2['break_out']);
            $scnout = timescan($pres2['scan_out']);


            $jdwM    = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id='$pres2[jdw_kerja_m_id]'");
            $jdw    = mysqli_fetch_array($jdwM, MYSQLI_ASSOC);

            $tampilJk    = mysqli_query($koneksi, "SELECT * FROM jam_kerja WHERE jk_id='$pres2[jk_id]'");
            $jk    = mysqli_fetch_array($tampilJk, MYSQLI_ASSOC);
            $jkk = isset($jk['jk_name']) ? $jk['jk_name'] : '';
            $jjk = isset($jk['jk_bcin']) ? $jk['jk_bcin'] : '';


            $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
            $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
            $jabb = isset($jab['pembagian1_nama']) ? $jab['pembagian1_nama'] : '';
        }
        $myvalue = isset($pres2['scan_date']) ? $pres2['scan_date'] : '';
        $datetime = new DateTime($myvalue);

        $date = $datetime->format('Y-m-d');
        $time = $datetime->format('H:i:s');

        $tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$peg[pegawai_pin]'");
        $peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);

        $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
        $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
        $jabb = isset($jab['pembagian1_nama']) ? $jab['pembagian1_nama'] : '';

        $sheet->setCellValue("A" . $i, $tgls);
        $sheet->setCellValue("B" . $i, $jdw['jdw_kerja_m_name']);
        $sheet->setCellValue("C" . $i, $jkk);
        $sheet->setCellValue("D" . $i, $peg['pegawai_pin']);
        $sheet->setCellValue("E" . $i, $peg['pegawai_nip']);
        $sheet->setCellValue("F" . $i, $peg['pegawai_nama']);
        $sheet->setCellValue("G" . $i, $jabb);
        $sheet->setCellValue("H" . $i, $jjk);
        $sheet->setCellValue("I" . $i, $scan);
        $sheet->setCellValue("J" . $i, $breakin);
        $sheet->setCellValue("K" . $i, $breakout);
        $sheet->setCellValue("L" . $i, $scnout);
        $i++;
    }
}

$writer = new Xlsx($spreadsheet);
$file1    = "../../assets/excel/$filename.xlsx";
$writer->save("$file1");
?>

<?php
// $filename    = "Rekap Presensi Periode";
// $spreadsheet = new Spreadsheet();

// $sheet = $spreadsheet->getActiveSheet();
// $sheet->setTitle('Rekap Presensi Periode');
// $sheet->setCellValue("A1", "REKAP PRESENSI PERIODW");
// $sheet->setCellValue("A3", "PIN");
// $sheet->setCellValue("B3", "NIP");
// $sheet->setCellValue("C3", "NAMA");
// $sheet->setCellValue("D3", "Jabatan");
// $sheet->setCellValue("E3", "Periode");
// $sheet->setCellValue("F3", "Hadir");
// $sheet->setCellValue("G3", "Izin");
// $sheet->setCellValue("H3", "Terlambat");


// $i = 4;


// // mengambil data pegawai untuk rekapperiode
// $tampilPeg3    = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id ASC LIMIT 100");

// if (!empty($_POST['periode_awal']) && !empty($_POST['periode_akhir'])) {

//     $begin = new DateTime($_POST['periode_awal']);
//     $end = new DateTime($_POST['periode_akhir']);
//     $end->modify("+1 day");
//     $interval = $begin->diff($end);

//     $time = $interval -> format("F");
//     $timi = $interval -> format("Y");

//     if (($interval->m) > '0') {
//     while ($peg3    = mysqli_fetch_array($tampilPeg3, MYSQLI_ASSOC)) {
//     $tampilCari = mysqli_query($koneksi, "SELECT SUM(jk_count_as) AS hadir, SUM(late) AS terlambat FROM shift_result WHERE tgl_shift >= '$_POST[periode_awal]' AND tgl_shift <= '$_POST[periode_akhir]' AND pegawai_id = '$peg3[pegawai_id]'");
//     $cari = mysqli_fetch_array($tampilCari, MYSQLI_ASSOC);

//     $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg3[pembagian1_id]'");
//     $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
//     $jabb = isset($jab['pmebagian1_nama']) ? $jab['pembagian1_nama'] : '';

//         $sheet->setCellValue("A" . $i, $peg3['pegawai_pin']);
//         $sheet->setCellValue("B" . $i, $peg3['pegawai_nip']);
//         $sheet->setCellValue("C" . $i, $peg3['pegawai_nama']);
//         $sheet->setCellValue("D" . $i, $jabb);
//         $sheet->setCellValue("E" . $i, $time);
//         $sheet->setCellValue("F" . $i, $timi);
//         $sheet->setCellValue("G" . $i, $cari['hadir']);
//         $sheet->setCellValue("H" . $i, $cari['terlambat']);
//         $i++;
//     }
// }
// }

// $writer = new Xlsx($spreadsheet);
// $file    = "../../assets/excel/$filename.xlsx";
// $writer->save("$file2");
// ?>
