<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_penghargaan'])) {
	$id_penghargaan = $_GET['id_penghargaan'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_penghargaan WHERE id_penghargaan='$id_penghargaan'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_penghargaan) && $id_penghargaan != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_penghargaan WHERE id_penghargaan='$id_penghargaan'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete penghargaan success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
?>
</div>