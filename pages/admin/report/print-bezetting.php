<?php
ob_start();
include '../../../assets/plugins/tcpdf/tcpdf.php';

class MYPDF extends TCPDF
{
	public function Header()
	{
		// Logo
		//$image_file = K_PATH_IMAGES.'logo_example.jpg';
		//$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Header
		//$html = '<p align="center"></p>';
		//$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
	}
	public function Footer()
	{
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . '    ' . '*** ' . date("d-m-Y") . ' ***', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

$pdf = new MYPDF('P', 'mm', 'Legal', true, 'UTF-8', false);

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
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(12, 20, 12);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
$pdf->SetFont('helvetica', '', 8);

include "../../../config/koneksi.php";

$kepala	= mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
$kep	= mysqli_fetch_array($kepala);

$namakepala	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$kep[pimpinan]'");
$nama		= mysqli_fetch_array($namakepala);

$header = '<p align="center"><font size="12"><b>DAFTAR BEZETTING</b></font><br />
			<font size="9" style="text-transform:uppercase">' . $kep['nama_peru'] . ' PERIODE BULAN ' . date('m') . ' TAHUN ' . date('Y') . '<font></p>';
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
$html = '<table border="1" cellspacing="0" cellpadding="3">
			<tr align="center">
				<th width="30">No</th>
				<th width="200">NAMA<br />TEMPAT TANGGAL LAHIR</th>
				<th width="130">NIP</th>
				
				<th width="100">JABATAN</th>
				<th width="100">PEND<br />TERAKHIR</th>
				<th width="70">UMUR (THN)</th>
				<th width="40">KET</th>
			</tr>
			<tr align="center">
				<th width="30">1</th>
				<th width="200">2</th>
				<th width="130">3</th>
				<th width="100">4</th>
				<th width="100">5</th>
				<th width="70">6</th>
				<th width="40">7</th>
				
			</tr>';
$no = 1;
$idPeg = mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id= tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id");
while ($peg = mysqli_fetch_array($idPeg, MYSQLI_ASSOC)) {
	if ($peg['pegawai_status'] == '1') {
		$status = 'Aktif';
	}
	$html .= '<tr>
					<td align="center" width="30">' . $no++ . '</td>
					<td>' . $peg['pegawai_nama'] . '<br />' . $peg['tempat_lahir'] . ',' . $peg['tgl_lahir'] . '</td>
					<td>' . $peg['pegawai_nip'] . '</td>';

	$idJab = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg=$peg[pegawai_id] ");
	$hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
	$hjab1 = isset($hjab['jabatan']) ? $hjab['jabatan'] : '';
	$html .= '<td>' . $hjab1 . '</td>';

	$idSek = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]' AND status='Akhir' ");
	$hsek = mysqli_fetch_array($idSek, MYSQLI_ASSOC);
	$hsek1 = isset($hsek['tingkat']) ? $hsek['tingkat'] : '';
	$html .= '<td align="center">' . $hsek1 . '</td>';

	$lhr	= new DateTime($peg['tgl_lahir']);
	$today	= new DateTime();
	$selisih	= $today->diff($lhr);
	$html .= '<td align="center">' . $selisih->y . '</td>
					<td align="center">' . $status . '</td>
				</tr>';
}
$html .= '</table><br /><br />';
$html .= '<table cellpadding="1" border="0" align="center">
			<tr>
				<td width="250"></td>
				<td width="110"></td>
				<td width="300">' . $kep['nama_peru'] . ', ' . date("j F Y") . '</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;">A.N PERUSAHAAN</font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;"> ' . $kep['nama_peru'] . '</font></td>
			</tr>
			<tr>
				<td height="60"></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>' . $nama['pegawai_nama'] . '</b></font></td>
			</tr>
			
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>NIP. ' . $nama['pegawai_nip'] . '</b></font></td>
			</tr>
		</table>';
$pdf->writeHTML($html, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('Bezetting_' . date("dmY") . '.pdf', 'I');
