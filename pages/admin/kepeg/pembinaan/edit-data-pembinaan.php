<div class="row">
	<?php
	if (isset($_GET['id_pembinaan'])) {
		$id_pembinaan = $_GET['id_pembinaan'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$tampilHuk	= mysqli_query($koneksi, "SELECT * FROM tb_pembinaan WHERE id_pembinaan='$id_pembinaan'");
	$hasil	= mysqli_fetch_array($tampilHuk);
	$id_peg	= $hasil['id_peg'];

	if ($_POST['edit'] == "edit") {
		$pembinaan		= $_POST['pembinaan'];
		$pejabat_sk		= $_POST['pejabat_sk'];
		$no_sk			= $_POST['no_sk'];
		$tgl_sk			= $_POST['tgl_sk'];
		$pejabat_pulih	= $_POST['pejabat_pulih'];
		$no_pulih		= $_POST['no_pulih'];
		$tgl_pulih		= $_POST['tgl_pulih'];

		// $tP = mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
		// $gp = mysqli_fetch_array($tP, MYSQLI_ASSOC);
		// $gol		= $gp['gol'];
		// $pangkat	= $gp['pangkat'];

		// $tJ = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$id_peg' AND status_jab='Aktif'");
		// $esl = mysqli_fetch_array($tJ);
		// $eselon		= $esl['eselon'];

		if (empty($_POST['pembinaan']) || empty($_POST['pejabat_sk']) || empty($_POST['no_sk']) || empty($_POST['tgl_sk'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-pembinaan&id_pembinaan=$id_pembinaan");
		} else {
			$update = mysqli_query($koneksi, "UPDATE tb_pembinaan SET pembinaan='$pembinaan', pejabat_sk='$pejabat_sk', no_sk='$no_sk', tgl_sk='$tgl_sk', pejabat_pulih='$pejabat_pulih', no_pulih='$no_pulih', tgl_pulih='$tgl_pulih' WHERE id_pembinaan='$id_pembinaan'");
			if ($update) {
				$_SESSION['pesan'] = "Good! edit data pembinaan success ...";
				header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>