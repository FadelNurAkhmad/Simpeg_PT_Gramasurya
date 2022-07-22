<div class="row">
	<?php
	if (isset($_GET['id_jab']) and ($_GET['pegawai_id']) or ($_GET['unit']) or ($_GET['jabatan'])) {
		$id_jab = $_GET['id_jab'];
		$unit = $_GET['unit'];
		$jabatan	= str_replace("-", "&", $_GET['jabatan']);
		$id_peg = $_GET['pegawai_id'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$tP = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$id_peg'");
	$jkP = mysqli_fetch_array($tP, MYSQLI_ASSOC);
	$jk = $jkP['gender'];

	$cekUnit = mysqli_query($koneksi, "SELECT * FROM pembagian2 WHERE pembagian2_nama='$unit'");
	$unitId = mysqli_fetch_array($cekUnit, MYSQLI_ASSOC);


	$cekJab = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_nama='$jabatan'");
	$jabId = mysqli_fetch_array($cekJab, MYSQLI_ASSOC);

	$update1 = mysqli_query($koneksi, "UPDATE tb_jabatan SET status_jab='Aktif', jk_jab='$jk' WHERE id_jab='$id_jab'");
	$update2 = mysqli_query($koneksi, "UPDATE pegawai SET pembagian1_id='$jabId[pembagian1_id]', pembagian2_id='$unitId[pembagian2_id]' WHERE pegawai_id='$id_peg'");
	if ($update1) {
		$_SESSION['pesan'] = "Good! setup jabatan sekarang success ...";
		header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
	} else {
		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	}
	?>
</div>