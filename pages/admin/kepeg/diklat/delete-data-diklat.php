<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_diklat'])) {
	$id_diklat = $_GET['id_diklat'];
	
	$query   =mysql_query("SELECT * FROM tb_diklat WHERE id_diklat='$id_diklat'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_diklat) && $id_diklat != "") {
		$delete	=mysql_query("DELETE FROM tb_diklat WHERE id_diklat='$id_diklat'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete diklat success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>