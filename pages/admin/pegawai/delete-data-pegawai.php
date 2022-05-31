<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_peg'])) {
	$id_peg = $_GET['id_peg'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		$nama	=$data['nama'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_peg) && $id_peg != "") {
		$delete	=mysqli_query($koneksi, "DELETE FROM tb_pegawai WHERE id_peg='$id_peg'");
		$delsi = mysqli_query($koneksi, "DELETE FROM tb_suamiistri WHERE id_peg='$id_peg'");
		$delanak = mysqli_query($koneksi, "DELETE FROM tb_anak WHERE id_peg='$id_peg'");
		$delortu = mysqli_query($koneksi, "DELETE FROM tb_ortu WHERE id_peg='$id_peg'");
		$delsek = mysqli_query($koneksi, "DELETE FROM tb_sekolah WHERE id_peg='$id_peg'");
		$delbhs = mysqli_query($koneksi, "DELETE FROM tb_bahasa WHERE id_peg='$id_peg'");
		$delskp = mysqli_query($koneksi, "DELETE FROM tb_skp WHERE id_peg='$id_peg'");
		$deljab = mysqli_query($koneksi, "DELETE FROM tb_jabatan WHERE id_peg='$id_peg'");
		$delpan = mysqli_query($koneksi, "DELETE FROM tb_pangkat WHERE id_peg='$id_peg'");
		$delhuk = mysqli_query($koneksi, "DELETE FROM tb_hukuman WHERE id_peg='$id_peg'");
		$deldik = mysqli_query($koneksi, "DELETE FROM tb_diklat WHERE id_peg='$id_peg'");
		$delpen = mysqli_query($koneksi, "DELETE FROM tb_penghargaan WHERE id_peg='$id_peg'");
		$deltug = mysqli_query($koneksi, "DELETE FROM tb_penugasan WHERE id_peg='$id_peg'");
		$delsem = mysqli_query($koneksi, "DELETE FROM tb_seminar WHERE id_peg='$id_peg'");
		$delcuti = mysqli_query($koneksi, "DELETE FROM tb_cuti WHERE id_peg='$id_peg'");
		$dellatjab = mysqli_query($koneksi, "DELETE FROM tb_lat_jabatan WHERE id_peg='$id_peg'");
		$delmut = mysqli_query($koneksi, "DELETE FROM tb_mutasi WHERE id_peg='$id_peg'");
		$delkgb = mysqli_query($koneksi, "DELETE FROM tb_kgb WHERE id_peg='$id_peg'");
		$delkpb = mysqli_query($koneksi, "DELETE FROM tb_kpb WHERE id_peg='$id_peg'");
		$deltunj = mysqli_query($koneksi, "DELETE FROM tb_tunjangan WHERE id_peg='$id_peg'");
		$delkaw = mysqli_query($koneksi, "DELETE FROM tb_kawin WHERE id_peg='$id_peg'");
		$delspkgb = mysqli_query($koneksi, "DELETE FROM tb_spkgb WHERE id_peg='$id_peg'");
		$delusr = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_peg='$id_peg'");
		
		if($delete){
			$_SESSION['pesan'] = "Good! Delete pegawai $nama success ...";
			header("location:index.php?page=form-view-data-pegawai");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>