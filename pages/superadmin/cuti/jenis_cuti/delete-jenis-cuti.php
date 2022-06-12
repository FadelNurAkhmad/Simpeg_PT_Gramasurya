<div class="row">
	<?php
	include "../../config/koneksi.php";
	if (isset($_GET['id_jenis'])) {
		$id_jenis = $_GET['id_jenis'];

		$query   = mysqli_query($koneksi, "SELECT * FROM tb_jenis_cuti WHERE id_jenis='$id_jenis'");
		$data    = mysqli_fetch_array($query);
	} else {
		die("Error. No ID Selected! ");
	}

	if (!empty($id_jenis) && $id_jenis != "") {
		$delete		= mysqli_query($koneksi, "DELETE FROM tb_jenis_cuti WHERE id_jenis='$id_jenis'");
		if ($delete) {
			$_SESSION['pesan'] = "Good! Delete Jenis Cuti success ...";
			header("location:index.php?page=form-view-jenis-cuti");
		} else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
	?>
</div>