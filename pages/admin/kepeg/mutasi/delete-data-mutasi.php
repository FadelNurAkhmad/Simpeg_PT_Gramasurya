<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_mutasi'])) {
	$id_mutasi = $_GET['id_mutasi'];
	
	$query   =mysql_query("SELECT * FROM tb_mutasi WHERE id_mutasi='$id_mutasi'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_mutasi) && $id_mutasi != "") {
		$delete	=mysql_query("DELETE FROM tb_mutasi WHERE id_mutasi='$id_mutasi'");		
		if($delete){
			$emp_status= mysql_query ("UPDATE tb_pegawai SET status_mut='' WHERE id_peg='$id_peg'");
			
			$_SESSION['pesan'] = "Good! delete mutasi success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>