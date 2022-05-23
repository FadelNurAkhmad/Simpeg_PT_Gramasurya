<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_jab'])) {
	$id_jab = $_GET['id_jab'];
	
	$query   =mysql_query("SELECT * FROM tb_jabatan WHERE id_jab='$id_jab'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_jab) && $id_jab != "") {
		$delete	=mysql_query("DELETE FROM tb_jabatan WHERE id_jab='$id_jab'");
		$updatejab= mysql_query ("UPDATE tb_pegawai SET jabatan='' WHERE id_peg='$id_peg'");		
		if($delete){
			$_SESSION['pesan'] = "Good! delete jabatan success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>