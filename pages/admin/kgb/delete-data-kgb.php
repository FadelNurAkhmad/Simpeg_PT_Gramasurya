<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_spkgb'])) {
	$id_spkgb = $_GET['id_spkgb'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_spkgb WHERE id_spkgb='$id_spkgb'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_spkgb) && $id_spkgb != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_spkgb WHERE id_spkgb='$id_spkgb'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete KGB success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>