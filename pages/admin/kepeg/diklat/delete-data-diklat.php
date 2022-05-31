<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_diklat'])) {
	$id_diklat = $_GET['id_diklat'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_diklat WHERE id_diklat='$id_diklat'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_diklat) && $id_diklat != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_diklat WHERE id_diklat='$id_diklat'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete diklat success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>