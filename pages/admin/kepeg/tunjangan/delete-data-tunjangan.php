<div class="row">
	<?php
	include "../../config/koneksi.php";
	if (isset($_GET['id_tunjangan'])) {
		$id_tunjangan = $_GET['id_tunjangan'];

		$query   = mysqli_query($koneksi, "SELECT * FROM tb_tunjangan WHERE id_tunjangan='$id_tunjangan'");
		$data    = mysqli_fetch_array($query);
		$id_peg	= $data['id_peg'];
	} else {
		die("Error. No ID Selected! ");
	}

	if (!empty($id_tunjangan) && $id_tunjangan != "") {
		$delete	= mysqli_query($koneksi, "DELETE FROM tb_tunjangan WHERE id_tunjangan='$id_tunjangan'");
		if ($delete) {
			$_SESSION['pesan'] = "Good! delete tunjangan success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		} else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
	?>
</div>