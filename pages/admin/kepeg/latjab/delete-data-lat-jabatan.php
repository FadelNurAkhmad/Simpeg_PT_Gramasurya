<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_lat_jabatan'])) {
	$id_lat_jabatan = $_GET['id_lat_jabatan'];
	
	$query   =mysql_query("SELECT * FROM tb_lat_jabatan WHERE id_lat_jabatan='$id_lat_jabatan'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_lat_jabatan) && $id_lat_jabatan != "") {
		$delete	=mysql_query("DELETE FROM tb_lat_jabatan WHERE id_lat_jabatan='$id_lat_jabatan'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete lat jabatan success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>