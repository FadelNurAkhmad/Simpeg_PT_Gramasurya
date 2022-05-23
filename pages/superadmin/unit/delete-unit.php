<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_unit'])) {
	$id_unit = $_GET['id_unit'];
	
	$query   =mysql_query("SELECT * FROM tb_unit WHERE id_unit='$id_unit'");
	$data    =mysql_fetch_array($query);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_unit) && $id_unit != "") {
		$delete		=mysql_query("DELETE FROM tb_unit WHERE id_unit='$id_unit'");
			if($delete){
				$_SESSION['pesan'] = "Good! Delete Unit Kerja success ...";
				header("location:index.php?page=form-view-data-unit");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
	}
	mysql_close($Open);
?>
</div>