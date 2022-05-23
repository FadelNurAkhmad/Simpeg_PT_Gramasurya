<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_mastergol'])) {
	$id_mastergol = $_GET['id_mastergol'];
	
	$query   =mysql_query("SELECT * FROM tb_mastergol WHERE id_mastergol='$id_mastergol'");
	$data    =mysql_fetch_array($query);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_mastergol) && $id_mastergol != "") {
		$delete	=mysql_query("DELETE FROM tb_mastergol WHERE id_mastergol='$id_mastergol'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete nama golongan success ...";
			header("location:index.php?page=form-master-data-pangkat");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>