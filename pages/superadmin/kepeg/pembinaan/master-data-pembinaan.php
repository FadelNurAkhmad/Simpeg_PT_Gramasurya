<div class="row">
	<?php
	if (isset($_GET['id_pembinaan'])) {
		$id_pembinaan = $_GET['id_pembinaan'];
	} else {
		die("Error. No ID Selected! ");
	}

	if ($_POST['save'] == "save") {
		$id_peg			= $_POST['id_peg'];
		$pembinaan		= $_POST['pembinaan'];
		$pejabat_sk		= $_POST['pejabat_sk'];
		$no_sk			= $_POST['no_sk'];
		$tgl_sk			= $_POST['tgl_sk'];
		$pejabat_pulih	= $_POST['pejabat_pulih'];
		$no_pulih		= $_POST['no_pulih'];
		$tgl_pulih		= $_POST['tgl_pulih'];

		include "../../config/koneksi.php";
		// $tP = mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
		// $gp = mysqli_fetch_array($tP, MYSQLI_ASSOC);
		// $gol		= $gp['gol'];
		// $pangkat	= $gp['pangkat'];

		// $tJ = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$id_peg' AND status_jab='Aktif'");
		// $esl = mysqli_fetch_array($tJ);
		// $eselon		= $esl['eselon'];

		if (empty($_POST['id_peg']) || empty($_POST['pembinaan']) || empty($_POST['pejabat_sk']) || empty($_POST['no_sk']) || empty($_POST['tgl_sk'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-pembinaan");
		} else {
			$insert = "INSERT INTO tb_pembinaan (id_pembinaan, id_peg, pembinaan, pejabat_sk, no_sk, tgl_sk, pejabat_pulih, no_pulih, tgl_pulih) VALUES ('$id_pembinaan', '$id_peg', '$pembinaan', '$pejabat_sk', '$no_sk', '$tgl_sk', '$pejabat_pulih', '$no_pulih', '$tgl_pulih')";
			$query = mysqli_query($koneksi, $insert);

			if ($query) {
				$_SESSION['pesan'] = "Good! Insert data pembinaan success ...";
				header("location:index.php?page=form-master-data-pembinaan");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>