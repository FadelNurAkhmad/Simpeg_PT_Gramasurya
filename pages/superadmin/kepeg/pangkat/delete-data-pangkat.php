<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_pangkat'])) {
	$id_pangkat = $_GET['id_pangkat'];
	
	$query   =mysql_query("SELECT * FROM tb_pangkat WHERE id_pangkat='$id_pangkat'");
	$data    =mysql_fetch_array($query);
		$id_peg	=$data['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_pangkat) && $id_pangkat != "") {
		$delete	=mysql_query("DELETE FROM tb_pangkat WHERE id_pangkat='$id_pangkat'");	
		$updatepan= mysql_query ("UPDATE tb_pegawai SET urut_pangkat='', pangkat='' WHERE id_peg='$id_peg'");
		
		if($delete){
			$_SESSION['pesan'] = "Good! delete pangkat success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>