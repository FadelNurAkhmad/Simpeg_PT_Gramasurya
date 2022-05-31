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
	$tP=mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
	$gp=mysqli_fetch_array($tP, MYSQLI_ASSOC);
	$gol		=$gp['gol'];
	$pangkat	=$gp['pangkat'];
	
	$tJ=mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$id_peg' AND status_jab='Aktif'");
	$esl=mysqli_fetch_array($tJ, MYSQLI_ASSOC);
	$eselon		=$esl['eselon'];
	
	$tS=mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_sekolah='$id_sekolah'");
	$sek=mysqli_fetch_array($tS, MYSQLI_ASSOC);
	$tingkat	=$sek['tingkat'];
		
	$update1= mysqli_query ($koneksi, "UPDATE tb_sekolah SET status='' WHERE id_peg='$id_peg'");
	$update2= mysqli_query ($koneksi, "UPDATE tb_sekolah SET status='Akhir', gol='$gol', pangkat='$pangkat', eselon='$eselon' WHERE id_sekolah='$id_sekolah'");
	$update3= mysqli_query ($koneksi, "UPDATE tb_pegawai SET sekolah='$tingkat' WHERE id_peg='$id_peg'");		
		if($update1){
			$_SESSION['pesan'] = "Good! setup pendidikan akhir success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
?>
</div>