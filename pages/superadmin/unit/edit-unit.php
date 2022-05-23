<div class="row">
<?php
	if (isset($_GET['id_unit'])) {
	$id_unit = $_GET['id_unit'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$query	= mysql_query("SELECT * FROM tb_unit WHERE id_unit='$id_unit'");
	$hasil	= mysql_fetch_array ($query);
		$notnm	=$hasil['nama'];
				
	if ($_POST['edit'] == "edit") {
	$nama	=$_POST['nama'];
	
	$ceknm	=mysql_num_rows (mysql_query("SELECT nama FROM tb_unit WHERE nama='$_POST[nama]' AND nama!='$notnm'"));
		
		if (empty($_POST['nama'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-unit&id_unit=$id_unit");
		}
		else if($ceknm > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-data-unit&id_unit=$id_unit");
		}
		
		else{
		$update= mysql_query ("UPDATE tb_unit SET nama='$nama' WHERE id_unit='$id_unit'");
			if($update){
				$_SESSION['pesan'] = "Good! Edit Unit Kerja success ...";
				header("location:index.php?page=form-view-data-unit");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>