<div class="row">
<?php
	if (isset($_GET['id_peg'])) {
	$id_peg = $_GET['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$nip			=$_POST['nip'];
	$nama			=$_POST['nama'];
	$tempat_lhr		=$_POST['tempat_lhr'];
	$tgl_lhr		=$_POST['tgl_lhr'];
	$agama			=$_POST['agama'];
	$jk				=$_POST['jk'];	
	$gol_darah		=$_POST['gol_darah'];
	$status_nikah	=$_POST['status_nikah'];	
	$status_kepeg	=$_POST['status_kepeg'];	
	$tgl_naikpangkat=$_POST['tgl_naikpangkat'];	
	$tgl_naikgaji	=$_POST['tgl_naikgaji'];	
	$alamat			=$_POST['alamat'];
	$telp			=$_POST['telp'];
	$email			=$_POST['email'];
	$id_unit		=$_POST['id_unit'];
	$foto			=$_FILES['foto']['name'];
	
	$password	=md5("123");
	$date_reg	=date("Ymd");
	
	$pensiun = new DateTime($tgl_lhr);
	$pensiun->modify('+58 year');
	$pensiun->format('Y-m-d');
	$tgl_pensiun=$pensiun->format('Y-m-d');
	
	include "../../config/koneksi.php";
	$ceknip	=mysql_num_rows (mysql_query("SELECT nip FROM tb_pegawai WHERE nip='$_POST[nip]'"));
	
		if (empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['tempat_lhr']) || empty($_POST['tgl_lhr']) || empty($_POST['agama']) || empty($_POST['jk']) || empty($_POST['gol_darah']) || empty($_POST['status_nikah']) || empty($_POST['status_kepeg']) || empty($_POST['tgl_naikpangkat']) || empty($_POST['tgl_naikgaji'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-pegawai");
		}
		else if($ceknip > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-pegawai");
		}
		
		else{
		$insert = "INSERT INTO tb_pegawai (id_peg, nip, nama, tempat_lhr, tgl_lhr, agama, jk, gol_darah, status_nikah, status_kepeg, tgl_naikpangkat, tgl_naikgaji, alamat, telp, email, unit_kerja, foto, tgl_pensiun, date_reg) VALUES ('$id_peg', '$nip', '$nama', '$tempat_lhr', '$tgl_lhr', '$agama', '$jk', '$gol_darah', '$status_nikah', '$status_kepeg', '$tgl_naikpangkat', '$tgl_naikgaji', '$alamat', '$telp', '$email', '$id_unit', '$foto', '$tgl_pensiun', '$date_reg')";
		$query = mysql_query ($insert);
		
		$insertusr = mysql_query("INSERT INTO tb_user (id_user, nama_user, password, hak_akses, id_peg) VALUES ('$nip', '$nama', '$password', 'Pegawai', '$id_peg')");
		
		// kgb //
		$beging = new DateTime($tgl_naikgaji);
		$endg = new DateTime($tgl_pensiun);
			for($ig = $beging; $beging <= $endg; $ig->modify('+2 year')){	
				$ig->format("Y-m-d");
				$tgl_kgb=$ig->format("Y-m-d");
				
				$values="($id_peg, '$tgl_kgb')";
		$insertkgb	=mysql_query("INSERT INTO tb_kgb (id_peg, tgl_kgb) VALUES ".$values);
		}
		
		// kpb //
		$beginp = new DateTime($tgl_naikpangkat);
		$endp = new DateTime($tgl_pensiun);
			for($ip = $beginp; $beginp <= $endp; $ip->modify('+4 year')){	
				$ip->format("Y-m-d");
				$tgl_kpb=$ip->format("Y-m-d");
				
				$valuesp="($id_peg, '$tgl_kpb')";
		$insertkpb	=mysql_query("INSERT INTO tb_kpb (id_peg, tgl_kpb) VALUES ".$valuesp);
		}
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert master pegawai success ...";
			header("location:index.php?page=form-view-data-pegawai");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
			if (strlen($foto)>0) {
				if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
					move_uploaded_file ($_FILES['foto']['tmp_name'], "../../assets/img/foto/".$foto);
				}
			}
		}
	}
?>
</div>