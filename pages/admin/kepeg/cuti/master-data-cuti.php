<div class="row">
<?php
	if (isset($_GET['id_cuti'])) {
	$id_cuti = $_GET['id_cuti'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg			=$_POST['id_peg'];
	$jns_cuti		=$_POST['jns_cuti'];
	$no_suratcuti	=$_POST['no_suratcuti'];
	$tgl_suratcuti	=$_POST['tgl_suratcuti'];
	$tgl_mulai		=$_POST['tgl_mulai'];
	$tgl_selesai	=$_POST['tgl_selesai'];
	$lama			=$_POST['lama'];
	$lama_terbilang	=$_POST['lama_terbilang'];
	$lama_satuan	=$_POST['lama_satuan'];
	$point1			=$_POST['point1'];
	$ket1			=$_POST['ket1'];
	$point2			=$_POST['point2'];
	$ket2			=$_POST['ket2'];
	$point3			=$_POST['point3'];
	$ket3			=$_POST['ket3'];
	$tembusan1		=$_POST['tembusan1'];
	$tembusan2		=$_POST['tembusan2'];
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['id_peg']) || empty($_POST['jns_cuti']) || empty($_POST['no_suratcuti']) || empty($_POST['tgl_suratcuti']) || empty($_POST['tgl_mulai']) || empty($_POST['tgl_selesai'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-cuti");
		}
		
		else{
		$insert = "INSERT INTO tb_cuti (id_cuti, id_peg, jns_cuti, no_suratcuti, tgl_suratcuti, tgl_mulai, tgl_selesai, lama, lama_terbilang, lama_satuan, point1, ket1, point2, ket2, point3, ket3, tembusan1, tembusan2) VALUES ('$id_cuti', '$id_peg', '$jns_cuti', '$no_suratcuti', '$tgl_suratcuti', '$tgl_mulai', '$tgl_selesai', '$lama', '$lama_terbilang', '$lama_satuan', '$point1', '$ket1', '$point2', '$ket2', '$point3', '$ket3', '$tembusan1', '$tembusan2')";
		$query = mysqli_query ($koneksi, $insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data cuti success ...";
			header("location:index.php?page=form-master-data-cuti");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>