<div class="row">
<?php
	if (isset($_GET['id_penugasan'])) {
	$id_penugasan = $_GET['id_penugasan'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg		=$_POST['id_peg'];
	$tujuan		=$_POST['tujuan'];
	$tahun		=$_POST['tahun'];
	$lama		=$_POST['lama'];
	$alasan		=$_POST['alasan'];
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['id_peg']) || empty($_POST['tujuan']) || empty($_POST['tahun']) || empty($_POST['lama']) || empty($_POST['alasan'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-penugasan");
		}
		
		else{
		$insert = "INSERT INTO tb_penugasan (id_penugasan, id_peg, tujuan, tahun, lama, alasan) VALUES ('$id_penugasan', '$id_peg', '$tujuan', '$tahun', '$lama', '$alasan')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data penugasan success ...";
			header("location:index.php?page=form-master-data-penugasan");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>