<div class="row">
<?php
	if (isset($_GET['id_penghargaan'])) {
	$id_penghargaan = $_GET['id_penghargaan'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg			=$_POST['id_peg'];
	$penghargaan	=$_POST['penghargaan'];
	$tahun			=$_POST['tahun'];
	$pemberi		=$_POST['pemberi'];
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['id_peg']) || empty($_POST['penghargaan']) || empty($_POST['tahun']) || empty($_POST['pemberi'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-penghargaan");
		}
		
		else{
		$insert = "INSERT INTO tb_penghargaan (id_penghargaan, id_peg, penghargaan, tahun, pemberi) VALUES ('$id_penghargaan', '$id_peg', '$penghargaan', '$tahun', '$pemberi')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data penghargaan success ...";
			header("location:index.php?page=form-master-data-penghargaan");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>