<?php
ob_start();
include'../../../assets/plugins/tcpdf/tcpdf.php';

class MYPDF extends TCPDF {
	public function Header() {
        // Logo
        //$image_file ='../../../assets/images/avatars/print.png';
		//$this->Image($image_file, 10, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Header
        //$html = '<p><b>REPORT STOCK</b></p>';
		//$this->writeHTMLCell($w = 0, $h = 0, $x = 40, $y = 10, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
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
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(25, 15, 20);
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
$pdf->SetFont('helvetica', '', 10);

	include "../../../config/koneksi.php";
	
	$kepala	=mysql_query("SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='1'");
	$kep	=mysql_fetch_array($kepala);
	
	$namakepala	=mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$kep[kepala]'");
	$nama		=mysql_fetch_array($namakepala);
	
	$pangkat=mysql_query("SELECT * FROM tb_pangkat WHERE id_peg='$kep[kepala]' AND status_pan='Aktif'");
	$pan	=mysql_fetch_array($pangkat);
	
$head ='<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td width="100" rowspan="3"><img src="../../../assets/img/logo.png" width="78" height="78"/></td>
				<td width="385" align="center"><font size="11" style="text-transform:uppercase;">PEMERINTAH KABUPATEN '.$kep['kab'].'</font></td>	
				<td width="100" rowspan="3"></td>
			</tr>
			<tr>
				<td align="center"><font size="10" style="text-transform:uppercase;font-weight:bold;">BADAN KEPEGAWAIAN DAERAH</font></td>	
			</tr>
			<tr>
				<td align="center"><font size="10">'.$kep['alamat'].'</font></td>	
			</tr>
		</table>
		<table border="2" cellspacing="0" cellpadding="3">
		</table>';	
$pdf->writeHTML($head, true, false, false, false, '');

$subhead ='<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td width="585" align="center"><font size="10"><b>Rekapitulasi Pegawai Berdasarkan Golongan</b></font></td>	
			</tr>
		</table><br /><br />';	
$pdf->writeHTML($subhead, true, false, false, false, '');

$html ='<table border="1" cellspacing="0" cellpadding="3">
			<tr align="center">
				<td width="40" height="28"><b>NO</b></td>
				<td width="380"><b>GOLONGAN</b></td>	
				<td width="165"><b>JUMLAH PEGAWAI</b></td>	
			</tr>';
			$no=0;
			$rekapgol	=mysql_query("SELECT * FROM tb_pegawai WHERE status_mut='' GROUP BY urut_pangkat ORDER BY urut_pangkat DESC");
			while($gol=mysql_fetch_array($rekapgol)){
			$no++;
			$html .='<tr>
				<td align="center">'.$no.'</td>
				<td>'.$gol['urut_pangkat'].'</td>';
				$jml=mysql_query("SELECT * FROM tb_pegawai WHERE status_mut='' AND urut_pangkat='$gol[urut_pangkat]'");
				$html .='<td>'.mysql_num_rows($jml).'</td>
			</tr>';
			}			
$html .='</table><br /><br />';
$pdf->writeHTML($html, true, false, false, false, '');

$sign = '<table cellpadding="1" border="0" align="center">
			<tr>
				<td width="200"></td>
				<td width="100"></td>
				<td width="285">'.$kep['kab'].', '.date("j F Y").'</td>
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
$pdf->writeHTML($sign, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('Rekap_Golongan_'.date("Ymd").'.pdf', 'I');
?>