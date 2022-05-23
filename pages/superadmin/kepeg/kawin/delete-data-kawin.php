<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_kawin'])) {
	$id_kawin = $_GET['id_kawin'];
	
	$query   =mysql_query("SELECT * FROM tb_kawin WHERE id_kawin='$id_kawin'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_kawin) && $id_kawin != "") {
		$delete	=mysql_query("DELETE FROM tb_kawin WHERE id_kawin='$id_kawin'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete izin kawin success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>