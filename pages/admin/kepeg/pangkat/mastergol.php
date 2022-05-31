<div class="row">
<?php
	if ($_POST['save'] == "save") {
	$nama_mastergol	=$_POST['nama_mastergol'];
	
	include "../../config/koneksi.php";
	function kdauto($tabel, $inisial){
		$struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
		$field      = mysqli_field_name($struktur,0);
		$panjang    = mysqli_field_len($struktur,0);
		$qry  = mysqli_query($koneksi, "SELECT max(".$field.") FROM ".$tabel);
		$row  = mysqli_fetch_array($qry, MYSQLI_ASSOC);
		if ($row[0]=="") {
		$angka=0;
		}
		else {
		$angka= substr($row[0], strlen($inisial));
		}
		$angka++;
		$angka      =strval($angka);
		$tmp  ="";
		for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";
		}
		return $inisial.$tmp.$angka;
		}
	$id_mastergol		=kdauto("tb_mastergol","");

	$cekname	=mysqli_num_rows (mysqli_query($koneksi, "SELECT nama_mastergol FROM tb_mastergol WHERE nama_mastergol='$_POST[nama_mastergol]'"));
	
		if (empty($_POST['nama_mastergol'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-pangkat");
		}
		else if($cekname > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-pangkat");
		}
		
		else{
		$insert = "INSERT INTO tb_mastergol (id_mastergol, nama_mastergol) VALUES ('$id_mastergol', '$nama_mastergol')";
		$query = mysqli_query ($koneksi, $insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert master nama golongan success ...";
			header("location:index.php?page=form-master-data-pangkat");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>