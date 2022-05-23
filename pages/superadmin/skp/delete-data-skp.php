<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_skp'])) {
	$id_skp = $_GET['id_skp'];
	
	$query   =mysql_query("SELECT * FROM tb_skp WHERE id_skp='$id_skp'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_skp) && $id_skp != "") {
		$delete	=mysql_query("DELETE FROM tb_skp WHERE id_skp='$id_skp'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete SKP success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>