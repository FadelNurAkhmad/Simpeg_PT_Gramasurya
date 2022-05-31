<div class="row">
<?php
	if (isset($_GET['id_seminar'])) {
	$id_seminar = $_GET['id_seminar'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilSem	= mysqli_query($koneksi, "SELECT * FROM tb_seminar WHERE id_seminar='$id_seminar'");
	$hasil	= mysqli_fetch_array ($tampilSem, MYSQLI_ASSOC);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$seminar		=$_POST['seminar'];
	$tempat			=$_POST['tempat'];
	$penyelenggara	=$_POST['penyelenggara'];	
	$tgl_mulai		=$_POST['tgl_mulai'];
	$tgl_selesai	=$_POST['tgl_selesai'];
	$no_piagam		=$_POST['no_piagam'];
	$tgl_piagam		=$_POST['tgl_piagam'];
	$file			=$_FILES['file']['name'];
	
		if (empty($_POST['seminar']) || empty($_POST['tempat']) || empty($_POST['penyelenggara']) || empty($_POST['tgl_mulai']) || empty($_POST['tgl_selesai']) || empty($_POST['no_piagam'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-seminar&id_seminar=$id_seminar");
		}		
		else{
		$update= mysqli_query ($koneksi, "UPDATE tb_seminar SET seminar='$seminar', tempat='$tempat', penyelenggara='$penyelenggara', tgl_mulai='$tgl_mulai', tgl_selesai='$tgl_selesai', no_piagam='$no_piagam', tgl_piagam='$tgl_piagam', file='$file' WHERE id_seminar='$id_seminar'");
			if($update){
				$_SESSION['pesan'] = "Good! edit data seminar success ...";
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