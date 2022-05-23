<div class="row">
<?php
	if (isset($_GET['id_ortu'])) {
	$id_ortu = $_GET['id_ortu'];
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
	$pendidikan		=$_POST['pendidikan'];
	$pekerjaan		=$_POST['pekerjaan'];	
	$status_hub		=$_POST['status_hub'];
	
	$date_reg	=date("Ymd");
	
	include "../../config/koneksi.php";
	$ceknik	=mysql_num_rows (mysql_query("SELECT nik FROM tb_ortu WHERE nik='$_POST[nik]'"));
	$cekortu	=mysql_num_rows (mysql_query("SELECT status_hub FROM tb_ortu WHERE (id_peg='$_POST[id_peg]' AND status_hub='$_POST[status_hub]')"));
	
		if (empty($_POST['id_peg']) || empty($_POST['nik']) || empty($_POST['nama']) || empty($_POST['tmp_lhr']) || empty($_POST['tgl_lhr']) || empty($_POST['pendidikan']) || empty($_POST['pekerjaan']) || empty($_POST['status_hub'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-ortu");
		}
		else if($ceknik > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-ortu");
		}
		else if($cekortu > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-ortu");
		}
		
		else{
		$insert = "INSERT INTO tb_ortu (id_ortu, id_peg, nik, nama, tmp_lhr, tgl_lhr, pendidikan, pekerjaan, status_hub, date_reg) VALUES ('$id_ortu', '$id_peg', '$nik', '$nama', '$tmp_lhr', '$tgl_lhr', '$pendidikan', '$pekerjaan', '$status_hub', '$date_reg')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data orang tua success ...";
			header("location:index.php?page=form-master-data-ortu");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>