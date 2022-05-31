<div class="row">
<?php
	if (isset($_GET['id_hukuman'])) {
	$id_hukuman = $_GET['id_hukuman'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilHuk	= mysqli_query($koneksi, "SELECT * FROM tb_hukuman WHERE id_hukuman='$id_hukuman'");
	$hasil	= mysqli_fetch_array ($tampilHuk, MYSQLI_ASSOC);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$hukuman		=$_POST['hukuman'];
	$pejabat_sk		=$_POST['pejabat_sk'];
	$no_sk			=$_POST['no_sk'];
	$tgl_sk			=$_POST['tgl_sk'];
	$pejabat_pulih	=$_POST['pejabat_pulih'];
	$no_pulih		=$_POST['no_pulih'];
	$tgl_pulih		=$_POST['tgl_pulih'];
	
	$tP=mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
	$gp=mysqli_fetch_array($tP, MYSQLI_ASSOC);
	$gol		=$gp['gol'];
	$pangkat	=$gp['pangkat'];
	
	$tJ=mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$id_peg' AND status_jab='Aktif'");
	$esl=mysqli_fetch_array($tJ, MYSQLI_ASSOC);
	$eselon		=$esl['eselon'];
	
		if (empty($_POST['hukuman']) || empty($_POST['pejabat_sk']) || empty($_POST['no_sk']) || empty($_POST['tgl_sk'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-hukuman&id_hukuman=$id_hukuman");
		}		
		else{
		$update= mysqli_query ($koneksi, "UPDATE tb_hukuman SET hukuman='$hukuman', pejabat_sk='$pejabat_sk', no_sk='$no_sk', tgl_sk='$tgl_sk', pejabat_pulih='$pejabat_pulih', no_pulih='$no_pulih', tgl_pulih='$tgl_pulih', gol='$gol', pangkat='$pangkat', eselon='$eselon' WHERE id_hukuman='$id_hukuman'");
			if($update){
				$_SESSION['pesan'] = "Good! edit data hukuman success ...";
				header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>