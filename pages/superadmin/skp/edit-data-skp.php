<div class="row">
<?php
	if (isset($_GET['id_skp'])) {
	$id_skp = $_GET['id_skp'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilskp	= mysql_query("SELECT * FROM tb_skp WHERE id_skp='$id_skp'");
	$hasil	= mysql_fetch_array ($tampilskp);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$periode_awal			=$_POST['periode_awal'];
	$periode_akhir			=$_POST['periode_akhir'];
	$penilai				=$_POST['penilai'];
	$atasan_penilai			=$_POST['atasan_penilai'];
	$nilai_orientasi		=$_POST['nilai_orientasi'];
	$nilai_integritas		=$_POST['nilai_integritas'];
	$nilai_komitmen			=$_POST['nilai_komitmen'];
	$nilai_disiplin			=$_POST['nilai_disiplin'];
	$nilai_kerjasama		=$_POST['nilai_kerjasama'];
	$nilai_kepemimpinan		=$_POST['nilai_kepemimpinan'];
	$hasil_penilaian		=$_POST['hasil_penilaian'];
	
	$jml_nilai	=($nilai_orientasi+$nilai_integritas+$nilai_komitmen+$nilai_disiplin+$nilai_kerjasama+$nilai_kepemimpinan)/6;
	
		if (empty($_POST['periode_awal']) || empty($_POST['periode_akhir']) || empty($_POST['penilai']) || empty($_POST['atasan_penilai']) || empty($_POST['hasil_penilaian'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-skp&id_skp=$id_skp");
		}		
		else{
		$update= mysql_query ("UPDATE tb_skp SET periode_awal='$periode_awal', periode_akhir='$periode_akhir', penilai='$penilai', atasan_penilai='$atasan_penilai', nilai_orientasi='$nilai_orientasi', nilai_integritas='$nilai_integritas', nilai_komitmen='$nilai_komitmen', nilai_disiplin='$nilai_disiplin', nilai_kerjasama='$nilai_kerjasama', nilai_kepemimpinan='$nilai_kepemimpinan', hasil_penilaian='$hasil_penilaian' WHERE id_skp='$id_skp'");
		
		if($update){
				$_SESSION['pesan'] = "Good! edit data SKP success ...";
				header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>