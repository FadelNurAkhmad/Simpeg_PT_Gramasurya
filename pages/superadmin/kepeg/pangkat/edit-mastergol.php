<div class="row">
<?php
	if (isset($_GET['id_mastergol'])) {
	$id_mastergol = $_GET['id_mastergol'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilMG	= mysqli_query($koneksi, "SELECT * FROM tb_mastergol WHERE id_mastergol='$id_mastergol'");
	$hasil	= mysqli_fetch_array ($tampilMG, MYSQLI_ASSOC);
				
	if ($_POST['edit'] == "edit") {
	$nama_mastergol	=$_POST['nama_mastergol'];
	
	$cekname	=mysqli_num_rows (mysqli_query($koneksi, "SELECT nama_mastergol FROM tb_mastergol WHERE nama_mastergol='$_POST[nama_mastergol]'"));
	
		if (empty($_POST['nama_mastergol'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-mastergol&id_mastergol=$id_mastergol");
		}		
		else if($cekname > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-mastergol&id_mastergol=$id_mastergol");
		}
		else{
		$update= mysqli_query ($koneksi, "UPDATE tb_mastergol SET nama_mastergol='$nama_mastergol' WHERE id_mastergol='$id_mastergol'");
			if($update){
				$_SESSION['pesan'] = "Good! edit nama golongan success ...";
				header("location:index.php?page=form-master-data-pangkat");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>