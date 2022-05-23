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
	
$header = '<p align="center"><font size="12"><b>LAPORAN BULANAN KEADAAN PEGAWAI</b></font><br />
			<font size="10" style="text-transform:uppercase">PEMERINTAH KABUPATEN '.$kep['kab'].'</font></p><br /><br />';
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
$skrg=date("Y-m");
$subhead = '<table cellpadding="1" border="0">
			<tr>
				<td width="100">PERIODE</td>
				<td width="560">: BULAN '.date ('m').' TAHUN '.date ('Y').'</td>
			</tr>
		</table>';
$pdf->writeHTML($subhead, true, false, false, false, '');

$html ='<table border="1" cellspacing="0" cellpadding="3">
			<tr align="center">
				<th width="30" rowspan="2">No</th>
				<th width="170" rowspan="2">JENIS LAPORAN</th>
				<th width="160" colspan="4">GOLONGAN</th>
				<th width="40" rowspan="2">JML</th>
				<th width="160" colspan="4">ESELON</th>
				<th width="40" rowspan="2">STAFF</th>
				<th width="60" rowspan="2">KET</th>
			</tr>
			<tr align="center">
				<th width="40">I</th>
				<th width="40">II</th>
				<th width="40">III</th>
				<th width="40">IV</th>
				<th width="40">II</th>
				<th width="40">III</th>
				<th width="40">IV</th>
				<th width="40">V</th>
			</tr>
			<tr align="center">
				<th width="30">1</th>
				<th width="170">2</th>
				<th width="40">3</th>
				<th width="40">4</th>
				<th width="40">5</th>
				<th width="40">6</th>
				<th width="40">7</th>
				<th width="40">8</th>
				<th width="40">9</th>
				<th width="40">10</th>
				<th width="40">11</th>
				<th width="40">12</th>
				<th width="60">13</th>
			</tr>
			<tr>
				<td align="center" rowspan="3">1</td>
				<td>JUMLAH PEGAWAI</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>- PRIA</td>';
				$pegL1=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol LIKE 'I/%'");
				$jL1=mysql_num_rows($pegL1);
					if ($jL1==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jL1.'</td>';
						}
				$pegL2=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol LIKE 'II/%'");
				$jL2=mysql_num_rows($pegL2);
					if ($jL2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jL2.'</td>';
						}
				$pegL3=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol LIKE 'III/%'");
				$jL3=mysql_num_rows($pegL3);
					if ($jL3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jL3.'</td>';
						}
				$pegL4=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol LIKE 'IV/%'");
				$jL4=mysql_num_rows($pegL4);
					if ($jL4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jL4.'</td>';
						}
				$pegL=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol !=''");
				$jL=mysql_num_rows($pegL);
					if ($jL==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jL.'</td>';
						}
				$eL2=mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Laki-laki' AND status_jab='Aktif' AND eselon LIKE 'II/%'");
				$jeL2=mysql_num_rows($eL2);
					if ($jeL2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jeL2.'</td>';
						}
				$eL3=mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Laki-laki' AND status_jab='Aktif' AND eselon LIKE 'III/%'");
				$jeL3=mysql_num_rows($eL3);
					if ($jeL3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jeL3.'</td>';
						}
				$eL4=mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Laki-laki' AND status_jab='Aktif' AND eselon LIKE 'IV/%'");
				$jeL4=mysql_num_rows($eL4);
					if ($jeL4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jeL4.'</td>';
						}
				$eL5=mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Laki-laki' AND status_jab='Aktif' AND eselon LIKE 'V/%'");
				$jeL5=mysql_num_rows($eL5);
					if ($jeL5==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jeL5.'</td>';
						}
				$pegSl=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND pangkat LIKE 'staf%'");
				$jSl=mysql_num_rows($pegSl);
					if ($jSl==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jSl.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- WANITA</td>';
				$pegP1=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol LIKE 'I/%'");
				$jP1=mysql_num_rows($pegP1);
					if ($jP1==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jP1.'</td>';
						}
				$pegP2=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol LIKE 'II/%'");
				$jP2=mysql_num_rows($pegP2);
					if ($jP2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jP2.'</td>';
						}
				$pegP3=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol LIKE 'III/%'");
				$jP3=mysql_num_rows($pegP3);
					if ($jP3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jP3.'</td>';
						}
				$pegP4=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol LIKE 'IV/%'");
				$jP4=mysql_num_rows($pegP4);
					if ($jP4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jP4.'</td>';
						}
				$pegP=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol !=''");
				$jP=mysql_num_rows($pegP);
					if ($jP==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jP.'</td>';
						}
				$eP2=mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Perempuan' AND status_jab='Aktif' AND eselon LIKE 'II/%'");
				$jeP2=mysql_num_rows($eP2);
					if ($jeP2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jeP2.'</td>';
						}
				$eP3=mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Perempuan' AND status_jab='Aktif' AND eselon LIKE 'III/%'");
				$jeP3=mysql_num_rows($eP3);
					if ($jeP3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jeP3.'</td>';
						}
				$eP4=mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Perempuan' AND status_jab='Aktif' AND eselon LIKE 'IV/%'");
				$jeP4=mysql_num_rows($eP4);
					if ($jeP4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jeP4.'</td>';
						}
				$eP5=mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Perempuan' AND status_jab='Aktif' AND eselon LIKE 'V/%'");
				$jeP5=mysql_num_rows($eP5);
					if ($jeP5==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jeP5.'</td>';
						}
				$pegSp=mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND pangkat LIKE 'staf%'");
				$jSp=mysql_num_rows($pegSp);
					if ($jSp==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jSp.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td align="center" rowspan="7">2</td>
				<td>JENIS PENDIDIKAN</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>- SD / MI</td>';
				$sd1=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND gol LIKE 'I/%'");
				$jsd1=mysql_num_rows($sd1);
					if ($jsd1==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsd1.'</td>';
						}
				$sd2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND gol LIKE 'II/%'");
				$jsd2=mysql_num_rows($sd2);
					if ($jsd2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsd2.'</td>';
						}
				$sd3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND gol LIKE 'III/%'");
				$jsd3=mysql_num_rows($sd3);
					if ($jsd3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsd3.'</td>';
						}
				$sd4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND gol LIKE 'IV/%'");
				$jsd4=mysql_num_rows($sd4);
					if ($jsd4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsd4.'</td>';
						}
				$sd=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%')");
				$jsd=mysql_num_rows($sd);
					if ($jsd==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsd.'</td>';
						}
				$sde2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND eselon LIKE 'II/%'");
				$jsde2=mysql_num_rows($sde2);
					if ($jsde2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsde2.'</td>';
						}
				$sde3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND eselon LIKE 'III/%'");
				$jsde3=mysql_num_rows($sde3);
					if ($jsde3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsde3.'</td>';
						}
				$sde4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND eselon LIKE 'IV/%'");
				$jsde4=mysql_num_rows($sde4);
					if ($jsde4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsde4.'</td>';
						}
				$sde5=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND eselon LIKE 'V/%'");
				$jsde5=mysql_num_rows($sde5);
					if ($jsde5==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsde5.'</td>';
						}
				$sds=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND pangkat LIKE 'Staff%'");
				$jsds=mysql_num_rows($sds);
					if ($jsds==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jsds.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- SMP / MTS</td>';
				$smp1=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND gol LIKE 'I/%'");
				$jsmp1=mysql_num_rows($smp1);
					if ($jsmp1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmp1.'</td>';
						}
				$smp2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND gol LIKE 'II/%'");
				$jsmp2=mysql_num_rows($smp2);
					if ($jsmp2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmp2.'</td>';
						}
				$smp3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND gol LIKE 'III/%'");
				$jsmp3=mysql_num_rows($smp3);
					if ($jsmp3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmp3.'</td>';
						}
				$smp4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND gol LIKE 'IV/%'");
				$jsmp4=mysql_num_rows($smp4);
					if ($jsmp4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmp4.'</td>';
						}
				$smp=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%')");
				$jsmp=mysql_num_rows($smp);
					if ($jsmp==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmp.'</td>';
						}
				$smpe2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND eselon LIKE 'II/%'");
				$jsmpe2=mysql_num_rows($smpe2);
					if ($jsmpe2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmpe2.'</td>';
						}
				$smpe3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND eselon LIKE 'III/%'");
				$jsmpe3=mysql_num_rows($smpe3);
					if ($jsmpe3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmpe3.'</td>';
						}
				$smpe4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND eselon LIKE 'IV/%'");
				$jsmpe4=mysql_num_rows($smpe4);
					if ($jsmpe4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmpe4.'</td>';
						}
				$smpe5=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND eselon LIKE 'V/%'");
				$jsmpe5=mysql_num_rows($smpe5);
					if ($jsmpe5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmpe5.'</td>';
						}
				$smps=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND pangkat LIKE 'Staff%'");
				$jsmps=mysql_num_rows($smps);
					if ($jsmps==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmps.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- SMK / SMA / MA</td>';
				$sma1=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir'  AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND gol LIKE 'I/%'");
				$jsma1=mysql_num_rows($sma1);
					if ($jsma1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsma1.'</td>';
						}
				$sma2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir'  AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND gol LIKE 'II/%'");
				$jsma2=mysql_num_rows($sma2);
					if ($jsma2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsma2.'</td>';
						}
				$sma3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND gol LIKE 'III/%'");
				$jsma3=mysql_num_rows($sma3);
					if ($jsma3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsma3.'</td>';
						}
				$sma4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND gol LIKE 'IV/%'");
				$jsma4=mysql_num_rows($sma4);
					if ($jsma4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsma4.'</td>';
						}
				$sma=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%')");
				$jsma=mysql_num_rows($sma);
					if ($jsma==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsma.'</td>';
						}
				$smae2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND eselon LIKE 'II/%'");
				$jsmae2=mysql_num_rows($smae2);
					if ($jsmae2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmae2.'</td>';
						}
				$smae3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND eselon LIKE 'III/%'");
				$jsmae3=mysql_num_rows($smae3);
					if ($jsmae3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmae3.'</td>';
						}
				$smae4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND eselon LIKE 'IV/%'");
				$jsmae4=mysql_num_rows($smae4);
					if ($jsmae4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmae4.'</td>';
						}
				$smae5=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND eselon LIKE 'V/%'");
				$jsmae5=mysql_num_rows($smae5);
					if ($jsmae5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmae5.'</td>';
						}
				$smas=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND pangkat LIKE 'Staff%'");
				$jsmas=mysql_num_rows($smas);
					if ($jsmas==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jsmas.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- D2 / D3</td>';
				$d1=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND gol LIKE 'I/%'");
				$jd1=mysql_num_rows($d1);
					if ($jd1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jd1.'</td>';
						}
				$d2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND gol LIKE 'II/%'");
				$jd2=mysql_num_rows($d2);
					if ($jd2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jd2.'</td>';
						}
				$d3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND gol LIKE 'III/%'");
				$jd3=mysql_num_rows($d3);
					if ($jd3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jd3.'</td>';
						}
				$d4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND gol LIKE 'IV/%'");
				$jd4=mysql_num_rows($d4);
					if ($jd4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jd4.'</td>';
						}
				$d=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%')");
				$jd=mysql_num_rows($d);
					if ($jd==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jd.'</td>';
						}
				$de2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND eselon LIKE 'II/%'");
				$jde2=mysql_num_rows($de2);
					if ($jde2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jde2.'</td>';
						}
				$de3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND eselon LIKE 'III/%'");
				$jde3=mysql_num_rows($de3);
					if ($jde3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jde3.'</td>';
						}
				$de4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND eselon LIKE 'IV/%'");
				$jde4=mysql_num_rows($de4);
					if ($jde4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jde4.'</td>';
						}
				$de5=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND eselon LIKE 'V/%'");
				$jde5=mysql_num_rows($de5);
					if ($jde5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jde5.'</td>';
						}
				$ds=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND pangkat LIKE 'Staff%'");
				$jds=mysql_num_rows($ds);
					if ($jds==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jds.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- S1 / D4</td>';
				$s11=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND gol LIKE 'I/%'");
				$js11=mysql_num_rows($s11);
					if ($js11==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js11.'</td>';
						}
				$s12=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND gol LIKE 'II/%'");
				$js12=mysql_num_rows($s12);
					if ($js12==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js12.'</td>';
						}
				$s13=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND gol LIKE 'III/%'");
				$js13=mysql_num_rows($s13);
					if ($js13==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js13.'</td>';
						}
				$s14=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND gol LIKE 'IV/%'");
				$js14=mysql_num_rows($s14);
					if ($js14==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js14.'</td>';
						}
				$s1=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%')");
				$js1=mysql_num_rows($s1);
					if ($js1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js1.'</td>';
						}
				$s1e2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND eselon LIKE 'II/%'");
				$js1e2=mysql_num_rows($s1e2);
					if ($js1e2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js1e2.'</td>';
						}
				$s1e3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND eselon LIKE 'III/%'");
				$js1e3=mysql_num_rows($s1e3);
					if ($js1e3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js1e3.'</td>';
						}
				$s1e4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND eselon LIKE 'IV/%'");
				$js1e4=mysql_num_rows($s1e4);
					if ($js1e4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js1e4.'</td>';
						}
				$s1e5=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND eselon LIKE 'V/%'");
				$js1e5=mysql_num_rows($s1e5);
					if ($js1e5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js1e5.'</td>';
						}
				$s1s=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND pangkat LIKE 'Staff%'");
				$js1s=mysql_num_rows($s1s);
					if ($js1s==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js1s.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- S2 / S3</td>';
				$s21=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND gol LIKE 'I/%'");
				$js21=mysql_num_rows($s21);
					if ($js21==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js21.'</td>';
						}
				$s22=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND gol LIKE 'II/%'");
				$js22=mysql_num_rows($s22);
					if ($js22==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js22.'</td>';
						}
				$s23=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND gol LIKE 'III/%'");
				$js23=mysql_num_rows($s23);
					if ($js23==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js23.'</td>';
						}
				$s24=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND gol LIKE 'IV/%'");
				$js24=mysql_num_rows($s24);
					if ($js24==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js24.'</td>';
						}
				$s2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%')");
				$js2=mysql_num_rows($s2);
					if ($js2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js2.'</td>';
						}
				$s2e2=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND eselon LIKE 'II/%'");
				$js2e2=mysql_num_rows($s2e2);
					if ($js2e2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js2e2.'</td>';
						}
				$s2e3=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND eselon LIKE 'III/%'");
				$js2e3=mysql_num_rows($s2e3);
					if ($js2e3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js2e3.'</td>';
						}
				$s2e4=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND eselon LIKE 'IV/%'");
				$js2e4=mysql_num_rows($s2e4);
					if ($js2e4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js2e4.'</td>';
						}
				$s2e5=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND eselon LIKE 'V/%'");
				$js2e5=mysql_num_rows($s2e5);
					if ($js2e5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js2e5.'</td>';
						}
				$s2s=mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND pangkat LIKE 'Staff%'");
				$js2s=mysql_num_rows($s2s);
					if ($js2s==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$js2s.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td align="center" rowspan="7">3</td>
				<td>MUTASI PEGAWAI</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>- MASUK</td>';
				$mg1=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jmg1=mysql_num_rows($mg1);
					if ($jmg1==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jmg1.'</td>';
						}
				$mg2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jmg2=mysql_num_rows($mg2);
					if ($jmg2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jmg2.'</td>';
						}
				$mg3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jmg3=mysql_num_rows($mg3);
					if ($jmg3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jmg3.'</td>';
						}
				$mg4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jmg4=mysql_num_rows($mg4);
					if ($jmg4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jmg4.'</td>';
						}
				$mg=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%'");
				$jmg=mysql_num_rows($mg);
					if ($jmg==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jmg.'</td>';
						}
				$me2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jme2=mysql_num_rows($me2);
					if ($jme2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jme2.'</td>';
						}
				$me3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jme3=mysql_num_rows($me3);
					if ($jme3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jme3.'</td>';
						}
				$me4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jme4=mysql_num_rows($me4);
					if ($jme4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jme4.'</td>';
						}
				$me5=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jme5=mysql_num_rows($me5);
					if ($jme5==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jme5.'</td>';
						}
				$ms=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jms=mysql_num_rows($ms);
					if ($jms==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jms.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- KELUAR</td>';
				$mkg1=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jmkg1=mysql_num_rows($mkg1);
					if ($jmkg1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmkg1.'</td>';
						}
				$mkg2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jmkg2=mysql_num_rows($mkg2);
					if ($jmkg2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmkg2.'</td>';
						}
				$mkg3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jmkg3=mysql_num_rows($mkg3);
					if ($jmkg3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmkg3.'</td>';
						}
				$mkg4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jmkg4=mysql_num_rows($mkg4);
					if ($jmkg4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmkg4.'</td>';
						}
				$mkg=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%'");
				$jmkg=mysql_num_rows($mkg);
					if ($jmkg==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmkg.'</td>';
						}
				$mke2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jmke2=mysql_num_rows($mke2);
					if ($jmke2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmke2.'</td>';
						}
				$mke3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jmke3=mysql_num_rows($mke3);
					if ($jmke3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmke3.'</td>';
						}
				$mke4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jmke4=mysql_num_rows($mke4);
					if ($jmke4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmke4.'</td>';
						}
				$mke5=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jmke5=mysql_num_rows($mke5);
					if ($jmke5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmke5.'</td>';
						}
				$mks=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jmks=mysql_num_rows($mks);
					if ($jmks==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmks.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- PINDAH ANTAR INSTANSI</td>';
				$mpg1=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jmpg1=mysql_num_rows($mpg1);
					if ($jmpg1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpg1.'</td>';
						}
				$mpg2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jmpg2=mysql_num_rows($mpg2);
					if ($jmpg2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpg2.'</td>';
						}
				$mpg3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jmpg3=mysql_num_rows($mpg3);
					if ($jmpg3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpg3.'</td>';
						}
				$mpg4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jmpg4=mysql_num_rows($mpg4);
					if ($jmpg4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpg4.'</td>';
						}
				$mpg=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%'");
				$jmpg=mysql_num_rows($mpg);
					if ($jmpg==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpg.'</td>';
						}
				$mpe2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jmpe2=mysql_num_rows($mpe2);
					if ($jmpe2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpe2.'</td>';
						}
				$mpe3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jmpe3=mysql_num_rows($mpe3);
					if ($jmpe3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpe3.'</td>';
						}
				$mpe4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jmpe4=mysql_num_rows($mpe4);
					if ($jmpe4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpe4.'</td>';
						}
				$mpe5=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jmpe5=mysql_num_rows($mpe5);
					if ($jmpe5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpe5.'</td>';
						}
				$mps=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jmps=mysql_num_rows($mps);
					if ($jmps==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmps.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- PENSIUN</td>';
				$mpng1=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jmpng1=mysql_num_rows($mpng1);
					if ($jmpng1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpng1.'</td>';
						}
				$mpng2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jmpng2=mysql_num_rows($mpng2);
					if ($jmpng2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpng2.'</td>';
						}
				$mpng3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jmpng3=mysql_num_rows($mpng3);
					if ($jmpng3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpng3.'</td>';
						}
				$mpng4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jmpng4=mysql_num_rows($mpng4);
					if ($jmpng4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpng4.'</td>';
						}
				$mpng=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%'");
				$jmpng=mysql_num_rows($mpng);
					if ($jmpng==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpng.'</td>';
						}
				$mpne2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jmpne2=mysql_num_rows($mpne2);
					if ($jmpne2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpne2.'</td>';
						}
				$mpne3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jmpne3=mysql_num_rows($mpne3);
					if ($jmpne3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpne3.'</td>';
						}
				$mpne4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jmpne4=mysql_num_rows($mpne4);
					if ($jmpne4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpne4.'</td>';
						}
				$mpne5=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jmpne5=mysql_num_rows($mpne5);
					if ($jmpne5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpne5.'</td>';
						}
				$mpns=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jmpns=mysql_num_rows($mpns);
					if ($jmpns==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmpns.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- WAFAT</td>';
				$mwafg1=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jmwafg1=mysql_num_rows($mwafg1);
					if ($jmwafg1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafg1.'</td>';
						}
				$mwafg2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jmwafg2=mysql_num_rows($mwafg2);
					if ($jmwafg2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafg2.'</td>';
						}
				$mwafg3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jmwafg3=mysql_num_rows($mwafg3);
					if ($jmwafg3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafg3.'</td>';
						}
				$mwafg4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jmwafg4=mysql_num_rows($mwafg4);
					if ($jmwafg4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafg4.'</td>';
						}
				$mwafg=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%'");
				$jmwafg=mysql_num_rows($mwafg);
					if ($jmwafg==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafg.'</td>';
						}
				$mwafe2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jmwafe2=mysql_num_rows($mwafe2);
					if ($jmwafe2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafe2.'</td>';
						}
				$mwafe3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jmwafe3=mysql_num_rows($mwafe3);
					if ($jmwafe3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafe3.'</td>';
						}
				$mwafe4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jmwafe4=mysql_num_rows($mwafe4);
					if ($jmwafe4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafe4.'</td>';
						}
				$mwafe5=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jmwafe5=mysql_num_rows($mwafe5);
					if ($jmwafe5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafe5.'</td>';
						}
				$mwafs=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jmwafs=mysql_num_rows($mwafs);
					if ($jmwafs==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmwafs.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- KENAIKAN PANGKAT</td>';
				$mnaikg1=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jmnaikg1=mysql_num_rows($mnaikg1);
					if ($jmnaikg1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaikg1.'</td>';
						}
				$mnaikg2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jmnaikg2=mysql_num_rows($mnaikg2);
					if ($jmnaikg2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaikg2.'</td>';
						}
				$mnaikg3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jmnaikg3=mysql_num_rows($mnaikg3);
					if ($jmnaikg3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaikg3.'</td>';
						}
				$mnaikg4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jmnaikg4=mysql_num_rows($mnaikg4);
					if ($jmnaikg4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaikg4.'</td>';
						}
				$mnaikg=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%'");
				$jmnaikg=mysql_num_rows($mnaikg);
					if ($jmnaikg==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaikg.'</td>';
						}
				$mnaike2=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jmnaike2=mysql_num_rows($mnaike2);
					if ($jmnaike2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaike2.'</td>';
						}
				$mnaike3=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jmnaike3=mysql_num_rows($mnaike3);
					if ($jmnaike3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaike3.'</td>';
						}
				$mnaike4=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jmnaike4=mysql_num_rows($mnaike4);
					if ($jmnaike4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaike4.'</td>';
						}
				$mnaike5=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jmnaike5=mysql_num_rows($mnaike5);
					if ($jmnaike5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaike5.'</td>';
						}
				$mnaiks=mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jmnaiks=mysql_num_rows($mnaiks);
					if ($jmnaiks==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jmnaiks.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td align="center" rowspan="6">4</td>
				<td>JENIS HUKUMAN DISIPLIN</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>- TEGURAN LISAN</td>';
				$hlisg1=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jhlisg1=mysql_num_rows($hlisg1);
					if ($jhlisg1==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhlisg1.'</td>';
						}
				$hlisg2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jhlisg2=mysql_num_rows($hlisg2);
					if ($jhlisg2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhlisg2.'</td>';
						}
				$hlisg3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jhlisg3=mysql_num_rows($hlisg3);
					if ($jhlisg3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhlisg3.'</td>';
						}
				$hlisg4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jhlisg4=mysql_num_rows($hlisg4);
					if ($jhlisg4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhlisg4.'</td>';
						}
				$hlisg=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%'");
				$jhlisg=mysql_num_rows($hlisg);
					if ($jhlisg==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhlisg.'</td>';
						}
				$hlise2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jhlise2=mysql_num_rows($hlise2);
					if ($jhlise2==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhlise2.'</td>';
						}
				$hlise3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jhlise3=mysql_num_rows($hlise3);
					if ($jhlise3==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhlise3.'</td>';
						}
				$hlise4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jhlise4=mysql_num_rows($hlise4);
					if ($jhlise4==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhlise4.'</td>';
						}
				$hlise5=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jhlise5=mysql_num_rows($hlise5);
					if ($jhlise5==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhlise5.'</td>';
						}
				$hliss=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jhliss=mysql_num_rows($hliss);
					if ($jhliss==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jhliss.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- TEGURAN TERTULIS</td>';
				$hterg1=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jhterg1=mysql_num_rows($hterg1);
					if ($jhterg1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhterg1.'</td>';
						}
				$hterg2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jhterg2=mysql_num_rows($hterg2);
					if ($jhterg2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhterg2.'</td>';
						}
				$hterg3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jhterg3=mysql_num_rows($hterg3);
					if ($jhterg3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhterg3.'</td>';
						}
				$hterg4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jhterg4=mysql_num_rows($hterg4);
					if ($jhterg4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhterg4.'</td>';
						}
				$hterg=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%'");
				$jhterg=mysql_num_rows($hterg);
					if ($jhterg==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhterg.'</td>';
						}
				$htere2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jhtere2=mysql_num_rows($htere2);
					if ($jhtere2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhtere2.'</td>';
						}
				$htere3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jhtere3=mysql_num_rows($htere3);
					if ($jhtere3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhtere3.'</td>';
						}
				$htere4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jhtere4=mysql_num_rows($htere4);
					if ($jhtere4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhtere4.'</td>';
						}
				$htere5=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jhtere5=mysql_num_rows($htere5);
					if ($jhtere5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhtere5.'</td>';
						}
				$hters=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jhters=mysql_num_rows($hters);
					if ($jhters==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhters.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- TUNDA KENAIKAN BERKALA</td>';
				$hberg1=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jhberg1=mysql_num_rows($hberg1);
					if ($jhberg1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhberg1.'</td>';
						}
				$hberg2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jhberg2=mysql_num_rows($hberg2);
					if ($jhberg2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhberg2.'</td>';
						}
				$hberg3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jhberg3=mysql_num_rows($hberg3);
					if ($jhberg3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhberg3.'</td>';
						}
				$hberg4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jhberg4=mysql_num_rows($hberg4);
					if ($jhberg4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhberg4.'</td>';
						}
				$hberg=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%'");
				$jhberg=mysql_num_rows($hberg);
					if ($jhberg==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhberg.'</td>';
						}
				$hbere2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jhbere2=mysql_num_rows($hbere2);
					if ($jhbere2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhbere2.'</td>';
						}
				$hbere3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jhbere3=mysql_num_rows($hbere3);
					if ($jhbere3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhbere3.'</td>';
						}
				$hbere4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jhbere4=mysql_num_rows($hbere4);
					if ($jhbere4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhbere4.'</td>';
						}
				$hbere5=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jhbere5=mysql_num_rows($hbere5);
					if ($jhbere5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhbere5.'</td>';
						}
				$hbers=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jhbers=mysql_num_rows($hbers);
					if ($jhbers==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhbers.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- TUNDA KENAIKAN PANGKAT</td>';
				$hpg1=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jhpg1=mysql_num_rows($hpg1);
					if ($jhpg1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpg1.'</td>';
						}
				$hpg2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jhpg2=mysql_num_rows($hpg2);
					if ($jhpg2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpg2.'</td>';
						}
				$hpg3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jhpg3=mysql_num_rows($hpg3);
					if ($jhpg3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpg3.'</td>';
						}
				$hpg4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jhpg4=mysql_num_rows($hpg4);
					if ($jhpg4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpg4.'</td>';
						}
				$hpg=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%'");
				$jhpg=mysql_num_rows($hpg);
					if ($jhpg==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpg.'</td>';
						}
				$hpe2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jhpe2=mysql_num_rows($hpe2);
					if ($jhpe2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpe2.'</td>';
						}
				$hpe3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jhpe3=mysql_num_rows($hpe3);
					if ($jhpe3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpe3.'</td>';
						}
				$hpe4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jhpe4=mysql_num_rows($hpe4);
					if ($jhpe4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpe4.'</td>';
						}
				$hpe5=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jhpe5=mysql_num_rows($hpe5);
					if ($jhpe5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpe5.'</td>';
						}
				$hps=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jhps=mysql_num_rows($hps);
					if ($jhps==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhps.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td>- PEMBERHENTIAN</td>';
				$hpemg1=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
				$jhpemg1=mysql_num_rows($hpemg1);
					if ($jhpemg1==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpemg1.'</td>';
						}
				$hpemg2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
				$jhpemg2=mysql_num_rows($hpemg2);
					if ($jhpemg2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpemg2.'</td>';
						}
				$hpemg3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
				$jhpemg3=mysql_num_rows($hpemg3);
					if ($jhpemg3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpemg3.'</td>';
						}
				$hpemg4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
				$jhpemg4=mysql_num_rows($hpemg4);
					if ($jhpemg4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpemg4.'</td>';
						}
				$hpemg=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%'");
				$jhpemg=mysql_num_rows($hpemg);
					if ($jhpemg==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpemg.'</td>';
						}
				$hpeme2=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
				$jhpeme2=mysql_num_rows($hpeme2);
					if ($jhpeme2==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpeme2.'</td>';
						}
				$hpeme3=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
				$jhpeme3=mysql_num_rows($hpeme3);
					if ($jhpeme3==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpeme3.'</td>';
						}
				$hpeme4=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
				$jhpeme4=mysql_num_rows($hpeme4);
					if ($jhpeme4==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpeme4.'</td>';
						}
				$hpeme5=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
				$jhpeme5=mysql_num_rows($hpeme5);
					if ($jhpeme5==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpeme5.'</td>';
						}
				$hpems=mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
				$jhpems=mysql_num_rows($hpems);
					if ($jhpems==0){
						$html .='<td  align="center">-</td>';
						}
						else{
						$html .='<td  align="center">'.$jhpems.'</td>';
						}
				$html .='<td></td>
			</tr>
			<tr>
				<td align="center" rowspan="3">5</td>
				<td>JUMLAH PTT</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>';
				$ptt=mysql_query("SELECT * FROM tb_pegawai WHERE status_kepeg='PTT' ");
				$jptt=mysql_num_rows($ptt);
					if ($jptt==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jptt.'</td>';
						}
				$html .='<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>- PRIA</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>';
				$pttl=mysql_query("SELECT * FROM tb_pegawai WHERE status_kepeg='PTT' AND jk='Laki-laki' ");
				$jpttl=mysql_num_rows($pttl);
					if ($jpttl==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jpttl.'</td>';
						}
				$html .='<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>- WANITA</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>';
				$pttp=mysql_query("SELECT * FROM tb_pegawai WHERE status_kepeg='PTT' AND jk='Perempuan' ");
				$jpttp=mysql_num_rows($pttp);
					if ($jpttp==0){
						$html .='<td  align="center">-</td>';
						}
					else{
						$html .='<td  align="center">'.$jpttp.'</td>';
						}
				$html .='<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>'; 
$html .= '</table><br /><br />';
$html .= '<table cellpadding="1" border="0" align="center">
			<tr>
				<td width="250"></td>
				<td width="110"></td>
				<td width="300">'.$kep['kab'].', '.date("j F Y").'</td>
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
$pdf->Output('Keadaan_Pegawai_'.date ("dmY").'.pdf', 'I');
?>