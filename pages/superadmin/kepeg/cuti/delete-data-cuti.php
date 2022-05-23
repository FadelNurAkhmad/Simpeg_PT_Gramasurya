<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_cuti'])) {
	$id_cuti = $_GET['id_cuti'];
	
	$query   =mysql_query("SELECT * FROM tb_cuti WHERE id_cuti='$id_cuti'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_cuti) && $id_cuti != "") {
		$delete	=mysql_query("DELETE FROM tb_cuti WHERE id_cuti='$id_cuti'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete cuti success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>