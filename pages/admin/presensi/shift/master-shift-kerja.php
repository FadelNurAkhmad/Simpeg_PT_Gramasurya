<div class="row">
<?php

	if (isset($_GET['jk_id'])) {
	    $jk_id = $_GET['jk_id'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}	
				
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

    include "../../config/koneksi.php";
	$cekkode	=mysqli_num_rows (mysqli_query($koneksi, "SELECT jk_kode FROM jam_kerja WHERE jk_kode='$_POST[jk_kode]'"));
	
		if (empty($_POST['jk_name']) || empty($_POST['jk_kode']) || empty($_POST['masuk']) || empty($_POST['pulang'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-shift-kerja");
		}		
		else if($cekkode > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-shift-kerja");
		} 
		// else if($minute < $jk_min_countas) {
		// 	$_SESSION['pesan'] = "Oops! Durasi jam kerja harus lebih dari durasi minimal kerja penuh ...";
		// 	header("location:index.php?page=form-edit-shift-kerja&jk_id=$jk_id");
		// }
		else {
		$insert = mysqli_query ($koneksi, "INSERT INTO jam_kerja (jk_id, jk_name, jk_kode, use_set, jk_ket, jk_durasi, jk_use_ist,jk_bcin, 
                                jk_ist1, jk_ist2, jk_ecout, jk_cin, jk_ecin, jk_bcout, jk_cout, jk_tol_late, jk_tol_early, jk_countas, jk_min_countas) 
                                VALUES ('$jk_id', '$nama', '$kode', '-1', '$ket', '$durasi', '$useIstirahat', '$masuk', '$istirahatKeluar',
                                '$istirahatKembali', '$pulang', '$sebelumMasuk', '$setelahMasuk', '$sebelumPulang', '$setelahPulang',
                                '$tolTelat', '$tolAwal', '$jk_countas', '$jk_min_countas')");
		
		
		if($insert){
				$_SESSION['pesan'] = "Good! Insert Shift Kerja success ...";
				header("location:index.php?page=form-view-shift-kerja");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>