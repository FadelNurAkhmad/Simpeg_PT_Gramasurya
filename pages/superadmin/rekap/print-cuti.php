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

if (isset($_GET['id_cuti'])) {
    $id_cuti = $_GET['id_cuti'];
} else {
    die("Error. No ID Selected! ");
}

$query    = mysqli_query($koneksi, "SELECT * FROM tb_data_cuti WHERE id_cuti='$id_cuti'");
$data    = mysqli_fetch_array($query);
list($y1, $m1, $d1)    = explode("-", $data['tanggal_mulai']);
list($y2, $m2, $d2)    = explode("-", $data['tanggal_selesai']);
list($y3, $m3, $d3)    = explode("-", $data['tanggal_cuti']);

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

//
if ($m2 == "01") {
    $m2    = "Januari";
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
    $m3    = "Januari";
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

$tampilPeg   = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$data[id_peg]'");
$peg    = mysqli_fetch_array($tampilPeg);

$tampilUni   = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
$uni    = mysqli_fetch_array($tampilUni);

$tampilPeru    = mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
$setPeru    = mysqli_fetch_array($tampilPeru);

$pimpinan    = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$setPeru[pimpinan]'");
$pim    = mysqli_fetch_array($pimpinan);

$head = '<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td width="100" rowspan="3"><img src="../../../../assets/img/logo.png" width="78" height="78"/></td>
				<td width="385" align="center"><font size="10" style="text-transform:uppercase;">PEMERINTAH KABUPATEN ' . $setPeru['nama_peru'] . '</font></td>	
				<td width="100" rowspan="3"></td>
			</tr>
			<tr>
				<td align="center"><font size="12" style="text-transform:uppercase;font-weight:bold;">SEKRETARIAT DAERAH</font></td>	
			</tr>
			<tr>
				<td align="center"><font size="9">' . $setPeru['alamat'] . '</font></td>	
			</tr>
		</table>
		<table border="2" cellspacing="0" cellpadding="3">
		</table>';
$pdf->writeHTML($head, true, false, false, false, '');

$subhead = '<table border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td width="585" align="center"><font size="10" style="text-transform:uppercase;"><u><b>SURAT IZIN CUTI ' . $data['jns_cuti'] . '</b></u></font></td>	
			</tr>
			<tr>
				<td align="center"><font size="9"><b>NOMOR: ' . $data['no_suratcuti'] . '</b></font></td>	
			</tr>
		</table><br /><br />';
$pdf->writeHTML($subhead, true, false, false, false, '');

$html = '<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td colspan="4">Diberikan Cuti ' . $data['jns_cuti'] . ' kepada Pegawai Negeri Sipil :</td>	
			</tr>
			<tr>
				<td width="8%">&nbsp;</td>
				<td width="30%">Nama</td>
				<td width="2%">:</td>
				<td width="60%">' . $peg['nama'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>NIP</td>
				<td>:</td>
				<td>' . $peg['nip'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Pangkat / Golongan Ruang</td>
				<td>:</td>
				<td>' . $peg['pangkat'] . ' ( ' . $peg['urut_pangkat'] . ' )</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Jabatan</td>
				<td>:</td>
				<td>' . $peg['jabatan'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Satuan Organisasi</td>
				<td>:</td>
				<td>' . $uni['nama'] . '</td>
			</tr>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4">Selama ' . $data['lama'] . ' (' . $data['lama_terbilang'] . ') ' . $data['lama_satuan'] . ', Terhitung Mulai Tanggal ' . $d1 . ' ' . $m1 . ' ' . $y1 . ' sampai dengan tanggal ' . $d2 . ' ' . $m2 . ' ' . $y2 . ', dengan ketentuan sebagai berikut :</td>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td width="8%">&nbsp;</td>
				<td width="3%">' . $data['point1'] . '</td>
				<td width="89%">' . $data['ket1'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>' . $data['point2'] . '</td>
				<td>' . $data['ket2'] . '</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>' . $data['point3'] . '</td>
				<td>' . $data['ket3'] . '</td>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td>Demikian Surat Cuti ' . $data['jns_cuti'] . ' ini dibuat untuk dapat digunakan sebagaimana mestinya.</td>
			</tr>
		</table><br /><br /><br /><br />';
$pdf->writeHTML($html, true, false, false, false, '');

$sign = '<table cellpadding="1" border="0" align="center">
			<tr>
				<td width="200"></td>
				<td width="100"></td>
				<td width="285">' . $setPeru['nama_peru'] . ', ' . $d3 . ' ' . $m3 . ' ' . $y3 . '</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;">An. BUPATI ' . $setPeru['nama_peru'] . '</font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;">SEKRETARIS DAERAH</font></td>
			</tr>
			<tr>
				<td height="60"></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>' . $pim['nama'] . '</b></font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9">' . $pim['pangkat'] . '</font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>NIP. ' . $pim['nip'] . '</b></font></td>
			</tr>
		</table><br /><br /><br /><br /><br /><br />';
$pdf->writeHTML($sign, true, false, false, false, '');

$cc = '<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td colspan="2"><u>Tembusan disampaikan Kepada Yth. :</u></td>
			</tr>
			<tr>
				<td width="3%">1.</td>
				<td width="97%">' . $data['tembusan1'] . '</td>
			</tr>
			<tr>
				<td>2.</td>
				<td>' . $data['tembusan2'] . '</td>
			</tr>
		</table>';
$pdf->writeHTML($cc, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('CUTI_' . $data['no_suratcuti'] . '.pdf', 'I');
