<div class="row">
	<?php
	if (isset($_GET['id_tunjangan'])) {
		$id_tunjangan = $_GET['id_tunjangan'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$tampilTun	= mysqli_query($koneksi, "SELECT * FROM tb_tunjangan WHERE id_tunjangan='$id_tunjangan'");
	$hasil	= mysqli_fetch_array($tampilTun);
	$id_peg	= $hasil['id_peg'];

	if ($_POST['edit'] == "edit") {
		$no_tunjangan	= $_POST['no_tunjangan'];
		$tgl_tunjangan	= $_POST['tgl_tunjangan'];
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

		if (empty($_POST['no_tunjangan']) || empty($_POST['tgl_tunjangan']) || empty($_POST['jns_tunjangan']) || empty($_POST['tgl_terhitung']) || empty($_POST['akta_kawin']) || empty($_POST['akta_lahir'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-tunjangan&id_tunjangan=$id_tunjangan");
		} else {
			$update = mysqli_query($koneksi, "UPDATE tb_tunjangan SET no_tunjangan='$no_tunjangan', tgl_tunjangan='$tgl_tunjangan', jns_tunjangan='$jns_tunjangan', tgl_terhitung='$tgl_terhitung', akta_kawin='$akta_kawin', no_akta_kawin='$no_akta_kawin', tgl_akta_kawin='$tgl_akta_kawin', akta_lahir='$akta_lahir', no_akta_lahir='$no_akta_lahir', tgl_akta_lahir='$tgl_akta_lahir', tembusan1='$tembusan1', tembusan2='$tembusan2', tembusan3='$tembusan3', tembusan4='$tembusan4', tembusan5='$tembusan5' WHERE id_tunjangan='$id_tunjangan'");
			if ($update) {
				$_SESSION['pesan'] = "Good! edit data tunjangan success ...";
				header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>