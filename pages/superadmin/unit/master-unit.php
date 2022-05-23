<div class="row">
<?php	
	if (isset($_GET['id_unit'])) {
	$id_unit = $_GET['id_unit'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$nama	=$_POST['nama'];
	
	include "../../config/koneksi.php";
	$ceknm	=mysql_num_rows (mysql_query("SELECT nama FROM tb_unit WHERE nama='$_POST[nama]'"));
	
		if (empty($_POST['nama'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-unit");
		}
		else if($ceknm > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-unit");
		}
		
		else{
		$insert = "INSERT INTO tb_unit (id_unit, nama) VALUES ('$id_unit', '$nama')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert Unit Kerja success ...";
			header("location:index.php?page=form-view-data-unit");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>