<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_masterjab'])) {
	$id_masterjab = $_GET['id_masterjab'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_masterjab WHERE id_masterjab='$id_masterjab'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_masterjab) && $id_masterjab != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_masterjab WHERE id_masterjab='$id_masterjab'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete nama jabatan success ...";
			header("location:index.php?page=form-master-data-jabatan");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
?>
</div>