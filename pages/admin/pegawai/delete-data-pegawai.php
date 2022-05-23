<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_peg'])) {
	$id_peg = $_GET['id_peg'];
	
	$query   =mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
	$data    =mysql_fetch_array($query);
		$nama	=$data['nama'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_peg) && $id_peg != "") {
		$delete	=mysql_query("DELETE FROM tb_pegawai WHERE id_peg='$id_peg'");
		$delsi = mysql_query("DELETE FROM tb_suamiistri WHERE id_peg='$id_peg'");
		$delanak = mysql_query("DELETE FROM tb_anak WHERE id_peg='$id_peg'");
		$delortu = mysql_query("DELETE FROM tb_ortu WHERE id_peg='$id_peg'");
		$delsek = mysql_query("DELETE FROM tb_sekolah WHERE id_peg='$id_peg'");
		$delbhs = mysql_query("DELETE FROM tb_bahasa WHERE id_peg='$id_peg'");
		$delskp = mysql_query("DELETE FROM tb_skp WHERE id_peg='$id_peg'");
		$deljab = mysql_query("DELETE FROM tb_jabatan WHERE id_peg='$id_peg'");
		$delpan = mysql_query("DELETE FROM tb_pangkat WHERE id_peg='$id_peg'");
		$delhuk = mysql_query("DELETE FROM tb_hukuman WHERE id_peg='$id_peg'");
		$deldik = mysql_query("DELETE FROM tb_diklat WHERE id_peg='$id_peg'");
		$delpen = mysql_query("DELETE FROM tb_penghargaan WHERE id_peg='$id_peg'");
		$deltug = mysql_query("DELETE FROM tb_penugasan WHERE id_peg='$id_peg'");
		$delsem = mysql_query("DELETE FROM tb_seminar WHERE id_peg='$id_peg'");
		$delcuti = mysql_query("DELETE FROM tb_cuti WHERE id_peg='$id_peg'");
		$dellatjab = mysql_query("DELETE FROM tb_lat_jabatan WHERE id_peg='$id_peg'");
		$delmut = mysql_query("DELETE FROM tb_mutasi WHERE id_peg='$id_peg'");
		$delkgb = mysql_query("DELETE FROM tb_kgb WHERE id_peg='$id_peg'");
		$delkpb = mysql_query("DELETE FROM tb_kpb WHERE id_peg='$id_peg'");
		$deltunj = mysql_query("DELETE FROM tb_tunjangan WHERE id_peg='$id_peg'");
		$delkaw = mysql_query("DELETE FROM tb_kawin WHERE id_peg='$id_peg'");
		$delspkgb = mysql_query("DELETE FROM tb_spkgb WHERE id_peg='$id_peg'");
		$delusr = mysql_query("DELETE FROM tb_user WHERE id_peg='$id_peg'");
		
		if($delete){
			$_SESSION['pesan'] = "Good! Delete pegawai $nama success ...";
			header("location:index.php?page=form-view-data-pegawai");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysql_close($Open);
?>
</div>