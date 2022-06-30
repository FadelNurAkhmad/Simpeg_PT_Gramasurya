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
		$nip			= $_POST['pegawai_nip'];
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

		$ceknip	= mysqli_num_rows(mysqli_query($koneksi, "SELECT pegawai_nip FROM pegawai WHERE pegawai_nip='$_POST[pegawai_nip]' AND pegawai_nip!='$notnip'"));

		if (empty($_POST['pegawai_nip']) || empty($_POST['pegawai_nama']) || empty($_POST['tempat_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['agama']) || empty($_POST['gender']) || empty($_POST['gol_darah']) || empty($_POST['stat_nikah'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-pegawai&id_peg=$id_peg");
		} else if ($ceknip > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-data-pegawai&id_peg=$id_peg");
		} else {
			$update = mysqli_query($koneksi, "UPDATE pegawai SET pegawai_nip='$nip', pegawai_nama='$nama', tempat_lahir='$tempat_lhr', tgl_lahir='$tgl_lhr', gender='$jk', pegawai_telp='$telp' WHERE pegawai_id='$id_peg'");
			$update2 = mysqli_query($koneksi, "UPDATE pegawai_d SET agama='$agama', gol_darah='$gol_darah', stat_nikah='$status_nikah', alamat='$alamat' WHERE pegawai_id='$id_peg'");
			$update3 = mysqli_query($koneksi, "UPDATE tb_pegawai SET email='$email', tgl_pensiun='$tgl_pensiun', sisa_cuti='$sisa_cuti' WHERE pegawai_id='$id_peg'");
			$updateusr = mysqli_query($koneksi, "UPDATE tb_user SET id_user='$nip', nama_user='$nama' WHERE id_peg='$id_peg'");

			// // kgb //
			// $delkgb	=mysqli_query($koneksi, "DELETE FROM tb_kgb WHERE id_peg='$id_peg'");
			// $beging = new DateTime($tgl_naikgaji);
			// $endg = new DateTime($tgl_pensiun);
			// 	for($ig = $beging; $beging <= $endg; $ig->modify('+2 year')){	
			// 		$ig->format("Y-m-d");
			// 		$tgl_kgb = $ig->format("Y-m-d");

			// 		$values = "($id_peg, '$tgl_kgb')";
			// 		$insertkgb	= mysqli_query($koneksi, "INSERT INTO tb_kgb (id_peg, tgl_kgb) VALUES " . $values);
			// 	}

			// 	// kpb //
			// 	$delkpb = mysqli_query($koneksi, "DELETE FROM tb_kpb WHERE id_peg='$id_peg'");
			// 	$beginp = new DateTime($tgl_naikpangkat);
			// 	$endp = new DateTime($tgl_pensiun);
			// 	for ($ip = $beginp; $beginp <= $endp; $ip->modify('+4 year')) {
			// 		$ip->format("Y-m-d");
			// 		$tgl_kpb = $ip->format("Y-m-d");

			// 		$valuesp = "($id_peg, '$tgl_kpb')";
			// 		$insertkpb	= mysqli_query($koneksi, "INSERT INTO tb_kpb (id_peg, tgl_kpb) VALUES " . $valuesp);
			// 	}

			if ($update) {
				$_SESSION['pesan'] = "Good! Edit pegawai $hasil[nip] success ...";
				header("location:index.php?page=form-view-data-pegawai");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>