<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_sekolah'])) {
	$id_sekolah = $_GET['id_sekolah'];
	
	$query   =mysql_query("SELECT * FROM tb_sekolah WHERE id_sekolah='$id_sekolah'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_sekolah) && $id_sekolah != "") {
		$delete	=mysql_query("DELETE FROM tb_sekolah WHERE id_sekolah='$id_sekolah'");
		$updatesek= mysql_query ("UPDATE tb_pegawai SET sekolah='' WHERE id_peg='$id_peg'");
		
		if($delete){
			$_SESSION['pesan'] = "Good! delete sekolah success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>