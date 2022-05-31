<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_kawin'])) {
	$id_kawin = $_GET['id_kawin'];
	
	$query   =mysqli_query($koneksi,"SELECT * FROM tb_kawin WHERE id_kawin='$id_kawin'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_kawin) && $id_kawin != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_kawin WHERE id_kawin='$id_kawin'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete izin kawin success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>