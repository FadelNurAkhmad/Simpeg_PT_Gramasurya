<div class="row">
<?php
	if (isset($_GET['id_cuti'])) {
	$id_cuti = $_GET['id_cuti'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilCut	= mysqli_query($koneksi, "SELECT * FROM tb_cuti WHERE id_cuti='$id_cuti'");
	$hasil	= mysqli_fetch_array ($tampilCut, MYSQLI_ASSOC);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
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
	
		if (empty($_POST['jns_cuti']) || empty($_POST['no_suratcuti']) || empty($_POST['tgl_suratcuti']) || empty($_POST['tgl_mulai']) || empty($_POST['tgl_selesai'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-cuti&id_cuti=$id_cuti");
		}		
		else{
		$update= mysqli_query ($koneksi, "UPDATE tb_cuti SET jns_cuti='$jns_cuti', no_suratcuti='$no_suratcuti', tgl_suratcuti='$tgl_suratcuti', tgl_mulai='$tgl_mulai', tgl_selesai='$tgl_selesai', lama='$lama', lama_terbilang='$lama_terbilang', lama_satuan='$lama_satuan', point1='$point1', ket1='$ket1', point2='$point2', ket2='$ket2', point3='$point3', ket3='$ket3', tembusan1='$tembusan1', tembusan2='$tembusan2' WHERE id_cuti='$id_cuti'");
			if($update){
				$_SESSION['pesan'] = "Good! edit data cuti success ...";
				header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>