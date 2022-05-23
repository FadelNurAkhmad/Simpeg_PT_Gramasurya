<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_tunjangan'])) {
	$id_tunjangan = $_GET['id_tunjangan'];
	
	$query   =mysql_query("SELECT * FROM tb_tunjangan WHERE id_tunjangan='$id_tunjangan'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_tunjangan) && $id_tunjangan != "") {
		$delete	=mysql_query("DELETE FROM tb_tunjangan WHERE id_tunjangan='$id_tunjangan'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete tunjangan success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>