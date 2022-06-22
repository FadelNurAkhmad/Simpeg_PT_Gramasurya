<div class="row">
	<?php
	if (isset($_GET['id_jenis'])) {
		$id_jenis = $_GET['id_jenis'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$query	= mysqli_query($koneksi, "SELECT * FROM tb_jenis_cuti WHERE id_jenis='$id_jenis'");
	$hasil	= mysqli_fetch_array($query);
	$notnm	= $hasil['jenis'];

	if ($_POST['edit'] == "edit") {
		$jenis	= $_POST['jenis'];

		$ceknm	= mysqli_num_rows(mysqli_query($koneksi, "SELECT jenis FROM tb_jenis_cuti WHERE jenis='$_POST[jenis]' AND jenis!='$notnm'"));

		if (empty($_POST['jenis'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-jenis-cuti&id_jenis=$id_jenis");
		} else if ($ceknm > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-jenis-cuti&id_jenis=$id_jenis");
		} else {
			$update = mysqli_query($koneksi, "UPDATE tb_jenis_cuti SET jenis='$jenis' WHERE id_jenis='$id_jenis'");
			if ($update) {
				$_SESSION['pesan'] = "Good! Edit Unit Kerja success ...";
				header("location:index.php?page=form-view-jenis-cuti");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>