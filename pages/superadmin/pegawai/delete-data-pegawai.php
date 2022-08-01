<div class="row">
	<?php
	include "../../config/koneksi.php";
	if (isset($_GET['pegawai_id'])) {
		$id_peg = $_GET['pegawai_id'];

		$query   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$id_peg'");
		$data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
		$nama	= $data['pegawai_nama'];
	} else {
		die("Error. No ID Selected! ");
	}

	if (!empty($id_peg) && $id_peg != "") {
		$delpeg	= mysqli_query($koneksi, "DELETE FROM pegawai WHERE pegawai_id='$id_peg'");
		$delpegd = mysqli_query($koneksi, "DELETE FROM pegawai_d WHERE pegawai_id='$id_peg'");
		$delete	= mysqli_query($koneksi, "DELETE FROM tb_pegawai WHERE pegawai_id='$id_peg'");
		$delsi = mysqli_query($koneksi, "DELETE FROM tb_suamiistri WHERE id_peg='$id_peg'");
		$delanak = mysqli_query($koneksi, "DELETE FROM tb_anak WHERE id_peg='$id_peg'");
		$delortu = mysqli_query($koneksi, "DELETE FROM tb_ortu WHERE id_peg='$id_peg'");
		$delsek = mysqli_query($koneksi, "DELETE FROM tb_sekolah WHERE id_peg='$id_peg'");
		$delbhs = mysqli_query($koneksi, "DELETE FROM tb_bahasa WHERE id_peg='$id_peg'");
		$deljab = mysqli_query($koneksi, "DELETE FROM tb_jabatan WHERE id_peg='$id_peg'");
		$delhuk = mysqli_query($koneksi, "DELETE FROM tb_pembinaan WHERE id_peg='$id_peg'");
		$delpen = mysqli_query($koneksi, "DELETE FROM tb_penghargaan WHERE id_peg='$id_peg'");
		$deltug = mysqli_query($koneksi, "DELETE FROM tb_penugasan WHERE id_peg='$id_peg'");
		$delmut = mysqli_query($koneksi, "DELETE FROM tb_mutasi WHERE id_peg='$id_peg'");
		$deltunj = mysqli_query($koneksi, "DELETE FROM tb_tunjangan WHERE id_peg='$id_peg'");
		$delkaw = mysqli_query($koneksi, "DELETE FROM tb_kawin WHERE id_peg='$id_peg'");
		$delusr = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_peg='$id_peg'");
		$delapproval1 = mysqli_query($koneksi, "DELETE FROM tb_approval_cuti_tahunan WHERE id_peg='$id_peg'");
		$delapproval2 = mysqli_query($koneksi, "DELETE FROM tb_approval_cuti_umum WHERE id_peg='$id_peg'");
		$delcutitahunan = mysqli_query($koneksi, "DELETE FROM tb_cuti_tahunan WHERE id_peg='$id_peg'");
		$delcutiumum = mysqli_query($koneksi, "DELETE FROM tb_cuti_umum WHERE id_peg='$id_peg'");
		$deldok = mysqli_query($koneksi, "DELETE FROM tb_dokumen WHERE id_peg='$id_peg'");
		$delgaji = mysqli_query($koneksi, "DELETE FROM tb_gaji_konfigurasi WHERE id_peg='$id_peg'");
		$deljatahcuti = mysqli_query($koneksi, "DELETE FROM tb_jatah_cuti WHERE id_peg='$id_peg'");
		$delkpi = mysqli_query($koneksi, "DELETE FROM tb_kpi WHERE id_peg='$id_peg'");
		$dellokasi = mysqli_query($koneksi, "DELETE FROM tb_lokasi WHERE id_peg='$id_peg'");
		$deltempat = mysqli_query($koneksi, "DELETE FROM tb_tempat WHERE id_peg='$id_peg'");

		if ($delete && $delpeg && $delpegd) {
			$_SESSION['pesan'] = "Good! Delete pegawai $nama success ...";
			header("location:index.php?page=form-view-data-pegawai");
		} else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
	?>
</div>