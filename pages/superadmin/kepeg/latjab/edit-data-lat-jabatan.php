<div class="row">
<?php
	if (isset($_GET['id_lat_jabatan'])) {
	$id_lat_jabatan = $_GET['id_lat_jabatan'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilLat	= mysql_query("SELECT * FROM tb_lat_jabatan WHERE id_lat_jabatan='$id_lat_jabatan'");
	$hasil	= mysql_fetch_array ($tampilLat);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$nama_pelatih	=$_POST['nama_pelatih'];
	$tahun_lat		=$_POST['tahun_lat'];
	$jml_jam		=$_POST['jml_jam'];
	$file			=$_FILES['file']['name'];
	
		if (empty($_POST['nama_pelatih']) || empty($_POST['tahun_lat']) || empty($_POST['jml_jam'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-lat-jabatan&id_lat_jabatan=$id_lat_jabatan");
		}		
		else{
		$update= mysql_query ("UPDATE tb_lat_jabatan SET nama_pelatih='$nama_pelatih', tahun_lat='$tahun_lat', jml_jam='$jml_jam', file='$file' WHERE id_lat_jabatan='$id_lat_jabatan'");
			if($update){
				$_SESSION['pesan'] = "Good! edit data lat jabatan success ...";
				header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
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