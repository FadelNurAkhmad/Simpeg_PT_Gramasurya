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

$kepala	= mysqli_query($koneksi, "SELECT * FROM tb_setup_bkd WHERE id_setup_peru='1'");
$kep	= mysqli_fetch_array($kepala, MYSQLI_ASSOC);

$namakepala	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$kep[kepala]'");
$nama		= mysqli_fetch_array($namakepala, MYSQLI_ASSOC);

$pangkat = mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$kep[kepala]' AND status_pan='Aktif'");
$pan	= mysqli_fetch_array($pangkat, MYSQLI_ASSOC);
$pan1 = isset($pan['pangkat']) ? $pan['pangkat'] : '';

$header = '<p align="center"><font size="12"><b>DAFTAR URUT KEPANGKATAN PEGAWAI NEGERI SIPIL</b></font><br />
			<font size="9" style="text-transform:uppercase"> ' . $kep['nama_peru'] . ' TAHUN ' . date('Y') . '<font></p>';
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
$html = '<table border="1" cellspacing="0" cellpadding="3">
			<tr align="center">
				<th rowspan="2" width="30">NO</th>
				<th colspan="2" width="120">NAMA</th>
				<th rowspan="2" width="120">NIP</th>
				<th colspan="2" width="120">PKT TERAKHIR</th>
				<th colspan="2" width="120">JABATAN</th>
				<th rowspan="2" width="40">ESL</th>
				<th colspan="2" width="80">MK GOL</th>
				<th colspan="3" width="140">LATIHAN JABATAN</th>
				<th colspan="3" width="160">PEND AKHIR</th>
				<th rowspan="2" width="40">KET</th>
			</tr>
			<tr align="center">
				<th colspan="2" width="120">TTL</th>
				<th width="60">GOL/RUANG</th>
				<th width="60">TMT</th>
				<th width="60">NAMA</th>
				<th width="60">TMT</th>
				<th width="40">THN</th>
				<th width="40">BLN</th>
				<th width="60">NAMA</th>
				<th width="40">THN</th>
				<th width="40">JML JAM</th>
				<th width="60">ASAL</th>
				<th width="60">T.LLS</th>
				<th width="40">TK.IJAZAH</th>
			</tr>
			<tr align="center">
				<th width="30">1</th>
				<th colspan="2" width="120">2</th>
				<th width="120">3</th>
				<th width="60">4</th>
				<th width="60">5</th>
				<th width="60">6</th>
				<th width="60">7</th>
				<th width="40">8</th>
				<th width="40">9</th>
				<th width="40">10</th>
				<th width="60">11</th>
				<th width="40">12</th>
				<th width="40">13</th>
				<th width="60">14</th>
				<th width="60">15</th>
				<th width="40">16</th>
				<th width="40">17</th>
			</tr>';
$no = 1;
$idPeg = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN tb_pegawai ON pegawai.pegawai_id=tb_pegawai.pegawai_id 
						JOIN pembagian1 ON tb_pegawai.pegawai_id=pembagian1.pembagian1_id
						JOIN tb_sekolah ON pembagian1.pembagian1_id=tb_sekolah.id_sekolah ORDER BY urut_pangkat ASC");
while ($peg = mysqli_fetch_array($idPeg, MYSQLI_ASSOC)) {
	$html .= '<tr>
					<td align="center">' . $no++ . '</td>
					<td colspan="2">' . $peg['pegawai_nama'] . '<br />' . $peg['tempat_lahir'] . ',' . $peg['tgl_lahir'] . '</td>
					<td>' . $peg['pegawai_nip'] . '</td>';
	$idPan = mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE (id_peg='$peg[pegawai_id]' AND status_pan='Aktif')");
	$hpan = mysqli_fetch_array($idPan, MYSQLI_ASSOC);
	$hpan1 = isset($hpan['pangkat']) ? $hpan['pangkat'] : '';
	$hpan2 = isset($hpan['gol']) ? $hpan['gol'] : '';
	$hpan3 = isset($hpan['tmt_pangkat']) ? $hpan['tmt_pangkat'] : '';
	$hpan4 = isset($hpan['tgl_sk']) ? $hpan['tgl_sk'] : '';
	$html .= '<td align="center">' . $hpan1 . '<br />' . $hpan2 . '</td>
					<td>' . $hpan3 . '</td>';
	$idJab = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE (pembagian1_id='$peg[pembagian1_id]') ");
	$hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
	$idjab = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE (id_peg='$peg[pegawai_id]')");
	$hjabb = mysqli_fetch_array($idjab, MYSQLI_ASSOC);
	$hjab1 = isset($hjab['pembagian1_nama']) ? $hjab['pembagian1_nama'] : '';
	$hjab2 = isset($hjabb['tmt_jabatan']) ? $hjabb['tmt_jabatan'] : '';
	
	$html .= '<td>' . $hjab1 . '</td>
					<td>' . $hjab2. '</td>
					<td align="center">' . $hjab2 . '</td>';
	$tgl_sk	= new DateTime($hpan4);
	$today	= new DateTime();
	$selisih	= $today->diff($tgl_sk);
	$html .= '<td align="center">' . $selisih->y . '</td>
					<td align="center">' . $selisih->m . '</td>';
	$idLatjab = mysqli_query($koneksi, "SELECT * FROM tb_lat_jabatan WHERE id_lat_jabatan='$peg[pegawai_id]'");
	$hljab = mysqli_fetch_array($idLatjab, MYSQLI_ASSOC);
	$hljab1 = isset($hljab['nama_pelatih']) ? $hljab['nama_pelatih'] : '';
	$hljab2 = isset($hljab['tahun_lat']) ? $hljab['tahun_lat'] : '';
	$hljab3 = isset($hljab['jml_jam']) ? $hljab['jml_jam'] : '';
	$html .= '<td>' . $hljab1 . '</td>
					<td align="center">' . $hljab2. '</td>
					<td align="center">' . $hljab3 . '</td>';
	$idSek = mysqli_query($koneksi, "SELECT * FROM  tb_sekolah WHERE (id_sekolah='$peg[id_sekolah]' AND status='Akhir')");
	$hsek = mysqli_fetch_array($idSek, MYSQLI_ASSOC);
	$hsek1 = isset($hsek['nama_sekolah']) ? $hsek['nama_sekolah'] : '';
	$hsek2 = isset($hsek['tgl_ijazah']) ? $hsek['tgl_ijazah'] : '';
	$hsek3 = isset($hsek['tingkat']) ? $hsek['tingkat'] : '';
	$html .= '<td>' . $hsek1 . '</td>
					<td>' . $hsek2 . '</td>
					<td align="center">' . $hsek3. '</td>
					<td align="center">' . $peg['pegawai_status'] . '</td>
				</tr>';
}
$html .= '</table><br /><br /><br />';
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
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;">BADAN KEPEGAWAIAN DAERAH</font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;">KABUPATEN ' . $kep['nama_peru'] . '</font></td>
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
				<td align="center"><font size="9">' . $pan1. '</font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>NIP. ' . $nama['pegawai_nip'] . '</b></font></td>
			</tr>
		</table>';
$pdf->writeHTML($html, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('DUK_' . date("dmY") . '.pdf', 'I');
