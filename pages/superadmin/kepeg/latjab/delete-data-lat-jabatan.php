<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_lat_jabatan'])) {
	$id_lat_jabatan = $_GET['id_lat_jabatan'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_lat_jabatan WHERE id_lat_jabatan='$id_lat_jabatan'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_lat_jabatan) && $id_lat_jabatan != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_lat_jabatan WHERE id_lat_jabatan='$id_lat_jabatan'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete lat jabatan success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
?>
</div>