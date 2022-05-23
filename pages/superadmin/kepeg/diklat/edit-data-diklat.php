<div class="row">
<?php
	if (isset($_GET['id_diklat'])) {
	$id_diklat = $_GET['id_diklat'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilDik	= mysql_query("SELECT * FROM tb_diklat WHERE id_diklat='$id_diklat'");
	$hasil	= mysql_fetch_array ($tampilDik);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$diklat			=$_POST['diklat'];
	$jml_jam		=$_POST['jml_jam'];
	$penyelenggara	=$_POST['penyelenggara'];
	$tempat			=$_POST['tempat'];
	$angkatan		=$_POST['angkatan'];
	$tahun			=$_POST['tahun'];
	$no_sttpp		=$_POST['no_sttpp'];
	$tgl_sttpp		=$_POST['tgl_sttpp'];
	$file			=$_FILES['file']['name'];
	
		if (empty($_POST['diklat']) || empty($_POST['jml_jam']) || empty($_POST['penyelenggara']) || empty($_POST['tempat']) || empty($_POST['angkatan']) || empty($_POST['tahun'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-diklat&id_diklat=$id_diklat");
		}		
		else{
		$update= mysql_query ("UPDATE tb_diklat SET diklat='$diklat', jml_jam='$jml_jam', penyelenggara='$penyelenggara', tempat='$tempat', angkatan='$angkatan', tahun='$tahun', no_sttpp='$no_sttpp', tgl_sttpp='$tgl_sttpp', file='$file' WHERE id_diklat='$id_diklat'");
			if($update){
				$_SESSION['pesan'] = "Good! edit data diklat success ...";
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