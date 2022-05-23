<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_masteresl'])) {
	$id_masteresl = $_GET['id_masteresl'];
	
	$query   =mysql_query("SELECT * FROM tb_masteresl WHERE id_masteresl='$id_masteresl'");
	$data    =mysql_fetch_array($query);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_masteresl) && $id_masteresl != "") {
		$delete	=mysql_query("DELETE FROM tb_masteresl WHERE id_masteresl='$id_masteresl'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete nama eselon success ...";
			header("location:index.php?page=form-master-data-jabatan");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>