<div class="row">
	<?php
	if (isset($_GET['pegawai_id'])) {
		$id_peg = $_GET['pegawai_id'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$tampilPro	= mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id = tb_pegawai.pegawai_id WHERE pegawai.pegawai_id='$id_peg'");
	$hasil	= mysqli_fetch_array($tampilPro, MYSQLI_ASSOC);
	$notnip	= $hasil['pegawai_nip'];

	if ($_POST['edit'] == "edit") {
		$pin			= $_POST['pegawai_pin'];
		$nip			= $_POST['pegawai_nip'];
		$pegawai_status = $_POST['pegawai_status'];
		$nama			= $_POST['pegawai_nama'];
		$tempat_lhr		= $_POST['tempat_lahir'];
		$tgl_lhr		= $_POST['tgl_lahir'];
		$agama			= $_POST['agama'];
		$jk				= $_POST['gender'];
		$gol_darah		= $_POST['gol_darah'];
		$status_nikah	= $_POST['stat_nikah'];
		// $status_kepeg	=$_POST['status_kepeg'];	
		// $tgl_naikpangkat=$_POST['tgl_naikpangkat'];	
		// $tgl_naikgaji	=$_POST['tgl_naikgaji'];	
		$alamat			= $_POST['alamat'];
		$telp			= $_POST['telp'];
		$email			= $_POST['email'];
		// $id_unit		=$_POST['id_unit'];
		// $sisa_cuti		= $_POST['sisa_cuti'];

		$pensiun = new DateTime($tgl_lhr);
		$pensiun->modify('+58 year');
		$pensiun->format('Y-m-d');
		$tgl_pensiun = $pensiun->format('Y-m-d');

		$cekpin	= mysqli_num_rows(mysqli_query($koneksi, "SELECT pegawai_pin FROM pegawai WHERE pegawai_pin='$_POST[pin]'"));
		$ceknip	= mysqli_num_rows(mysqli_query($koneksi, "SELECT pegawai_nip FROM pegawai WHERE pegawai_nip='$_POST[pegawai_nip]' AND pegawai_nip!='$notnip'"));

		if (empty($_POST['pegawai_nip']) || empty($_POST['pegawai_nama']) || empty($_POST['tempat_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['agama']) || empty($_POST['gender']) || empty($_POST['gol_darah']) || empty($_POST['stat_nikah'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-pegawai&id_peg=$id_peg");
		} else if ($ceknip > 0 || $cekpin > 0) {
			$_SESSION['pesan'] = "Oops! NIP atau PIN telah terpakai ...";
			header("location:index.php?page=form-edit-data-pegawai&id_peg=$id_peg");
		} else {
			$updtPegawai = mysqli_query($koneksi, "UPDATE pegawai SET pegawai_pin='$pin', pegawai_nip='$nip', pegawai_nama='$nama', pegawai_status='$pegawai_status', tempat_lahir='$tempat_lhr', tgl_lahir='$tgl_lhr', gender='$jk', pegawai_telp='$telp' WHERE pegawai_id='$id_peg'");
			$updtPegawai_d = mysqli_query($koneksi, "UPDATE pegawai_d SET agama='$agama', gol_darah='$gol_darah', stat_nikah='$status_nikah', alamat='$alamat' WHERE pegawai_id='$id_peg'");
			$updtTb_pegawai = mysqli_query($koneksi, "UPDATE tb_pegawai SET email='$email', tgl_pensiun='$tgl_pensiun', sisa_cuti='$sisa_cuti' WHERE pegawai_id='$id_peg'");

			if ($pegawai_status == 1) {
				$updtUser = mysqli_query($koneksi, "UPDATE tb_user SET id_user='$nip', nama_user='$nama' WHERE id_peg='$id_peg'");

				if ($updtPegawai && $updtPegawai_d && $updtTb_pegawai && $updtUser) {
					$_SESSION['pesan'] = "Good! Edit pegawai $hasil[nip] success ...";
					header("location:index.php?page=form-view-data-pegawai");
				} else {
					echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
				}
			} else {
				$delusr = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_peg='$id_peg'");

				if ($updtPegawai && $updtPegawai_d && $updtTb_pegawai && $delusr) {
					$_SESSION['pesan'] = "Good! Edit pegawai $hasil[nip] success ...";
					header("location:index.php?page=form-view-data-pegawai");
				} else {
					echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
				}
			}
		}
	}
	?>
</div>