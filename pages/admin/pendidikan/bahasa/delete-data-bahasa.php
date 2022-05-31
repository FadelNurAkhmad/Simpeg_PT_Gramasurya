<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_bhs'])) {
	$id_bhs = $_GET['id_bhs'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_bahasa WHERE id_bhs='$id_bhs'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_bhs) && $id_bhs != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_bahasa WHERE id_bhs='$id_bhs'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete bahasa success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>