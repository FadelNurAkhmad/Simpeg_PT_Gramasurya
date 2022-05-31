<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_jab'])) {
	$id_jab = $_GET['id_jab'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_jab='$id_jab'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_jab) && $id_jab != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_jabatan WHERE id_jab='$id_jab'");
		$updatejab= mysqli_query ($koneksi, "UPDATE tb_pegawai SET jabatan='' WHERE id_peg='$id_peg'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete jabatan success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
?>
</div>