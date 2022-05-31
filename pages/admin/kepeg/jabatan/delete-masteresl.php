<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_masteresl'])) {
	$id_masteresl = $_GET['id_masteresl'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_masteresl WHERE id_masteresl='$id_masteresl'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_masteresl) && $id_masteresl != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_masteresl WHERE id_masteresl='$id_masteresl'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete nama eselon success ...";
			header("location:index.php?page=form-master-data-jabatan");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>