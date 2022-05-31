<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_mastergol'])) {
	$id_mastergol = $_GET['id_mastergol'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_mastergol WHERE id_mastergol='$id_mastergol'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_mastergol) && $id_mastergol != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_mastergol WHERE id_mastergol='$id_mastergol'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete nama golongan success ...";
			header("location:index.php?page=form-master-data-pangkat");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
?>
</div>