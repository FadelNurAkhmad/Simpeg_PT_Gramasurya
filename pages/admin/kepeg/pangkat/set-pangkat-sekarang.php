<div class="row">
<?php
	if (isset($_GET['id_pangkat']) AND ($_GET['gol']) AND ($_GET['id_peg'])) {
		$id_pangkat = $_GET['id_pangkat'];
		$gol		= $_GET['gol'];
		$pangkat	= $_GET['pangkat'];
		$id_peg = $_GET['id_peg'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tP=mysql_query("SElECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
	$jkP=mysql_fetch_array($tP);
	$jk=$jkP['jk'];
		
	$update1= mysql_query ("UPDATE tb_pangkat SET status_pan='' WHERE id_peg='$id_peg'");
	$update2= mysql_query ("UPDATE tb_pangkat SET status_pan='Aktif', jk_pan='$jk' WHERE id_pangkat='$id_pangkat'");
	$update3= mysql_query ("UPDATE tb_pegawai SET urut_pangkat='$gol', pangkat='$pangkat' WHERE id_peg='$id_peg'");
		if($update1){
			$_SESSION['pesan'] = "Good! setup pangkat sekarang success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
?>
</div>