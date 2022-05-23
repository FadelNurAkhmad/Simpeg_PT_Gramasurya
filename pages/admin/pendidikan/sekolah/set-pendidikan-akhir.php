<div class="row">
<?php
	if (isset($_GET['id_sekolah']) AND ($_GET['id_peg'])) {
		$id_sekolah	= $_GET['id_sekolah'];
		$id_peg 	= $_GET['id_peg'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tP=mysql_query("SElECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
	$gp=mysql_fetch_array($tP);
	$gol		=$gp['gol'];
	$pangkat	=$gp['pangkat'];
	
	$tJ=mysql_query("SElECT * FROM tb_jabatan WHERE id_peg='$id_peg' AND status_jab='Aktif'");
	$esl=mysql_fetch_array($tJ);
	$eselon		=$esl['eselon'];
	
	$tS=mysql_query("SElECT * FROM tb_sekolah WHERE id_sekolah='$id_sekolah'");
	$sek=mysql_fetch_array($tS);
	$tingkat	=$sek['tingkat'];
		
	$update1= mysql_query ("UPDATE tb_sekolah SET status='' WHERE id_peg='$id_peg'");
	$update2= mysql_query ("UPDATE tb_sekolah SET status='Akhir', gol='$gol', pangkat='$pangkat', eselon='$eselon' WHERE id_sekolah='$id_sekolah'");
	$update3= mysql_query ("UPDATE tb_pegawai SET sekolah='$tingkat' WHERE id_peg='$id_peg'");		
		if($update1){
			$_SESSION['pesan'] = "Good! setup pendidikan akhir success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
?>
</div>