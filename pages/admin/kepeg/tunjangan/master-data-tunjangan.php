<div class="row">
	<?php
	if (isset($_GET['id_tunjangan'])) {
		$id_tunjangan = $_GET['id_tunjangan'];
	} else {
		die("Error. No ID Selected! ");
	}

	if ($_POST['save'] == "save") {
		$no_tunjangan	= $_POST['no_tunjangan'];
		$tgl_tunjangan	= $_POST['tgl_tunjangan'];
		$id_peg			= $_POST['id_peg'];
		$jns_tunjangan	= $_POST['jns_tunjangan'];
		$tgl_terhitung	= $_POST['tgl_terhitung'];
		$akta_kawin		= $_POST['akta_kawin'];
		$no_akta_kawin	= $_POST['no_akta_kawin'];
		$tgl_akta_kawin	= $_POST['tgl_akta_kawin'];
		$akta_lahir		= $_POST['akta_lahir'];
		$no_akta_lahir	= $_POST['no_akta_lahir'];
		$tgl_akta_lahir	= $_POST['tgl_akta_lahir'];
		$tembusan1		= $_POST['tembusan1'];
		$tembusan2		= $_POST['tembusan2'];
		$tembusan3		= $_POST['tembusan3'];
		$tembusan4		= $_POST['tembusan4'];
		$tembusan5		= $_POST['tembusan5'];

		include "../../config/koneksi.php";

		if (empty($_POST['no_tunjangan']) || empty($_POST['tgl_tunjangan']) || empty($_POST['id_peg']) || empty($_POST['jns_tunjangan']) || empty($_POST['tgl_terhitung']) || empty($_POST['akta_kawin']) || empty($_POST['akta_lahir'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-tunjangan");
		} else {
			$insert = "INSERT INTO tb_tunjangan (id_tunjangan, no_tunjangan, tgl_tunjangan, id_peg, jns_tunjangan, tgl_terhitung, akta_kawin, no_akta_kawin, tgl_akta_kawin, akta_lahir, no_akta_lahir, tgl_akta_lahir, tembusan1, tembusan2, tembusan3, tembusan4, tembusan5) VALUES ('$id_tunjangan', '$no_tunjangan', '$tgl_tunjangan', '$id_peg', '$jns_tunjangan', '$tgl_terhitung', '$akta_kawin', '$no_akta_kawin', '$tgl_akta_kawin', '$akta_lahir', '$no_akta_lahir', '$tgl_akta_lahir', '$tembusan1', '$tembusan2', '$tembusan3', '$tembusan4', '$tembusan5')";
			$query = mysqli_query($koneksi, $insert);

			if ($query) {
				$_SESSION['pesan'] = "Good! Insert data tunjangan success ...";
				header("location:index.php?page=form-master-data-tunjangan");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>