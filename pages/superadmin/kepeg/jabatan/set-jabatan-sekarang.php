<div class="row">
	<?php
	if (isset($_GET['id_jab']) and ($_GET['id_peg']) and ($_GET['jabatan'])) {
		$id_jab = $_GET['id_jab'];
		$jabatan	= $_GET['jabatan'];
		$id_peg = $_GET['id_peg'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$tP = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
	$jkP = mysqli_fetch_array($tP, MYSQLI_ASSOC);
	$jk = $jkP['jk'];

	$update1 = mysqli_query($koneksi, "UPDATE tb_jabatan SET status_jab='' WHERE id_peg='$id_peg'");
	$update2 = mysqli_query($koneksi, "UPDATE tb_jabatan SET status_jab='Aktif', jk_jab='$jk' WHERE id_jab='$id_jab'");
	$update3 = mysqli_query($koneksi, "UPDATE tb_pegawai SET jabatan='$jabatan' WHERE id_peg='$id_peg'");
	if ($update1) {
		$_SESSION['pesan'] = "Good! setup jabatan sekarang success ...";
		header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
	} else {
		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	}
	?>
</div>