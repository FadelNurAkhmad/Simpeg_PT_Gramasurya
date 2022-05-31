<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_skp'])) {
	$id_skp = $_GET['id_skp'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_skp WHERE id_skp='$id_skp'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_skp) && $id_skp != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_skp WHERE id_skp='$id_skp'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete SKP success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
?>
</div>