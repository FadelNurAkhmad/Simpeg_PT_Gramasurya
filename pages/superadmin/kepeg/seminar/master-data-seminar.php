<div class="row">
<?php
	if (isset($_GET['id_seminar'])) {
	$id_seminar = $_GET['id_seminar'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg			=$_POST['id_peg'];
	$seminar		=$_POST['seminar'];
	$tempat			=$_POST['tempat'];
	$penyelenggara	=$_POST['penyelenggara'];	
	$tgl_mulai		=$_POST['tgl_mulai'];
	$tgl_selesai	=$_POST['tgl_selesai'];
	$no_piagam		=$_POST['no_piagam'];
	$tgl_piagam		=$_POST['tgl_piagam'];
	$file			=$_FILES['file']['name'];
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['id_peg']) || empty($_POST['seminar']) || empty($_POST['tempat']) || empty($_POST['penyelenggara']) || empty($_POST['tgl_mulai']) || empty($_POST['tgl_selesai']) || empty($_POST['no_piagam'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-seminar");
		}
		
		else{
		$insert = "INSERT INTO tb_seminar (id_seminar, id_peg, seminar, tempat, penyelenggara, tgl_mulai, tgl_selesai, no_piagam, tgl_piagam, file) VALUES ('$id_seminar', '$id_peg', '$seminar', '$tempat', '$penyelenggara', '$tgl_mulai', '$tgl_selesai', '$no_piagam', '$tgl_piagam', '$file')";
		$query = mysqli_query ($koneksi, $insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data seminar success ...";
			header("location:index.php?page=form-master-data-seminar");
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