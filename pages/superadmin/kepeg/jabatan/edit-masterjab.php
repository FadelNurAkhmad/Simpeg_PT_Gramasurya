<div class="row">
<?php
	if (isset($_GET['id_masterjab'])) {
	$id_masterjab = $_GET['id_masterjab'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilMJ	= mysql_query("SELECT * FROM tb_masterjab WHERE id_masterjab='$id_masterjab'");
	$hasil	= mysql_fetch_array ($tampilMJ);
				
	if ($_POST['edit'] == "edit") {
	$nama_masterjab	=$_POST['nama_masterjab'];
	
	$cekname	=mysql_num_rows (mysql_query("SELECT nama_masterjab FROM tb_masterjab WHERE nama_masterjab='$_POST[nama_masterjab]'"));
	
		if (empty($_POST['nama_masterjab'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-masterjab&id_masterjab=$id_masterjab");
		}		
		else if($cekname > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-masterjab&id_masterjab=$id_masterjab");
		}
		else{
		$update= mysql_query ("UPDATE tb_masterjab SET nama_masterjab='$nama_masterjab' WHERE id_masterjab='$id_masterjab'");
			if($update){
				$_SESSION['pesan'] = "Good! edit nama jabatan success ...";
				header("location:index.php?page=form-master-data-jabatan");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>