<?php
ob_start();
include '../../../../assets/plugins/tcpdf/tcpdf.php';

class MYPDF extends TCPDF
{
	public function Header()
	{
		// Logo
		//$image_file ='../../../assets/images/avatars/print.png';
		//$this->Image($image_file, 10, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Header
		//$html = '<p><b>REPORT STOCK</b></p>';
		//$this->writeHTMLCell($w = 0, $h = 0, $x = 40, $y = 10, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
	}
}

$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Andi Hatmoko');
$pdf->SetTitle('Report');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(25, 20, 20);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 20);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
	require_once(dirname(__FILE__) . '/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);

include "../../../../config/koneksi.php";

if (isset($_GET['id_gaji_konfig'])) {
	$id_gaji_konfig = $_GET['id_gaji_konfig'];
} else {
	die("Error. No ID Selected! ");
}

$query    = mysqli_query($koneksi, "SELECT * FROM tb_gaji_konfigurasi WHERE id_gaji_konfig='$id_gaji_konfig'");
$data    = mysqli_fetch_array($query);

$gaji_pokok		= $data['gaji_pokok'];
$tunjangan_tetap		= $data['tunjangan_tetap'];
$tunjangan_variabel		= $data['tunjangan_variabel'];
$jumlah_total	= $gaji_pokok + $tunjangan_tetap + $tunjangan_variabel;

list($y1, $m1, $d1)    = explode("-", $data['tanggal_gaji_konfig']);

//
if ($m1 == "01") {
	$m1    = "Januari";
} else if ($m1 == "02") {
	$m1 = "Februari";
} else if ($m1 == "03") {
	$m1 = "Maret";
} else if ($m1 == "04") {
	$m1 = "April";
} else if ($m1 == "05") {
	$m1 = "Mei";
} else if ($m1 == "06") {
	$m1 = "Juni";
} else if ($m1 == "07") {
	$m1 = "Juli";
} else if ($m1 == "08") {
	$m1 = "Agustus";
} else if ($m1 == "09") {
	$m1 = "September";
} else if ($m1 == "10") {
	$m1 = "Oktober";
} else if ($m1 == "11") {
	$m1 = "November";
} else if ($m1 == "12") {
	$m1 = "Desember";
}

$tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$data[id_peg]'");
$peg    = mysqli_fetch_array($tampilPeg);

// $tampilUni   = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
// $uni    = mysqli_fetch_array($tampilUni);

$tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$data[id_peg]'");
$jab    = mysqli_fetch_array($tampilJab);

$tampilPeru    = mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
$setPeru    = mysqli_fetch_array($tampilPeru);

$pimpinan    = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$setPeru[pimpinan]'");
$pim    = mysqli_fetch_array($pimpinan);

$tampilJab2   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$setPeru[pimpinan]'");
$jab2    = mysqli_fetch_array($tampilJab2);

// $head = '<table border="0" cellspacing="0" cellpadding="3">
// 			<tr>
// 				<td width="100" rowspan="3"><img src="../../../../assets/img/logo.png" width="78" height="78"/></td>
// 				<td width="385" align="center"><font size="12" style="text-transform:uppercase;font-weight:bold;">' . $setPeru['nama_peru'] . '</font></td>	
// 				<td width="100" rowspan="3"></td>
// 			</tr>
// 			<tr>
// 				<td align="center"><font size="9">' . $setPeru['alamat'] . '</font></td>	
// 			</tr>
// 		</table>
// 		<table border="2" cellspacing="0" cellpadding="3">
// 		</table>';
// $pdf->writeHTML($head, true, false, false, false, '');

$subhead = '<table border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td width="585" align="center"><font size="14" style="text-transform:uppercase;"><u><b>LAPORAN SLIP GAJI PEGAWAI</b></u></font></td>	
			</tr>
		</table><br /><br />';
$pdf->writeHTML($subhead, true, false, false, false, '');

$html = '<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td width="3%">&nbsp;</td>
				<td width="10%">Nama</td>
				<td width="2%">:</td>
				<td width="40%">' . $peg['pegawai_nama'] . '</td>
				<td width="3%">&nbsp;</td>
				<td width="10%">NIP</td>
				<td width="2%">:</td>
				<td width="30%">' . (isset($peg['pegawai_nip']) ? $peg['pegawai_nip'] : "-") . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Jabatan</td>
				<td>:</td>
				<td>' .  (isset($jab['jabatan']) ? $jab['jabatan'] : "-") . '</td>
				<td>&nbsp;</td>
				<td>Periode</td>
				<td>:</td>
				<td>' . $data['bulan'] . ' - ' . $data['tahun'] . '</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<table border="1" cellspacing="0" cellpadding="3">
			</table>
			<tr>
				<td width="3%">&nbsp;</td>
				<td width="53%"><b>Gaji Pokok</b></td>
				<td width="5%"><b>:</b></td>
				<td width="5%"><b>Rp.</b></td>
				<td align="right" width="20%"><b> ' . number_format($data['gaji_pokok']) . '</b></td>
			</tr>
			<tr>
				<td width="3%">&nbsp;</td>
				<td width="53%"><b>Tunjangan Tetap</b></td>
				<td width="5%"><b>:</b></td>
				<td width="5%"><b>Rp.</b></td>
				<td align="right" width="20%"><b> ' . number_format($data['tunjangan_tetap']) . '</b></td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Struktural</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['struktural']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Pendidikan</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['pendidikan']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Keahlian</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['keahlian']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Penyesuaian</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['penyesuaian']) . '</td>
			</tr>
			<tr>
				<td width="3%">&nbsp;</td>
				<td width="53%"><b>Tunjangan Variabel</b></td>
				<td width="5%"><b>:</b></td>
				<td width="5%"><b>Rp.</b></td>
				<td align="right" width="20%"><b> ' . number_format($data['tunjangan_variabel']) . '</b></td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Presensi</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['presensi']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Uang Makan</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['uang_makan']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Kehadiran</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['kehadiran']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Kedisiplinan</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['kedisiplinan']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Keluarga Istri/Suami</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['istri_suami']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="23%">Anak</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['anak']) . '</td>
			</tr>
			<tr>
				<td width="45%">&nbsp;</td>
				<td width="25%"><b>Jumlah</b></td>
				<td width="5%"><b>:</b></td>
				<td width="5%"><b>Rp.</b></td>
				<td align="right" width="20%"><b> ' . number_format($jumlah_total) . '</b></td>
			</tr>
			<table border="1" cellspacing="0" cellpadding="3">
			</table>
			<tr>
				<td width="3%">&nbsp;</td>
				<td width="53%"><u><b>Potongan Variabel</b></u></td>
				<td width="5%"></td>
				<td width="25%"></td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="44%">Presensi</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['presensi_pot']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="44%">Uang Makan</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['uang_makan_pot']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="44%">Kehadiran</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20\0%"> ' . number_format($data['kehadiran_pot']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="44%">Kedisiplinan</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['kedisiplinan_pot']) . '</td>
			</tr>
			<tr>
				<td width="27%">&nbsp;</td>
				<td width="43%"><b>Jumlah Potongan Variabel</b></td>
				<td width="5%"><b>:</b></td>
				<td width="5%"><b>Rp.</b></td>
				<td align="right" width="20%"><b> ' . number_format($data['jumlah_pot_var']) . '</b></td>
			</tr>
			<tr>
				<td width="3%">&nbsp;</td>
				<td width="53%"><u><b>Potongan Wajib</b></u></td>
				<td width="5%"></td>
				<td width="25%"></td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="44%">BPJS</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['bpjs']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="44%">Koperasi</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['koperasi']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="44%">Dapen Muh</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['dapen_muh']) . '</td>
			</tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="44%">Lainya</td>
				<td width="5%">:</td>
				<td width="5%">Rp.</td>
				<td align="right" width="20%"> ' . number_format($data['lainya']) . '</td>
			</tr>
			<tr>
				<td width="27%">&nbsp;</td>
				<td width="43%"><b>Jumlah Potongan Wajib</b></td>
				<td width="5%"><b>:</b></td>
				<td width="5%"><b>Rp.</b></td>
				<td align="right" width="20%"><b> ' . number_format($data['jumlah_pot_wajib']) . '</b></td>
			</tr>
			<table border="1" cellspacing="0" cellpadding="3">
			</table>
			<tr>
				<td width="45%">&nbsp;</td>
				<td width="25%"><b>Jumlah Gaji Diterima</b></td>
				<td width="5%"><b>:</b></td>
				<td width="5%"><b>Rp.</b></td>
				<td align="right" width="20%"><b> ' . number_format($data['gaji_diterima']) . '</b></td>
			</tr>
			<table border="1" cellspacing="0" cellpadding="3">
			</table>
		</table>
		<table border="0" cellspacing="0" cellpadding="3">
		</table><br /><br /><br />';
$pdf->writeHTML($html, true, false, false, false, '');

$sign = '<table cellpadding="1" border="0" align="center">
			<tr>
				<td width="200"></td>
				<td width="100"></td>
				<td width="285">Yogyakarta, ' . $d1 . ' ' . $m1 . ' ' . $y1 . '</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;">An. PIMPINAN PERUSAHAAN</font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;">PT GRAMASURYA</font></td>
			</tr>
			<tr>
				<td height="60"></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>' . $pim['pegawai_nama'] . '</b></font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9">' . (isset($jab2['jabatan']) ? $jab2['jabatan'] : "-") . '</font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>NIP. ' . (isset($pim['pegawai_nip']) ? $pim['pegawai_nip'] : "-") . '</b></font></td>
			</tr>
		</table><br /><br /><br /><br /><br /><br />';
$pdf->writeHTML($sign, true, false, false, false, '');


//Close and output PDF document
$pdf->Output('GAJI_' . $peg['pegawai_nama'] . '.pdf', 'I');
