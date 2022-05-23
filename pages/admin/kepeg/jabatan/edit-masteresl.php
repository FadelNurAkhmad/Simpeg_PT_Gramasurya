<div class="row">
<?php
	if (isset($_GET['id_masteresl'])) {
	$id_masteresl = $_GET['id_masteresl'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilME	= mysql_query("SELECT * FROM tb_masteresl WHERE id_masteresl='$id_masteresl'");
	$hasil	= mysql_fetch_array ($tampilME);
				
	if ($_POST['edit'] == "edit") {
	$nama_masteresl	=$_POST['nama_masteresl'];
	
	$cekname	=mysql_num_rows (mysql_query("SELECT nama_masteresl FROM tb_masteresl WHERE nama_masteresl='$_POST[nama_masteresl]'"));
	
		if (empty($_POST['nama_masteresl'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-masteresl&id_masteresl=$id_masteresl");
		}		
		else if($cekname > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-masteresl&id_masteresl=$id_masteresl");
		}
		else{
		$update= mysql_query ("UPDATE tb_masteresl SET nama_masteresl='$nama_masteresl' WHERE id_masteresl='$id_masteresl'");
			if($update){
				$_SESSION['pesan'] = "Good! edit nama eselon success ...";
				header("location:index.php?page=form-master-data-jabatan");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>