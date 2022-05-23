<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_masterjab'])) {
	$id_masterjab = $_GET['id_masterjab'];
	
	$query   =mysql_query("SELECT * FROM tb_masterjab WHERE id_masterjab='$id_masterjab'");
	$data    =mysql_fetch_array($query);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_masterjab) && $id_masterjab != "") {
		$delete	=mysql_query("DELETE FROM tb_masterjab WHERE id_masterjab='$id_masterjab'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete nama jabatan success ...";
			header("location:index.php?page=form-master-data-jabatan");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>