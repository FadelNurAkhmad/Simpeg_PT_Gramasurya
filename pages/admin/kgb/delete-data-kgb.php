<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_spkgb'])) {
	$id_spkgb = $_GET['id_spkgb'];
	
	$query   =mysql_query("SELECT * FROM tb_spkgb WHERE id_spkgb='$id_spkgb'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_spkgb) && $id_spkgb != "") {
		$delete	=mysql_query("DELETE FROM tb_spkgb WHERE id_spkgb='$id_spkgb'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete KGB success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>