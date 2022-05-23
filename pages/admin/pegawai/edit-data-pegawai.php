<div class="row">
<?php
	if (isset($_GET['id_peg'])) {
	$id_peg = $_GET['id_peg'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilPro	= mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
	$hasil	= mysql_fetch_array ($tampilPro);
		$notnip	=$hasil['nip'];
				
	if ($_POST['edit'] == "edit") {
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
	
	$pensiun = new DateTime($tgl_lhr);
	$pensiun->modify('+58 year');
	$pensiun->format('Y-m-d');
	$tgl_pensiun=$pensiun->format('Y-m-d');
	
	$ceknip	=mysql_num_rows (mysql_query("SELECT nip FROM tb_pegawai WHERE nip='$_POST[nip]' AND nip!='$notnip'"));
	
		if (empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['tempat_lhr']) || empty($_POST['tgl_lhr']) || empty($_POST['agama']) || empty($_POST['jk']) || empty($_POST['gol_darah']) || empty($_POST['status_nikah']) || empty($_POST['status_kepeg']) || empty($_POST['tgl_naikpangkat']) || empty($_POST['tgl_naikgaji'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-pegawai&id_peg=$id_peg");
		}		
		else if($ceknip > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-data-pegawai&id_peg=$id_peg");
		}
		else{
		$update= mysql_query ("UPDATE tb_pegawai SET nip='$nip', nama='$nama', tempat_lhr='$tempat_lhr', tgl_lhr='$tgl_lhr', agama='$agama', jk='$jk', gol_darah='$gol_darah', status_nikah='$status_nikah', status_kepeg='$status_kepeg', tgl_naikpangkat='$tgl_naikpangkat', tgl_naikgaji='$tgl_naikgaji', alamat='$alamat', telp='$telp', email='$email', tgl_pensiun='$tgl_pensiun', unit_kerja='$id_unit' WHERE id_peg='$id_peg'");
		
		$updateusr= mysql_query ("UPDATE tb_user SET id_user='$nip', nama_user='$nama' WHERE id_peg='$id_peg'");
		
		// kgb //
		$delkgb	=mysql_query("DELETE FROM tb_kgb WHERE id_peg='$id_peg'");
		$beging = new DateTime($tgl_naikgaji);
		$endg = new DateTime($tgl_pensiun);
			for($ig = $beging; $beging <= $endg; $ig->modify('+2 year')){	
				$ig->format("Y-m-d");
				$tgl_kgb=$ig->format("Y-m-d");
				
				$values="($id_peg, '$tgl_kgb')";
		$insertkgb	=mysql_query("INSERT INTO tb_kgb (id_peg, tgl_kgb) VALUES ".$values);
		}
		
		// kpb //
		$delkpb = mysql_query("DELETE FROM tb_kpb WHERE id_peg='$id_peg'");
		$beginp = new DateTime($tgl_naikpangkat);
		$endp = new DateTime($tgl_pensiun);
			for($ip = $beginp; $beginp <= $endp; $ip->modify('+4 year')){	
				$ip->format("Y-m-d");
				$tgl_kpb=$ip->format("Y-m-d");
				
				$valuesp="($id_peg, '$tgl_kpb')";
		$insertkpb	=mysql_query("INSERT INTO tb_kpb (id_peg, tgl_kpb) VALUES ".$valuesp);
		}
		
		if($update){
				$_SESSION['pesan'] = "Good! Edit pegawai $hasil[nip] success ...";
				header("location:index.php?page=form-view-data-pegawai");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>