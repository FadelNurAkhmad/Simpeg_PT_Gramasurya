<div class="row">
<?php
	if (isset($_GET['id_hukuman'])) {
	$id_hukuman = $_GET['id_hukuman'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg			=$_POST['id_peg'];
	$hukuman		=$_POST['hukuman'];
	$pejabat_sk		=$_POST['pejabat_sk'];
	$no_sk			=$_POST['no_sk'];
	$tgl_sk			=$_POST['tgl_sk'];
	$pejabat_pulih	=$_POST['pejabat_pulih'];
	$no_pulih		=$_POST['no_pulih'];
	$tgl_pulih		=$_POST['tgl_pulih'];
	
	include "../../config/koneksi.php";
	$tP=mysql_query("SElECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
	$gp=mysql_fetch_array($tP);
	$gol		=$gp['gol'];
	$pangkat	=$gp['pangkat'];
	
	$tJ=mysql_query("SElECT * FROM tb_jabatan WHERE id_peg='$id_peg' AND status_jab='Aktif'");
	$esl=mysql_fetch_array($tJ);
	$eselon		=$esl['eselon'];
	
		if (empty($_POST['id_peg']) || empty($_POST['hukuman']) || empty($_POST['pejabat_sk']) || empty($_POST['no_sk']) || empty($_POST['tgl_sk'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-hukuman");
		}
		
		else{
		$insert = "INSERT INTO tb_hukuman (id_hukuman, id_peg, hukuman, pejabat_sk, no_sk, tgl_sk, pejabat_pulih, no_pulih, tgl_pulih, gol, pangkat, eselon) VALUES ('$id_hukuman', '$id_peg', '$hukuman', '$pejabat_sk', '$no_sk', '$tgl_sk', '$pejabat_pulih', '$no_pulih', '$tgl_pulih', '$gol', '$pangkat', '$eselon')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data hukuman success ...";
			header("location:index.php?page=form-master-data-hukuman");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>