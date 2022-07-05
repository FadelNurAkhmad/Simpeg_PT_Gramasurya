<div class="row">
	<?php
	if (isset($_GET['id_divisi_kpi'])) {
		$id_divisi_kpi = $_GET['id_divisi_kpi'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$query	= mysqli_query($koneksi, "SELECT * FROM tb_divisi_kpi WHERE id_divisi_kpi='$id_divisi_kpi'");
	$hasil	= mysqli_fetch_array($query);
	$notnm	= $hasil['divisi'];

	if ($_POST['edit'] == "edit") {
		$divisi	= $_POST['divisi'];

		$ceknm	= mysqli_num_rows(mysqli_query($koneksi, "SELECT divisi FROM tb_divisi_kpi WHERE divisi='$_POST[divisi]' AND divisi!='$notnm'"));

		if (empty($_POST['divisi'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-divisi-kpi&id_divisi_kpi=$id_divisi_kpi");
		} else if ($ceknm > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-divisi-kpi&id_divisi_kpi=$id_divisi_kpi");
		} else {
			$update = mysqli_query($koneksi, "UPDATE tb_divisi_kpi SET divisi='$divisi' WHERE id_divisi_kpi='$id_divisi_kpi'");
			if ($update) {
				$_SESSION['pesan'] = "Good! Edit Unit Kerja success ...";
				header("location:index.php?page=form-view-divisi-kpi");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>