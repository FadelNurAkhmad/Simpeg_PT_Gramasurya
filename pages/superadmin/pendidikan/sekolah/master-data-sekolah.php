<div class="row">
<?php
	if (isset($_GET['id_sekolah'])) {
	$id_sekolah = $_GET['id_sekolah'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg			=$_POST['id_peg'];
	$tingkat		=$_POST['tingkat'];
	$nama_sekolah	=$_POST['nama_sekolah'];
	$lokasi			=$_POST['lokasi'];
	$jurusan		=$_POST['jurusan'];
	$no_ijazah		=$_POST['no_ijazah'];
	$tgl_ijazah		=$_POST['tgl_ijazah'];
	$kepala			=$_POST['kepala'];	
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['id_peg']) || empty($_POST['tingkat']) || empty($_POST['nama_sekolah']) || empty($_POST['lokasi']) || empty($_POST['no_ijazah']) || empty($_POST['tgl_ijazah']) || empty($_POST['kepala'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-sekolah");
		}
		
		else{
		$insert = "INSERT INTO tb_sekolah (id_sekolah, id_peg, tingkat, nama_sekolah, lokasi, jurusan, no_ijazah, tgl_ijazah, kepala) VALUES ('$id_sekolah', '$id_peg', '$tingkat', '$nama_sekolah', '$lokasi', '$jurusan', '$no_ijazah', '$tgl_ijazah', '$kepala')";
		$query = mysqli_query ($koneksi, $insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data sekolah success ...";
			header("location:index.php?page=form-master-data-sekolah");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>