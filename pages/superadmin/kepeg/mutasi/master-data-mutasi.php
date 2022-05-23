<div class="row">
<?php
	if (isset($_GET['id_mutasi'])) {
	$id_mutasi = $_GET['id_mutasi'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg		=$_POST['id_peg'];
	$jns_mutasi	=$_POST['jns_mutasi'];
	$tgl_mutasi	=$_POST['tgl_mutasi'];
	$no_mutasi	=$_POST['no_mutasi'];
	
	include "../../config/koneksi.php";
	$tP=mysql_query("SElECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
	$gp=mysql_fetch_array($tP);
	$gol		=$gp['gol'];
	$pangkat	=$gp['pangkat'];
	
	$tJ=mysql_query("SElECT * FROM tb_jabatan WHERE id_peg='$id_peg' AND status_jab='Aktif'");
	$esl=mysql_fetch_array($tJ);
	$eselon		=$esl['eselon'];
	
		if (empty($_POST['id_peg']) || empty($_POST['jns_mutasi']) || empty($_POST['tgl_mutasi']) || empty($_POST['no_mutasi'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-mutasi");
		}
		
		else{
		$insert = "INSERT INTO tb_mutasi (id_mutasi, id_peg, jns_mutasi, tgl_mutasi, no_mutasi, gol, pangkat, eselon) VALUES ('$id_mutasi', '$id_peg', '$jns_mutasi', '$tgl_mutasi', '$no_mutasi', '$gol', '$pangkat', '$eselon')";
		$query = mysql_query ($insert);
		
		if (($_POST['jns_mutasi'] =="Pensiun") || ($_POST['jns_mutasi'] =="Pindah Antar Instansi") || ($_POST['jns_mutasi'] =="Keluar") || ($_POST['jns_mutasi'] =="Wafat")) {
			$status_mut= mysql_query ("UPDATE tb_pegawai SET status_mut='$jns_mutasi' WHERE id_peg='$id_peg'");
		}
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data mutasi success ...";
			header("location:index.php?page=form-master-data-mutasi");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>