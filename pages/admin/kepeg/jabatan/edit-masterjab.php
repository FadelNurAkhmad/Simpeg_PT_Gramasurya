<div class="row">
<?php
	if (isset($_GET['pembagian1_id'])) {
	$pembagian1_id = $_GET['pembagian1_id'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilMJ	= mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$pembagian1_id'");
	$hasil	= mysqli_fetch_array ($tampilMJ, MYSQLI_ASSOC);
				
	if ($_POST['edit'] == "edit") {
	$pembagian1_nama	=$_POST['pembagian1_nama'];
	
	$cekname	=mysqli_num_rows (mysqli_query($koneksi, "SELECT pembagian1_nama FROM pembagian1 WHERE pembagian1_nama='$_POST[pembagian1_nama]'"));
	
		if (empty($_POST['pembagian1_nama'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-masterjab&pembagian1_id=$pembagian1_id");
		}		
		else if($cekname > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-masterjab&pembagian1_id=$pembagian1_id");
		}
		else{
		$update= mysqli_query ($koneksi, "UPDATE pembagian1 SET pembagian1_nama='$pembagian1_nama' WHERE pembagian1_id='$pembagian1_id'");
			if($update){
				$_SESSION['pesan'] = "Good! edit nama jabatan success ...";
				header("location:index.php?page=form-master-data-jabatan");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>