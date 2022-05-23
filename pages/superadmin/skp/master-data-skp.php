<div class="row">
<?php
	if (isset($_GET['id_skp'])) {
	$id_skp = $_GET['id_skp'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg					=$_POST['id_peg'];
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
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['id_peg']) || empty($_POST['periode_awal']) || empty($_POST['periode_akhir']) || empty($_POST['penilai']) || empty($_POST['atasan_penilai']) || empty($_POST['hasil_penilaian'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-skp");
		}
		else{
		$insert = "INSERT INTO tb_skp (id_skp, id_peg, periode_awal, periode_akhir, penilai, atasan_penilai, nilai_orientasi, nilai_integritas, nilai_komitmen, nilai_disiplin, nilai_kerjasama, nilai_kepemimpinan, hasil_penilaian)
					VALUES ('$id_skp', '$id_peg', '$periode_awal', '$periode_akhir', '$penilai', '$atasan_penilai', '$nilai_orientasi', '$nilai_integritas', '$nilai_komitmen', '$nilai_disiplin', '$nilai_kerjasama', '$nilai_kepemimpinan', '$hasil_penilaian')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data SKP success ...";
			header("location:index.php?page=form-master-data-skp");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>