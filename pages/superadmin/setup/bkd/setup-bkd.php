<div class="row">
<?php
	if (isset($_GET['id_setup_bkd'])) {
	$id_setup_bkd = $_GET['id_setup_bkd'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$setup	= mysql_query("SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='$id_setup_bkd'");
	$hasil	= mysql_fetch_array ($setup);
				
	if ($_POST['setup'] == "setup") {
	$kab	=$_POST['kab'];
	$alamat	=$_POST['alamat'];
	$kepala	=$_POST['kepala'];
		
		if (empty($_POST['kab']) || empty($_POST['alamat']) || empty($_POST['kepala'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-setup-bkd&id_setup_bkd=$id_setup_bkd");
		}
		else{
		$update= mysql_query ("UPDATE tb_setup_bkd SET kab='$kab', alamat='$alamat', kepala='$kepala' WHERE id_setup_bkd='$id_setup_bkd'");
			if($update){
				$_SESSION['pesan'] = "Good! setup BKD success ...";
				header("location:index.php?page=form-view-setup-bkd");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>