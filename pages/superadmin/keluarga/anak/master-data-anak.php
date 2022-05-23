<div class="row">
<?php
	if (isset($_GET['id_anak'])) {
	$id_anak = $_GET['id_anak'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg			=$_POST['id_peg'];
	$nik			=$_POST['nik'];
	$nama			=$_POST['nama'];
	$tmp_lhr		=$_POST['tmp_lhr'];
	$tgl_lhr		=$_POST['tgl_lhr'];
	$jk				=$_POST['jk'];
	$pendidikan		=$_POST['pendidikan'];
	$pekerjaan		=$_POST['pekerjaan'];	
	$status_hub		=$_POST['status_hub'];
	
	$date_reg	=date("Ymd");
	
	include "../../config/koneksi.php";
	$ceknik	=mysql_num_rows (mysql_query("SELECT nik FROM tb_anak WHERE nik='$_POST[nik]'"));
	
		if (empty($_POST['id_peg']) || empty($_POST['nik']) || empty($_POST['nama']) || empty($_POST['tmp_lhr']) || empty($_POST['tgl_lhr']) || empty($_POST['jk']) || empty($_POST['status_hub'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-anak");
		}
		else if($ceknik > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-anak");
		}
		
		else{
		$insert = "INSERT INTO tb_anak (id_anak, id_peg, nik, nama, tmp_lhr, tgl_lhr, jk, pendidikan, pekerjaan, status_hub, date_reg) VALUES ('$id_anak', '$id_peg', '$nik', '$nama', '$tmp_lhr', '$tgl_lhr', '$jk', '$pendidikan', '$pekerjaan', '$status_hub', '$date_reg')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data anak success ...";
			header("location:index.php?page=form-master-data-anak");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>