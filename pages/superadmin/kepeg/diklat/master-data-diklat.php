<div class="row">
<?php
	if (isset($_GET['id_diklat'])) {
	$id_diklat = $_GET['id_diklat'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg			=$_POST['id_peg'];
	$diklat			=$_POST['diklat'];
	$jml_jam		=$_POST['jml_jam'];
	$penyelenggara	=$_POST['penyelenggara'];
	$tempat			=$_POST['tempat'];
	$angkatan		=$_POST['angkatan'];
	$tahun			=$_POST['tahun'];
	$no_sttpp		=$_POST['no_sttpp'];
	$tgl_sttpp		=$_POST['tgl_sttpp'];
	$file			=$_FILES['file']['name'];
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['id_peg']) || empty($_POST['diklat']) || empty($_POST['jml_jam']) || empty($_POST['penyelenggara']) || empty($_POST['tempat']) || empty($_POST['angkatan']) || empty($_POST['tahun'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-diklat");
		}
		
		else{
		$insert = "INSERT INTO tb_diklat (id_diklat, id_peg, diklat, jml_jam, penyelenggara, tempat, angkatan, tahun, no_sttpp, tgl_sttpp, file) VALUES ('$id_diklat', '$id_peg', '$diklat', '$jml_jam', '$penyelenggara', '$tempat', '$angkatan', '$tahun', '$no_sttpp', '$tgl_sttpp', '$file')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data diklat success ...";
			header("location:index.php?page=form-master-data-diklat");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
			if (strlen($file)>0) {
				if (is_uploaded_file($_FILES['file']['tmp_name'])) {
					move_uploaded_file ($_FILES['file']['tmp_name'], "../../assets/file/".$file);
				}
			}
		}
	}
?>
</div>