<?php
ob_start();
include'../../../assets/plugins/tcpdf/tcpdf.php';
if (isset($_GET['pegawai_id'])) {
	$id_peg = $_GET['pegawai_id'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
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
$pdf->SetFont('helvetica', '', 9);
include "../../../config/koneksi.php";

	$kepala	=mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
	$kep	=mysqli_fetch_array($kepala, MYSQLI_ASSOC);
	
	$namakepala	=mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$kep[pimpinan]'");
	$nama		=mysqli_fetch_array($namakepala, MYSQLI_ASSOC);
	
	$pangkat=mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$kep[pimpinan]' AND status_pan='Aktif'");
	$pank	=mysqli_fetch_array($pangkat, MYSQLI_ASSOC);

$tampilPeg=mysqli_query($koneksi, "SELECT * FROM pegawai JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id ");
$peg=mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);

//agama
if ($peg['agama'] == '1') {
	$agama = 'Islam';
}
//gender
if ($peg['gender'] == '1') {
	$gender = 'Laki-Laki';
} else if ($peg['gender'] == '2') {
	$gender = 'Perempuan';
}

//goldar
if ($peg['gol_darah'] == '1') {
	$goldar = 'A+';
} else if ($peg['gol_darah'] == '2') {
	$goldar = 'B+';
} else if ($peg['gol_darah'] == '3') {
	$goldar = 'O+';
} else if ($peg['gol_darah'] == '4') {
	$goldar = 'A-';
} else if ($peg['gol_darah'] == '5') {
	$goldar = 'AB+';
} else if ($peg['gol_darah'] == '6') {
	$goldar = 'B-';
} else if ($peg['gol_darah'] == '7') {
	$goldar = 'O-';
} else if ($peg['gol_darah'] == '8') {
	$goldar = 'AB-';
}
//nikah
if ($peg['stat_nikah'] == '1') {
	$stat = 'Sudah Menikah';
} else if ($peg['stat_nikah'] == '2') {
	$stat = 'Belum Menikah';
} else if ($peg['stat_nikah'] == '3') {
	$stat = 'Janda / Duda';
}
//stats
if ($peg['pegawai_status'] == '1') {
	$pgw = 'Aktif';
}
else if ($peg['pegawai_status'] == '0') {
	$pgw = 'Non-Aktif';
}

$header = '<p><font size="12" style="text-transform:uppercase"><b> '.$kep['nama_peru'].'</b></font>
			<br /><br />
			<font size="10" align="center"><u><b>BIODATA PEGAWAI</b></u><font></p>';
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);

$dpri ='<p><font size="10">I. DATA PRIBADI<font></p>';
$pdf->writeHTML($dpri, true, false, false, false, '');

$tblpri = '<table cellspacing="0" cellpadding="2" border="0">
    <tr>
		<td width="30">1.</td>
		<td width="150">NIP</td>
		<td width="360">: '.$peg['pegawai_nip'].'</td>';
		if (empty($peg['foto']))
						if ($peg['gender'] == "Laki-laki"){
							$tblpri .='<td rowspan="12" align="center" width="120"><img src="../../../assets/img/foto/no-foto-male.png" width="100" height="130"><br />Pas Foto</td>';
						}
						// else{
						// 	$tblpri .='<td rowspan="12" align="center" width="120"><img src="../../../assets/img/foto/no-foto-female.png" width="100" height="130"><br />Pas Foto</td>';
						//}
						// else
						// 	$tblpri .='<td rowspan="12" align="center" width="120"><img src="../../../assets/img/foto/'.$peg['foto'].'" width="100" height="130"><br />Pas Foto</td>';
	$tblpri .='</tr>
	
	<tr>
		<td width="30">2.</td>
		<td width="150">Nama</td>
		<td width="360">: '.$peg['pegawai_nama'].'</td>
	</tr>
	<tr>
		<td width="30">3.</td>
		<td width="150">Tempat, Tanggal Lahir</td>
		<td width="360">: '.$peg['tempat_lahir'].', '.$peg['tgl_lahir'].'</td>
	</tr>
	<tr>
		<td width="30">4.</td>
		<td width="150">Agama</td>
		<td width="360">: '.$agama.'</td>
	</tr>
	<tr>
		<td width="30">5.</td>
		<td width="150">Jenis Kelamin</td>
		<td width="360">: '.$gender.'</td>
	</tr>
	<tr>
		<td width="30">6.</td>
		<td width="150">Golongan Darah</td>
		<td width="360">: '.$goldar.'</td>
	</tr>
	<tr>
		<td width="30">7.</td>
		<td width="150">Status Pernikahan</td>
		<td width="360">: '.$stat.'</td>
	</tr>
	<tr>
		<td width="30">8.</td>
		<td width="150">Status Kepegawaian</td>
		<td width="360">: '.$pgw.'</td>
	</tr>
	<tr>
		<td width="30">9.</td>
		<td width="150">Alamat</td>
		<td width="360">: '.$peg['alamat'].'</td>
	</tr>
	<tr>
		<td width="30">10.</td>
		<td width="150">No. Telepon</td>
		<td width="360">: '.$peg['pegawai_telp'].'</td>
	</tr>
	
	<tr>
		<td width="30">12.</td>
		<td width="150">Unit Kerja</td>';
		$namaskpd=mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[pegawai_id]'");
		$nm=mysqli_fetch_array($namaskpd, MYSQLI_ASSOC);
		$tblpri .='<td>: '.$nm['nama'].'</td>
	</tr>
</table>';
$pdf->writeHTML($tblpri, true, false, false, false, '');

$dkel ='<p><font size="10">II. RIWAYAT KELUARGA<font></p>';
$pdf->writeHTML($dkel, true, false, false, false, '');

$tblkel ='<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<th width="30"><b>No.</b></th>
				<th width="170"><b>Nama</b></th>
				<th width="170"><b>Tempat, Tanggal Lahir</b></th>
				<th width="290"><b>Status</b></th>
			</tr>
			';
			$no=1;
			$tampilOrt	=mysqli_query($koneksi, "SELECT * FROM tb_ortu WHERE id_peg='$id_peg' ORDER BY status_hub DESC");
			while($ort=mysqli_fetch_array($tampilOrt, MYSQLI_ASSOC)) { 
				$tblkel .='<tr>
					<td width="30">'.$no++.'.</td>
					<td width="170">'.$ort['nama'].'</td>
					<td width="170">'.$ort['tmp_lhr'].', '.$ort['tgl_lhr'].'</td>
					<td width="290">'.$ort['status_hub'].'</td>
				</tr>';
			}
			$tampilSi	=mysqli_query($koneksi, "SELECT * FROM tb_suamiistri WHERE id_peg='$id_peg'");
			while($si=mysqli_fetch_array($tampilSi, MYSQLI_ASSOC)) { 
				$tblkel .='<tr>
					<td width="30">'.$no++.'.</td>
					<td width="170">'.$si['nama'].'</td>
					<td width="170">'.$si['tmp_lhr'].', '.$si['tgl_lhr'].'</td>
					<td width="290">'.$si['status_hub'].'</td>
				</tr>';
			} 
			$tampilAnk	=mysqli_query($koneksi, "SELECT * FROM tb_anak WHERE id_peg='$id_peg' ORDER BY tgl_lhr");
			while($ank=mysqli_fetch_array($tampilAnk, MYSQLI_ASSOC)) { 
				$tblkel .='<tr>
					<td width="30">'.$no++.'.</td>
					<td width="170">'.$ank['nama'].'</td>
					<td width="170">'.$ank['tmp_lhr'].', '.$ank['tgl_lhr'].'</td>
					<td width="290">'.$ank['status_hub'].'</td>
				</tr>';
			}
$tblkel .= '</table>';
$pdf->writeHTML($tblkel, true, false, false, false, '');

$dpen ='<p><font size="10">III. PENDIDIKAN<font></p>';
$pdf->writeHTML($dpen, true, false, false, false, '');

$tblpen ='<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<th width="30"><b>No.</b></th>
				<th width="50"><b>Tingkat</b></th>
				<th width="120"><b>Sekolah / Universitas</b></th>
				<th width="60"><b>Lokasi</b></th>
				<th width="110"><b>Jurusan</b></th>
				<th width="100"><b>No. Ijazah</b></th>
				<th width="60"><b>Tgl. Ijazah</b></th>
				<th width="130"><b>Kepala / Rektor</b></th>
			</tr>
			';
			$no=1;
			$tampilSek	=mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$id_peg' ORDER BY tgl_ijazah DESC");
			while($sek=mysqli_fetch_array($tampilSek, MYSQLI_ASSOC)) { 
				$tblpen .='<tr>
					<td width="30">'.$no++.'.</td>
					<td width="50">'.$sek['tingkat'].'</td>
					<td width="120">'.$sek['nama_sekolah'].'</td>
					<td width="60">'.$sek['lokasi'].'</td>
					<td width="110">'.$sek['jurusan'].'</td>
					<td width="100">'.$sek['no_ijazah'].'</td>
					<td width="60">'.$sek['tgl_ijazah'].'</td>
					<td width="130">'.$sek['kepala'].'</td>
				</tr>';
			} 
$tblpen .= '</table>';
$pdf->writeHTML($tblpen, true, false, false, false, '');

$dbhs ='<p><font size="10">IV. KECAKAPAN BAHASA<font></p>';
$pdf->writeHTML($dbhs, true, false, false, false, '');

$tblbhs ='<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<th width="30"><b>No.</b></th>
				<th width="170"><b>Jenis Bahasa</b></th>
				<th width="170"><b>Bahasa</b></th>
				<th width="290"><b>Kemampuan Bicara</b></th>
			</tr>
			';
			$no=1;
			$tampilBhs	=mysqli_query($koneksi, "SELECT * FROM tb_bahasa WHERE id_peg='$id_peg'");
			while($bhs=mysqli_fetch_array($tampilBhs, MYSQLI_ASSOC)) { 
				$tblbhs .='<tr>
					<td width="30">'.$no++.'.</td>
					<td width="170">'.$bhs['jns_bhs'].'</td>
					<td width="170">'.$bhs['bahasa'].'</td>
					<td width="290">'.$bhs['kemampuan'].'</td>
				</tr>';
			} 
$tblbhs .= '</table>';
$pdf->writeHTML($tblbhs, true, false, false, false, '');

$djab ='<p><font size="10">V. RIWAYAT JABATAN<font></p>';
$pdf->writeHTML($djab, true, false, false, false, '');

$tbljab ='<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<th width="30"><b>No.</b></th>
				<th width="230"><b>Jabatan</b></th>
				<th width="110"><b>TMT</b></th>
				<th width="110"><b>Selesai Tugas</b></th>
				<th width="180"><b>Status</b></th>
			</tr>
			';
			$no=1;
			$tampilJab	=mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$id_peg' ORDER BY tmt_jabatan DESC");
			while($jab=mysqli_fetch_array($tampilJab, MYSQLI_ASSOC)) { 
				$tbljab .='<tr>
					<td width="30">'.$no++.'.</td>
					<td width="230">'.$jab['jabatan'].'</td>
					<td width="110">'.$jab['tmt_jabatan'].'</td>
					<td width="110">'.$jab['sampai_tgl'].'</td>
					<td width="180">'.$jab['status_jab'].'</td>
				</tr>';
			} 
$tbljab .= '</table>';
$pdf->writeHTML($tbljab, true, false, false, false, '');

$dpan ='<p><font size="10">VI. RIWAYAT KEPANGKATAN<font></p>';
$pdf->writeHTML($dpan, true, false, false, false, '');

$tblpan ='<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<th width="30"><b>No.</b></th>
				
				
				<th width="180"><b>Status</b></th>
			</tr>
			';
			// $no=1;
			// $tampilPan	=mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$id_peg' ORDER BY tmt_pangkat DESC");
			// while($pan=mysqli_fetch_array($tampilPan, MYSQLI_ASSOC)) { 
			// 	$tblpan .='<tr>
			// 		<td width="30">'.$no++.'.</td>
			// 		<td width="230">'.$pan['pangkat'].'</td>
			// 		<td width="110">'.$pan['gol'].'</td>
			// 		<td width="110">'.$pan['tmt_pangkat'].'</td>
			// 		<td width="180">'.$pan['status_pan'].'</td>
			// 	</tr>';
			// } 
$tblpan .= '</table>';
$pdf->writeHTML($tblpan, true, false, false, false, '');

$dhar ='<p><font size="10">VII. RIWAYAT PENGHARGAAN<font></p>';
$pdf->writeHTML($dhar, true, false, false, false, '');

$tblhar ='<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<th width="30"><b>No.</b></th>
				<th width="230"><b>Nama Penghargaan</b></th>
				<th width="110"><b>Tahun</b></th>
				<th width="290"><b>Negara / Instansi Pemberi</b></th>
			</tr>
			';
			$no=1;
			$tampilHar	=mysqli_query($koneksi, "SELECT * FROM tb_penghargaan WHERE id_peg='$id_peg' ORDER BY tahun DESC");
			while($har=mysqli_fetch_array($tampilHar, MYSQLI_ASSOC)) { 
				$tblhar .='<tr>
					<td width="30">'.$no++.'.</td>
					<td width="230">'.$har['penghargaan'].'</td>
					<td width="110">'.$har['tahun'].'</td>
					<td width="290">'.$har['pemberi'].'</td>
				</tr>';
			} 
$tblhar .= '</table>';
$pdf->writeHTML($tblhar, true, false, false, false, '');

$dpln ='<p><font size="10">VIII. RIWAYAT PENUGASAN LUAR NEGERI<font></p>';
$pdf->writeHTML($dpln, true, false, false, false, '');

$tblpln ='<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<th width="30"><b>No.</b></th>
				<th width="170"><b>Negara Tujuan</b></th>
				<th width="60"><b>Tahun</b></th>
				<th width="110"><b>Lama Penugasan</b></th>
				<th width="290"><b>Alasan Penugasan</b></th>
			</tr>
			';
			$no=1;
			$tampilPln	=mysqli_query($koneksi, "SELECT * FROM tb_penugasan WHERE id_peg='$id_peg' ORDER BY tahun DESC");
			while($pln=mysqli_fetch_array($tampilPln, MYSQLI_ASSOC)) { 
				$tblpln .='<tr>
					<td width="30">'.$no++.'.</td>
					<td width="170">'.$pln['tujuan'].'</td>
					<td width="60">'.$pln['tahun'].'</td>
					<td width="110">'.$pln['lama'].' Hari</td>
					<td width="290">'.$pln['alasan'].'</td>
				</tr>';
			} 
$tblpln .= '</table>';
$pdf->writeHTML($tblpln, true, false, false, false, '');

$dhkm ='<p><font size="10">IX. RIWAYAT HUKUMAN<font></p>';
$pdf->writeHTML($dhkm, true, false, false, false, '');

$tblhkm ='<table cellspacing="0" cellpadding="2" border="0">
			<tr>
				<th width="30"><b>No.</b></th>
				<th width="170"><b>Jenis Hukuman</b></th>
				<th width="150"><b>No. SK</b></th>
				<th width="100"><b>Tanggal SK</b></th>
				<th width="110"><b>No. Pemulihan</b></th>
				<th width="100"><b>Tanggal Pemulihan</b></th>
			</tr>
			';
			$no=1;
			$tampilHkm	=mysqli_query($koneksi, "SELECT * FROM tb_hukuman WHERE id_peg='$id_peg' ORDER BY tgl_sk DESC");
			while($hkm=mysqli_fetch_array($tampilHkm, MYSQLI_ASSOC)) { 
				$tblhkm .='<tr>
					<td width="30">'.$no++.'.</td>
					<td width="170">'.$hkm['hukuman'].'</td>
					<td width="150">'.$hkm['no_sk'].'</td>
					<td width="100">'.$hkm['tgl_sk'].'</td>
					<td width="110">'.$hkm['no_pulih'].'</td>
					<td width="100">'.$hkm['tgl_pulih'].'</td>
				</tr>';
			} 
$tblhkm .= '</table><br /><br /><br />';
$pdf->writeHTML($tblhkm, true, false, false, false, '');

$signa = '<table cellpadding="1" border="0" align="center">
			<tr>
				<td width="300"></td>
				<td width="60"></td>
				<td width="300">'.$kep['nama_peru'].', '.date("j F Y").'</td>
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
				<td><font size="9" style="text-transform:uppercase;font-weight:bold;">KABUPATEN '.$kep['nama_peru'].'</font></td>
			</tr>
			<tr>
				<td height="60"></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>'.$nama['pegawai_nama'].'</b></font></td>
			</tr>
			
			<tr>
				<td></td>
				<td></td>
				<td align="center"><font size="9"><b>NIP. '.$nama['pegawai_nip'].'</b></font></td>
			</tr>
		</table>';
$pdf->writeHTML($signa, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('Biodata_Pegawai_'.$peg['pegawai_nip'].'.pdf', 'I');
?>