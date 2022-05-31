<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_si'])) {
	$id_si = $_GET['id_si'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_suamiistri WHERE id_si='$id_si'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_si) && $id_si != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_suamiistri WHERE id_si='$id_si'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete suami istri success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
?>
</div>