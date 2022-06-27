<div class="row">
	<?php
	if (isset($_GET['id_setup_peru'])) {
		$id_setup_peru = $_GET['id_setup_peru'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$setup	= mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='$id_setup_peru'");
	$hasil	= mysqli_fetch_array($setup);

	if ($_POST['setup'] == "setup") {
		$nama_peru	= $_POST['nama_peru'];
		$alamat		= $_POST['alamat'];
		$pimpinan	= $_POST['pimpinan'];

		if (empty($_POST['nama_peru']) || empty($_POST['alamat']) || empty($_POST['pimpinan'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-setup-perusahaan&id_setup_peru=$id_setup_peru");
		} else {
			$update = mysqli_query($koneksi, "UPDATE tb_setup_peru SET nama_peru='$nama_peru', alamat='$alamat', pimpinan='$pimpinan' WHERE id_setup_peru='$id_setup_peru'");
			if ($update) {
				$_SESSION['pesan'] = "Good! setup perusahaan success ...";
				header("location:index.php?page=form-view-setup-perusahaan");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>