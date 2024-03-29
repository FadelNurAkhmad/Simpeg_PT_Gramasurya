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

$pdf = new MYPDF('L', 'mm', 'Legal', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ActionTeamSPI');
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
$kep	= mysqli_fetch_array($kepala, MYSQLI_ASSOC);

$namakepala	= mysqli_query($koneksi, "SELECT * FROM pegawai  WHERE pegawai_id='$kep[pimpinan]'");
$nama		= mysqli_fetch_array($namakepala, MYSQLI_ASSOC);

$header = '<p align="center"><font size="12"><b>DAFTAR NOMINATIF PEGAWAI NEGERI SIPIL</b></font><br />
			<font size="10" style="text-transform:uppercase">PER ' . date("j F Y") . '<font></p>';
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
$subhead = '<table cellpadding="1" border="0">
			<tr>
				<td><font size="8" style="text-transform:uppercase"> ' . $kep['nama_peru'] . '</font></td>
			</tr>
		</table>';
$pdf->writeHTML($subhead, true, false, false, false, '');
$html = '<table border="1" cellspacing="0" cellpadding="3">
			<tr align="center">
				<th rowspan="2" width="40" height="50">NO</th>
				<th colspan="2" width="240" height="30">NAMA, TTL</th>
				<th rowspan="2" width="100">JENIS KELAMIN</th>
				<th colspan="2" width="200">JABATAN</th>
				<th rowspan="2" width="170">PEND, JURUSAN, T.LULUS</th>
				<th rowspan="2" width="170">ALAMAT & NO. TELP</th>
				<th rowspan="2" width="50">KET</th>
			</tr>
			<tr align="center">
				<th colspan="2" width="240">NIP, AGAMA</th>	
				<th width="100">NAMA</th>
				<th width="100">TMT</th>
			</tr>
			<tr align="center" >
				<th height="20">1</th>
				<th colspan="2">2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>6</th>
				<th>7</th>
				<th>8</th>
			</tr>';
$no = 1;
$idPeg = mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id= tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id");

while ($peg = mysqli_fetch_array($idPeg, MYSQLI_ASSOC)) {
	if ($peg['agama'] == '1') {
		$agama = 'Islam';
	}

	if ($peg['gender'] == '1') {
		$gender = 'Laki-laki';
	}
	if ($peg['pegawai_status'] == '1') {
		$status = 'Aktif';
	}

	$html .= '<tr>	
					<td align="center">' . $no++ . '</td>
					<td colspan="2">' . $peg['pegawai_nama'] . '<br />' . $peg['tempat_lahir'] . ', ' . $peg['tgl_lahir'] . '<br />' . $peg['pegawai_nip'] . '<br />' . $agama . '</td>
					<td>' . $gender . '</td>';

<<<<<<< HEAD


=======
>>>>>>> 93d9e2167c871615cf7ef01909c5dd412191636f
	$idJab = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
	$hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
	$jb = isset($hjab['jabatan']) ? $hjab['jabatan'] : '';
	$jbt = isset($hjab['tmt_jabatan']) ? $hjab['tmt_jabatan'] : '';
	$html .= '<td>' . $jb . '</td>
					<td>' . $jbt . '</td>';

<<<<<<< HEAD

=======
>>>>>>> 93d9e2167c871615cf7ef01909c5dd412191636f

	$idSek = mysqli_query($koneksi, "SELECT * FROM  tb_sekolah  WHERE id_peg='$peg[pegawai_id]' AND status='Akhir' ");
	$hsek = mysqli_fetch_array($idSek, MYSQLI_ASSOC);
	$hsek1 = isset($hsek['tingkat']) ? $hsek['tingkat'] : '';
	$hsek2 = isset($hsek['nama_sekolah']) ? $hsek['nama_sekolah'] : '';
	$hsek3 = isset($hsek['jurusan']) ? $hsek['jurusan'] : '';
	$hsek4 = isset($hsek['tgl_ijazah']) ? $hsek['tgl_ijazah'] : '';
	$html .= '<td>' . $hsek1 . '<br />' . $hsek2 . '<br />' . $hsek3 . '<br />' . $hsek4 . '</td>
					<td>' . $peg['alamat'] . '<br /><br />' . $peg['pegawai_telp'] . '</td>
					<td align="center">'  . $status . '</td>
			 </tr>';
}
$html .= '</table><br /><br />';
$html .= '<table cellpadding="1" border="0" align="center">
			<tr>
				<td width="550"></td>
				<td width="40"></td>
				<td width="380">' . $kep['nama_peru'] . ', ' . date("j F Y") . '</td>
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
				<td align="center"><font size="9"></font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>NIP. ' . $nama['pegawai_nip'] . '</b></font></td>
			</tr>
		</table>';
$pdf->writeHTML($html, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('Daftar_Nominatif_' . date("dmY") . '.pdf', 'I');
