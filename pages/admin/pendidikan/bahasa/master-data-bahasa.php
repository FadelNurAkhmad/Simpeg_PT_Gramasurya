<div class="row">
<?php
	if (isset($_GET['id_bhs'])) {
	$id_bhs = $_GET['id_bhs'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg		=$_POST['id_peg'];
	$jns_bhs	=$_POST['jns_bhs'];
	$bahasa		=$_POST['bahasa'];
	$kemampuan	=$_POST['kemampuan'];
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['id_peg']) || empty($_POST['jns_bhs']) || empty($_POST['bahasa']) || empty($_POST['kemampuan'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-bahasa");
		}
		
		else{
		$insert = "INSERT INTO tb_bahasa (id_bhs, id_peg, jns_bhs, bahasa, kemampuan) VALUES ('$id_bhs', '$id_peg', '$jns_bhs', '$bahasa', '$kemampuan')";
		$query = mysql_query ($insert);		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data bahasa success ...";
			header("location:index.php?page=form-master-data-bahasa");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>