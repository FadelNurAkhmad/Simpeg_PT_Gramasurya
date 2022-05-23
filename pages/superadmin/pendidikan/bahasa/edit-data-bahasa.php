<div class="row">
<?php
	if (isset($_GET['id_bhs'])) {
	$id_bhs = $_GET['id_bhs'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilBah	= mysql_query("SELECT * FROM tb_bahasa WHERE id_bhs='$id_bhs'");
	$hasil	= mysql_fetch_array ($tampilBah);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$jns_bhs	=$_POST['jns_bhs'];
	$bahasa		=$_POST['bahasa'];
	$kemampuan	=$_POST['kemampuan'];
	
		if (empty($_POST['jns_bhs']) || empty($_POST['bahasa']) || empty($_POST['kemampuan'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-bahasa&id_bhs=$id_bhs");
		}	
		else{
		$update= mysql_query ("UPDATE tb_bahasa SET jns_bhs='$jns_bhs', bahasa='$bahasa', kemampuan='$kemampuan' WHERE id_bhs='$id_bhs'");
			if($update){
				$_SESSION['pesan'] = "Good! edit data bahasa success ...";
				header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>