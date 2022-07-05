<div class="row">
	<?php
	include "../../config/koneksi.php";
	if (isset($_GET['id_divisi_kpi'])) {
		$id_divisi_kpi = $_GET['id_divisi_kpi'];

		$query   = mysqli_query($koneksi, "SELECT * FROM tb_divisi_kpi WHERE id_divisi_kpi='$id_divisi_kpi'");
		$data    = mysqli_fetch_array($query);
	} else {
		die("Error. No ID Selected! ");
	}

	if (!empty($id_divisi_kpi) && $id_divisi_kpi != "") {
		$delete		= mysqli_query($koneksi, "DELETE FROM tb_divisi_kpi WHERE id_divisi_kpi='$id_divisi_kpi'");
		if ($delete) {
			$_SESSION['pesan'] = "Good! Delete Jenis Cuti success ...";
			header("location:index.php?page=form-view-divisi-kpi");
		} else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
	?>
</div>