<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_seminar'])) {
	$id_seminar = $_GET['id_seminar'];
	
	$query   =mysql_query("SELECT * FROM tb_seminar WHERE id_seminar='$id_seminar'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_seminar) && $id_seminar != "") {
		$delete	=mysql_query("DELETE FROM tb_seminar WHERE id_seminar='$id_seminar'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete seminar success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>