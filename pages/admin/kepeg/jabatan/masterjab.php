<div class="row">
<?php
	if ($_POST['save'] == "save") {
	$nama_masterjab	=$_POST['nama_masterjab'];
	
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
	$id_masterjab		=kdauto("tb_masterjab","");

	$cekname	=mysqli_num_rows (mysqli_query($koneksi, "SELECT nama_masterjab FROM tb_masterjab WHERE nama_masterjab='$_POST[nama_masterjab]'"));
	
		if (empty($_POST['nama_masterjab'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-jabatan");
		}
		else if($cekname > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-jabatan");
		}
		
		else{
		$insert = "INSERT INTO tb_masterjab (id_masterjab, nama_masterjab) VALUES ('$id_masterjab', '$nama_masterjab')";
		$query = mysqli_query ($koneksi, $insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert master nama jabatan success ...";
			header("location:index.php?page=form-master-data-jabatan");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>