<div class="row">
	<?php
	include "../../config/koneksi.php";
	if (isset($_GET['id_hukuman'])) {
		$id_hukuman = $_GET['id_hukuman'];

		$query   = mysqli_query($koneksi, "SELECT * FROM tb_hukuman WHERE id_hukuman='$id_hukuman'");
		$data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	= $data['id_peg'];
	} else {
		die("Error. No ID Selected! ");
	}

	if (!empty($id_hukuman) && $id_hukuman != "") {
		$delete	= mysqli_query($koneksi, "DELETE FROM tb_hukuman WHERE id_hukuman='$id_hukuman'");
		if ($delete) {
			$_SESSION['pesan'] = "Good! delete hukuman success ...";
			header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
		} else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
	?>
</div>