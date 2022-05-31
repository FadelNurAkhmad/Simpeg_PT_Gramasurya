<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_anak'])) {
	$id_anak = $_GET['id_anak'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_anak WHERE id_anak='$id_anak'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_anak) && $id_anak != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_anak WHERE id_anak='$id_anak'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete anak success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>