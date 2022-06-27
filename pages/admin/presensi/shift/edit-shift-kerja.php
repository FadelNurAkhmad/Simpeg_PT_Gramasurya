<div class="row">
<?php

	if (isset($_GET['jk_id'])) {
	$jk_id = $_GET['jk_id'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilShift	= mysqli_query($koneksi, "SELECT * FROM jam_kerja WHERE jk_id='$jk_id'");
	$hasil	= mysqli_fetch_array ($tampilShift, MYSQLI_ASSOC);
    $notKode = $hasil['jk_kode'];

	
				
	if ($_POST['save'] == "save") {
	$nama               =$_POST['jk_name'];
	$kode			    =$_POST['jk_kode'];
	$ket		        =$_POST['jk_ket'];
	$durasi		        =$_POST['jk_durasi'];
	$useIstirahat		=$_POST['jk_use_ist'];
	$masuk				=$_POST['masuk'];	
	$istirahatKeluar	=$_POST['ist_1'];
	$istirahatKembali	=$_POST['ist_2'];
    $pulang             =$_POST['pulang'];
    $sebelumMasuk	    =$_POST['sebelum_masuk'];
    $setelahMasuk	    =$_POST['setelah_masuk'];
    $sebelumPulang	    =$_POST['sebelum_pulang'];
    $setelahPulang	    =$_POST['setelah_pulang'];
    $tolTelat	        =$_POST['tol_late'];
    $tolAwal	        =$_POST['tol_early'];
    $setengahKerja	    =$_POST['setengah_kerja'];
    $kerjaPenuh	        =$_POST['kerja_penuh'];
	$jk_countas	        =$_POST['jk_countas'];
	$jk_min_countas		=$_POST['kerja_penuh'];

	$time1 = new DateTime($masuk);
	$time2 = new DateTime($pulang);
	$interval = $time1->diff($time2);
	$minute += $interval->h * 60;
	$minute += $interval->i;

	
	$cekkode	=mysqli_num_rows (mysqli_query($koneksi, "SELECT jk_kode FROM jam_kerja WHERE jk_kode='$_POST[jk_kode]' AND jk_kode!='$notKode'"));
	
		if (empty($_POST['jk_name']) || empty($_POST['jk_kode']) || empty($_POST['masuk']) || empty($_POST['pulang'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-shift-kerja&jk_id=$jk_id");
		}		
		else if($cekkode > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-shift-kerja&jk_id=$jk_id");
		} 
		// else if($minute < $jk_min_countas) {
		// 	$_SESSION['pesan'] = "Oops! Durasi jam kerja harus lebih dari durasi minimal kerja penuh ...";
		// 	header("location:index.php?page=form-edit-shift-kerja&jk_id=$jk_id");
		// }
		else {
		$update= mysqli_query ($koneksi, "UPDATE jam_kerja SET jk_name='$nama', jk_kode='$kode', jk_ket='$ket', jk_durasi='$durasi', jk_use_ist='$useIstirahat', 
								jk_bcin='$masuk', jk_ist1='$istirahatKeluar', jk_ist2='$istirahatKembali', jk_ecout='$pulang', jk_cin='$sebelumMasuk', jk_ecin='$setelahMasuk', 
								jk_bcout='$sebelumPulang', jk_cout='$setelahPulang', jk_tol_late='$tolTelat', jk_tol_early='$tolAwal', jk_countas='$jk_countas',
								jk_min_countas='$jk_min_countas' WHERE jk_id='$jk_id'");
		
		
		if($update){
				$_SESSION['pesan'] = "Good! Edit Shift Kerja \"$hasil[jk_name]\" success ...";
				header("location:index.php?page=form-view-shift-kerja");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>