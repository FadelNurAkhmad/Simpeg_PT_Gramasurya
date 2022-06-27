<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_pangkat'])) {
	$id_pangkat = $_GET['id_pangkat'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_pangkat='$id_pangkat'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_pangkat) && $id_pangkat != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_pangkat WHERE id_pangkat='$id_pangkat'");	
		$updatepan= mysqli_query ($koneksi, "UPDATE tb_pegawai SET urut_pangkat='', pangkat='' WHERE id_peg='$id_peg'");
		
		if($delete){
			$_SESSION['pesan'] = "Good! delete pangkat success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
?>
</div>