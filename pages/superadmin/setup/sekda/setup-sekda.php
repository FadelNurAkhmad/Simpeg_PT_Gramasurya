<div class="row">
<?php
	if (isset($_GET['id_setup_sekda'])) {
	$id_setup_sekda = $_GET['id_setup_sekda'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$setup	= mysql_query("SELECT * FROM tb_setup_sekda WHERE id_setup_sekda='$id_setup_sekda'");
	$hasil	= mysql_fetch_array ($setup);
				
	if ($_POST['setup'] == "setup") {
	$kab	=$_POST['kab'];
	$alamat	=$_POST['alamat'];
	$sekda	=$_POST['sekda'];
		
		if (empty($_POST['kab']) || empty($_POST['alamat']) || empty($_POST['sekda'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-setup-sekda&id_setup_sekda=$id_setup_sekda");
		}
		else{
		$update= mysql_query ("UPDATE tb_setup_sekda SET kab='$kab', alamat='$alamat', sekda='$sekda' WHERE id_setup_sekda='$id_setup_sekda'");
			if($update){
				$_SESSION['pesan'] = "Good! setup Sekretariat Daerah success ...";
				header("location:index.php?page=form-view-setup-sekda");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>