<div class="row">
<?php
	if (isset($_GET['id_lat_jabatan'])) {
	$id_lat_jabatan = $_GET['id_lat_jabatan'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg			=$_POST['id_peg'];
	$nama_pelatih	=$_POST['nama_pelatih'];
	$tahun_lat		=$_POST['tahun_lat'];
	$jml_jam		=$_POST['jml_jam'];
	$file			=$_FILES['file']['name'];
	
	include "../../config/koneksi.php";
	$cekid	=mysql_num_rows (mysql_query("SELECT id_peg FROM tb_lat_jabatan WHERE id_peg='$_POST[id_peg]'"));
	
		if (empty($_POST['id_peg']) || empty($_POST['nama_pelatih']) || empty($_POST['tahun_lat']) || empty($_POST['jml_jam'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-lat-jabatan");
		}
		else if($cekid > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-lat-jabatan");
		}
		
		else{
		$insert = "INSERT INTO tb_lat_jabatan (id_lat_jabatan, id_peg, nama_pelatih, tahun_lat, jml_jam, file) VALUES ('$id_lat_jabatan', '$id_peg', '$nama_pelatih', '$tahun_lat', '$jml_jam', '$file')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data lat jabatan success ...";
			header("location:index.php?page=form-master-data-lat-jabatan");
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