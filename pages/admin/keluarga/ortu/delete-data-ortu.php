<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_ortu'])) {
	$id_ortu = $_GET['id_ortu'];
	
	$query   =mysql_query("SELECT * FROM tb_ortu WHERE id_ortu='$id_ortu'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_ortu) && $id_ortu != "") {
		$delete	=mysql_query("DELETE FROM tb_ortu WHERE id_ortu='$id_ortu'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete orang tua success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>