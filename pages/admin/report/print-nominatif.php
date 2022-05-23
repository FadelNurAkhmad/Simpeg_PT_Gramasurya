<?php
ob_start();
include'../../../assets/plugins/tcpdf/tcpdf.php';

class MYPDF extends TCPDF {
	public function Header() {
        // Logo
        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
        //$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Header
        //$html = '<p align="center"></p>';
		//$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
    }
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'    '.'*** '.date ("d-m-Y").' ***', 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8);
	
	include "../../../config/koneksi.php";
	
	$kepala	=mysql_query("SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='1'");
	$kep	=mysql_fetch_array($kepala);
	
	$namakepala	=mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$kep[kepala]'");
	$nama		=mysql_fetch_array($namakepala);
	
	$pangkat=mysql_query("SELECT * FROM tb_pangkat WHERE id_peg='$kep[kepala]' AND status_pan='Aktif'");
	$pan	=mysql_fetch_array($pangkat);
	
$header = '<p align="center"><font size="12"><b>DAFTAR NOMINATIF PEGAWAI NEGERI SIPIL</b></font><br />
			<font size="10" style="text-transform:uppercase">PER '.date("j F Y").'<font></p>';
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
$subhead = '<table cellpadding="1" border="0">
			<tr>
				<td><font size="8" style="text-transform:uppercase">PEMERINTAH KABUPATEN '.$kep['kab'].'</font></td>
			</tr>
		</table>';
$pdf->writeHTML($subhead, true, false, false, false, '');
$html ='<table border="1" cellspacing="0" cellpadding="3">
			<tr align="center">
				<th rowspan="2" width="30">NO</th>
				<th colspan="2" width="140">NAMA, TTL</th>
				<th rowspan="2" width="70">JNS KELAMIN</th>
				<th colspan="2" width="120">PKT TERAKHIR</th>
				<th colspan="2" width="140">JABATAN</th>
				<th rowspan="2" width="40">ESL</th>
				<th colspan="3" width="140">LATIHAN JABATAN</th>
				<th rowspan="2" width="110">PEND, JURUSAN, T.LULUS</th>
				<th rowspan="2" width="140">ALAMAT & NO. TELP</th>
				<th rowspan="2" width="40">KET</th>
			</tr>
			<tr align="center">
				<th colspan="2" width="140">NIP, AGAMA</th>
				<th width="60">GOL/RUANG</th>
				<th width="60">TMT</th>
				<th width="80">NAMA</th>
				<th width="60">TMT</th>
				<th width="60">NAMA</th>
				<th width="40">THN</th>
				<th width="40">JML JAM</th>
			</tr>
			<tr align="center">
				<th>1</th>
				<th colspan="2">2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>6</th>
				<th>7</th>
				<th>8</th>
				<th>9</th>
				<th>10</th>
				<th>11</th>
				<th>12</th>
				<th>13</th>
				<th>14</th>
			</tr>';
			$no=1;
			$idPeg=mysql_query("SELECT * FROM tb_pegawai WHERE status_mut='' AND status_kepeg='PNS' ORDER BY urut_pangkat DESC");
			while($peg=mysql_fetch_array($idPeg)) { 
				$html .='<tr>
					<td align="center">'.$no++.'</td>
					<td colspan="2">'.$peg['nama'].'<br /><br />'.$peg['tempat_lhr'].', '.$peg['tgl_lhr'].'<br />'.$peg['nip'].'<br />'.$peg['agama'].'</td>
					<td>'.$peg['jk'].'</td>';
					$idPan=mysql_query("SELECT * FROM tb_pangkat WHERE (id_peg='$peg[id_peg]' AND status_pan='Aktif')");
					$hpan=mysql_fetch_array($idPan);
					$html .='<td align="center">'.$hpan['pangkat'].'<br />'.$hpan['gol'].'</td>
					<td>'.$hpan['tmt_pangkat'].'</td>';
					$idJab=mysql_query("SELECT * FROM tb_jabatan WHERE (id_peg='$peg[id_peg]' AND status_jab='Aktif')");
					$hjab=mysql_fetch_array($idJab);
					$html .='<td>'.$hjab['jabatan'].'</td>
					<td>'.$hjab['tmt_jabatan'].'</td>
					<td align="center">'.$hjab['eselon'].'</td>';
					$idLatjab=mysql_query("SELECT * FROM tb_lat_jabatan WHERE id_peg='$peg[id_peg]'");
					$hljab=mysql_fetch_array($idLatjab);								
					$html .='<td>'.$hljab['nama_pelatih'].'</td>
					<td align="center">'.$hljab['tahun_lat'].'</td>
					<td align="center">'.$hljab['jml_jam'].'</td>';
					$idSek=mysql_query("SELECT * FROM tb_sekolah WHERE (id_peg='$peg[id_peg]' AND status='Akhir')");
					$hsek=mysql_fetch_array($idSek);								
					$html .='<td>'.$hsek['tingkat'].'<br />'.$hsek['nama_sekolah'].'<br />'.$hsek['jurusan'].'<br />'.$hsek['tgl_ijazah'].'</td>
					<td>'.$peg['alamat'].'<br /><br />'.$peg['telp'].'</td>
					<td align="center">'.$peg['status_kepeg'].'</td>
				</tr>';
			} 
$html .= '</table><br /><br />';
$html .= '<table cellpadding="1" border="0" align="center">
			<tr>
				<td width="550"></td>
				<td width="40"></td>
				<td width="380">'.$kep['kab'].', '.date("j F Y").'</td>
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
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;">KABUPATEN '.$kep['kab'].'</font></td>
			</tr>
			<tr>
				<td height="60"></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>'.$nama['nama'].'</b></font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9">'.$pan['pangkat'].'</font></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>NIP. '.$nama['nip'].'</b></font></td>
			</tr>
		</table>';
$pdf->writeHTML($html, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('Daftar_Nominatif_'.date ("dmY").'.pdf', 'I');
?>