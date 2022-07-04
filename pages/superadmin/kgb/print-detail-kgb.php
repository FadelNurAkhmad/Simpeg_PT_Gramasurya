<?php
ob_start();
include '../../../assets/plugins/tcpdf/tcpdf.php';

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
$pdf->SetMargins(25, 10, 20);
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
$pdf->SetFont('helvetica', '', 8.7);

include "../../../config/koneksi.php";

if (isset($_GET['id_spkgb'])) {
	$id_spkgb = $_GET['id_spkgb'];
} else {
	die("Error. No ID Selected! ");
}

$query	= mysqli_query($koneksi, "SELECT * FROM tb_spkgb WHERE id_spkgb='$id_spkgb'");
$data	= mysqli_fetch_array($query);
list($y1, $m1, $d1)	= explode("-", $data['tgl']);
list($y2, $m2, $d2)	= explode("-", $data['tgl_lama']);
list($y3, $m3, $d3)	= explode("-", $data['tgl_berlaku_lama']);
list($y4, $m4, $d4)	= explode("-", $data['tgl_terhitung']);

//
if ($m1 == "01") {
	$m1	= "Januari";
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

//
if ($m2 == "01") {
	$m2	= "Januari";
} else if ($m2 == "02") {
	$m2 = "Februari";
} else if ($m2 == "03") {
	$m2 = "Maret";
} else if ($m2 == "04") {
	$m2 = "April";
} else if ($m2 == "05") {
	$m2 = "Mei";
} else if ($m2 == "06") {
	$m2 = "Juni";
} else if ($m2 == "07") {
	$m2 = "Juli";
} else if ($m2 == "08") {
	$m2 = "Agustus";
} else if ($m2 == "09") {
	$m2 = "September";
} else if ($m2 == "10") {
	$m2 = "Oktober";
} else if ($m2 == "11") {
	$m2 = "November";
} else if ($m2 == "12") {
	$m2 = "Desember";
}

//
if ($m3 == "01") {
	$m3	= "Januari";
} else if ($m3 == "02") {
	$m3 = "Februari";
} else if ($m3 == "03") {
	$m3 = "Maret";
} else if ($m3 == "04") {
	$m3 = "April";
} else if ($m3 == "05") {
	$m3 = "Mei";
} else if ($m3 == "06") {
	$m3 = "Juni";
} else if ($m3 == "07") {
	$m3 = "Juli";
} else if ($m3 == "08") {
	$m3 = "Agustus";
} else if ($m3 == "09") {
	$m3 = "September";
} else if ($m3 == "10") {
	$m3 = "Oktober";
} else if ($m3 == "11") {
	$m3 = "November";
} else if ($m3 == "12") {
	$m3 = "Desember";
}

//
if ($m4 == "01") {
	$m4	= "Januari";
} else if ($m4 == "02") {
	$m4 = "Februari";
} else if ($m4 == "03") {
	$m4 = "Maret";
} else if ($m4 == "04") {
	$m4 = "April";
} else if ($m4 == "05") {
	$m4 = "Mei";
} else if ($m4 == "06") {
	$m4 = "Juni";
} else if ($m4 == "07") {
	$m4 = "Juli";
} else if ($m4 == "08") {
	$m4 = "Agustus";
} else if ($m4 == "09") {
	$m4 = "September";
} else if ($m4 == "10") {
	$m4 = "Oktober";
} else if ($m4 == "11") {
	$m4 = "November";
} else if ($m4 == "12") {
	$m4 = "Desember";
}

$tampilPeg   = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$data[id_peg]'");
$peg    = mysqli_fetch_array($tampilPeg);

$tampilUni   = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
$uni    = mysqli_fetch_array($tampilUni);

$tampilSet	= mysqli_query($koneksi, "SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='1'");
$set	= mysqli_fetch_array($tampilSet);

$kepala	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$set[kepala]'");
$kep	= mysqli_fetch_array($kepala);

$head = '<table border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td width="100" rowspan="3"><img src="../../../assets/img/logo-grama.png" width="70" height="70"/></td>
				<td width="385" align="center"><font size="10" style="text-transform:uppercase;">PEMERINTAH KABUPATEN ' . $set['kab'] . '</font></td>	
				<td width="100" rowspan="3"></td>
			</tr>
			<tr>
				<td align="center"><font size="12" style="text-transform:uppercase;font-weight:bold;">BADAN KEPEGAWAIAN DAERAH</font></td>	
			</tr>
			<tr>
				<td align="center"><font size="9">' . $set['alamat'] . '</font></td>	
			</tr>
		</table>
		<table border="2" cellspacing="0" cellpadding="2">
		</table>';
$pdf->writeHTML($head, true, false, false, false, '');

$subhead = '<table cellpadding="1" border="0">
			<tr>
				<td width="65%" colspan="3">&nbsp;</td>
				<td width="5%"></td>
				<td width="30%">' . $set['kab'] . ', ' . $d1 . ' ' . $m1 . ' ' . $y1 . '</td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td></td>
				<td>Kepada</td>
			</tr>
			<tr>
				<td width="15%">Nomor</td>
				<td width="2%">:</td>
				<td width="48%">' . $data['no_kgb'] . '</td>
				<td width="5%">Yth.</td>
				<td width="30%">Kepala Badan Pendapatan,</td>
			</tr>
			<tr>
				<td>Lampiran</td>
				<td>:</td>
				<td>-----</td>
				<td></td>
				<td>Pengelolaan Keuangan dan Aset</td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td>:</td>
				<td>Kenaikan Gaji Berkala</td>
				<td></td>
				<td>Daerah Kabupaten ' . $set['kab'] . '</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><b><u>An. ' . $peg['nama'] . '</u></b></td>
				<td></td>
				<td>di -</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td align="center"><font style="text-transform:uppercase;"><b><u>' . $set['kab'] . '</u></b></font></td>
			</tr>
		</table>';
$pdf->writeHTML($subhead, true, false, false, false, '');

$html = '<table border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td width="15%">&nbsp;</td>
				<td width="85%" colspan="5">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Dengan ini diberitahukan bahwa dengan telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada :</td>	
			</tr>
			<tr>
				<td width="15%">&nbsp;</td>
				<td width="5%">1.</td>
				<td width="28%" colspan="2">Nama</td>
				<td width="2%">:</td>
				<td width="50%">' . $peg['nama'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>2.</td>
				<td colspan="2">NIP</td>
				<td>:</td>
				<td>' . $peg['nip'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>3.</td>
				<td colspan="2">Pangkat / Golongan Ruang</td>
				<td>:</td>
				<td>' . $peg['pangkat'] . ' ( ' . $peg['urut_pangkat'] . ' )</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>4.</td>
				<td colspan="2">Kantor / Tempat Bekerja</td>
				<td>:</td>
				<td>' . $uni['nama'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>5.</td>
				<td colspan="4">Gaji Pokok Lama ( Atas Dasar Surat Keputusan Terakhir Tentang Gaji / Pangkat ) yang ditetapkan Oleh :</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td width="3%">a.</td>
				<td width="25%">Pejabat</td>
				<td>:</td>
				<td>' . $data['pejabat_lama'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>b.</td>
				<td>Nomor dan Tanggal</td>
				<td>:</td>
				<td>' . $data['no_lama'] . ' Tgl ' . $d2 . ' ' . $m2 . ' ' . $y2 . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>c.</td>
				<td>Tanggal berlakunya Gaji</td>
				<td>:</td>
				<td>' . $d3 . ' ' . $m3 . ' ' . $y3 . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>d.</td>
				<td>Masa kerja golongan Gaji pada tanggal tersebut</td>
				<td>:</td>
				<td>' . $data['mk_lama'] . ' Rp ' . number_format($data['gaji_lama'], 0, ",", ".") . ',-</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="5">Diberikan Kenaikan Gaji Berkala Hingga Memperoleh  :</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>6.</td>
				<td colspan="2">Gaji Pokok Baru</td>
				<td>:</td>
				<td>Rp ' . number_format($data['gaji_baru'], 0, ",", ".") . ',- ( ' . $data['terbilang_gajibaru'] . ' )</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>7.</td>
				<td colspan="2">Berdasarkan Masa Kerja</td>
				<td>:</td>
				<td>' . $data['mk_baru'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>8.</td>
				<td colspan="2">Dalam Golongan Ruang</td>
				<td>:</td>
				<td>' . $data['gol_baru'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>9.</td>
				<td colspan="2">Terhitung Mulai Tanggal</td>
				<td>:</td>
				<td>' . $d4 . ' ' . $m4 . ' ' . $y4 . '</td>
			</tr>
		</table><br />
		<table border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td>Diharapkan agar sesuai dengan Peraturan Pemerintah Nomor : 30 Tahun 2015, maka kepada Pegawai Negeri Sipil tersebut dapat dibayarkan penghasilannya berdasarkan Gaji Pokok Baru.</td>
			</tr>
		</table><br />';
$pdf->writeHTML($html, true, false, false, false, '');

$sign = '<table cellpadding="1" border="0" align="center">
			<tr>
				<td width="25%"></td>
				<td width="25%"></td>
				<td width="50%"><font style="text-transform:uppercase;font-weight:bold;">KEPALA BADAN KEPEGAWAIAN DAERAH</font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><font style="text-transform:uppercase;font-weight:bold;">KABUPATEN ' . $set['kab'] . '</font></td>
			</tr>
			<tr>
				<td height="45"></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><b>' . $kep['nama'] . '</b></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><b>NIP. ' . $kep['nip'] . '</b></td>
			</tr>
		</table>';
$pdf->writeHTML($sign, true, false, false, false, '');

$cc = '<table border="0" cellspacing="0" cellpadding="1">
			<tr>
				<td colspan="2"><u>Tembusan disampaikan Kepada Yth. :</u></td>
			</tr>
			<tr>
				<td width="5%">1.</td>
				<td width="95%">' . $data['tembusan1'] . '</td>
			</tr>
			<tr>
				<td>2.</td>
				<td>' . $data['tembusan2'] . '</td>
			</tr>
			<tr>
				<td>3.</td>
				<td>' . $data['tembusan3'] . '</td>
			</tr>
			<tr>
				<td>4.</td>
				<td>' . $data['tembusan4'] . '</td>
			</tr>
			<tr>
				<td>5.</td>
				<td>' . $data['tembusan5'] . '</td>
			</tr>
			<tr>
				<td>6.</td>
				<td>' . $data['tembusan6'] . '</td>
			</tr>
			<tr>
				<td>7.</td>
				<td>' . $data['tembusan7'] . '</td>
			</tr>
			<tr>
				<td>8.</td>
				<td>' . $data['tembusan8'] . '</td>
			</tr>
			<tr>
				<td>9.</td>
				<td>' . $data['tembusan9'] . '</td>
			</tr>
			<tr>
				<td>10.</td>
				<td>' . $data['tembusan10'] . '</td>
			</tr>
			<tr>
				<td>11.</td>
				<td>' . $data['tembusan11'] . '</td>
			</tr>
			<tr>
				<td>12.</td>
				<td>' . $data['tembusan12'] . '</td>
			</tr>
		</table>';
$pdf->writeHTML($cc, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('KGB_' . $data['no_kgb'] . '.pdf', 'I');
