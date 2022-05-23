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
	
$header = '<p align="center"><font size="12"><b>DAFTAR URUT KEPANGKATAN PEGAWAI NEGERI SIPIL</b></font><br />
			<font size="9" style="text-transform:uppercase">PEMERINTAH KABUPATEN '.$kep['kab'].' TAHUN '.date ('Y').'<font></p>';
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
$html ='<table border="1" cellspacing="0" cellpadding="3">
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
			$no=1;
			$idPeg=mysql_query("SELECT * FROM tb_pegawai WHERE status_mut='' AND status_kepeg='PNS' ORDER BY urut_pangkat DESC");
			while($peg=mysql_fetch_array($idPeg)) { 
				$html .='<tr>
					<td align="center">'.$no++.'</td>
					<td colspan="2">'.$peg['nama'].'<br />'.$peg['tempat_lhr'].','.$peg['tgl_lhr'].'</td>
					<td>'.$peg['nip'].'</td>';
					$idPan=mysql_query("SELECT * FROM tb_pangkat WHERE (id_peg='$peg[id_peg]' AND status_pan='Aktif')");
					$hpan=mysql_fetch_array($idPan);
					$html .='<td align="center">'.$hpan['pangkat'].'<br />'.$hpan['gol'].'</td>
					<td>'.$hpan['tmt_pangkat'].'</td>';
					$idJab=mysql_query("SELECT * FROM tb_jabatan WHERE (id_peg='$peg[id_peg]' AND status_jab='Aktif')");
					$hjab=mysql_fetch_array($idJab);
					$html .='<td>'.$hjab['jabatan'].'</td>
					<td>'.$hjab['tmt_jabatan'].'</td>
					<td align="center">'.$hjab['eselon'].'</td>';
					$tgl_sk	= new DateTime($hpan['tgl_sk']);
					$today	= new DateTime();										
					$selisih	= $today->diff($tgl_sk);										
					$html .='<td align="center">'.$selisih->y.'</td>
					<td align="center">'.$selisih->m.'</td>';
					$idLatjab=mysql_query("SELECT * FROM tb_lat_jabatan WHERE id_peg='$peg[id_peg]'");
					$hljab=mysql_fetch_array($idLatjab);								
					$html .='<td>'.$hljab['nama_pelatih'].'</td>
					<td align="center">'.$hljab['tahun_lat'].'</td>
					<td align="center">'.$hljab['jml_jam'].'</td>';
					$idSek=mysql_query("SELECT * FROM tb_sekolah WHERE (id_peg='$peg[id_peg]' AND status='Akhir')");
					$hsek=mysql_fetch_array($idSek);								
					$html .='<td>'.$hsek['nama_sekolah'].'</td>
					<td>'.$hsek['tgl_ijazah'].'</td>
					<td align="center">'.$hsek['tingkat'].'</td>
					<td align="center">'.$peg['status_kepeg'].'</td>
				</tr>';
			} 
$html .= '</table><br /><br /><br />';
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
$pdf->Output('DUK_'.date ("dmY").'.pdf', 'I');
?>