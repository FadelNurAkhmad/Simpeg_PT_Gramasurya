<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['pembagian1_id'])) {
	$pembagian1_id = $_GET['pembagian1_id'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$pembagian1_id'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($pembagian1_id) && $pembagian1_id != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM pembagian1 WHERE pembagian1_id='$pembagian1_id'");		
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