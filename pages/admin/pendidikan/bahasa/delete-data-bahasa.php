<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_bhs'])) {
	$id_bhs = $_GET['id_bhs'];
	
	$query   =mysql_query("SELECT * FROM tb_bahasa WHERE id_bhs='$id_bhs'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_bhs) && $id_bhs != "") {
		$delete	=mysql_query("DELETE FROM tb_bahasa WHERE id_bhs='$id_bhs'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete bahasa success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>