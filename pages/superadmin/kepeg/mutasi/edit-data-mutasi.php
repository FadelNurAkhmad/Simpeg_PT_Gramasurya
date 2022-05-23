<div class="row">
<?php
	if (isset($_GET['id_mutasi'])) {
	$id_mutasi = $_GET['id_mutasi'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilMut	= mysql_query("SELECT * FROM tb_mutasi WHERE id_mutasi='$id_mutasi'");
	$hasil	= mysql_fetch_array ($tampilMut);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$jns_mutasi	=$_POST['jns_mutasi'];
	$tgl_mutasi	=$_POST['tgl_mutasi'];
	$no_mutasi	=$_POST['no_mutasi'];
	
	$tP=mysql_query("SElECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
	$gp=mysql_fetch_array($tP);
	$gol		=$gp['gol'];
	$pangkat	=$gp['pangkat'];
	
	$tJ=mysql_query("SElECT * FROM tb_jabatan WHERE id_peg='$id_peg' AND status_jab='Aktif'");
	$esl=mysql_fetch_array($tJ);
	$eselon		=$esl['eselon'];
	
		if (empty($_POST['jns_mutasi']) || empty($_POST['tgl_mutasi']) || empty($_POST['no_mutasi'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-mutasi&id_mutasi=$id_mutasi");
		}	
		
		else{
		$emp_status= mysql_query ("UPDATE tb_pegawai SET status_mut='' WHERE id_peg='$id_peg'");
		
		$update= mysql_query ("UPDATE tb_mutasi SET jns_mutasi='$jns_mutasi', tgl_mutasi='$tgl_mutasi', no_mutasi='$no_mutasi', gol='$gol', pangkat='$pangkat', eselon='$eselon' WHERE id_mutasi='$id_mutasi'");
		
		if (($_POST['jns_mutasi'] =="Pensiun") || ($_POST['jns_mutasi'] =="Pindah Antar Instansi") || ($_POST['jns_mutasi'] =="Keluar") || ($_POST['jns_mutasi'] =="Wafat")) {
			$status_mut= mysql_query ("UPDATE tb_pegawai SET status_mut='$jns_mutasi' WHERE id_peg='$id_peg'");
		}
		
		if($update){
				$_SESSION['pesan'] = "Good! edit data mutasi success ...";
				header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>