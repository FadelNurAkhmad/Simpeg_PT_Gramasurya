<div class="row">
<?php
	if ($_POST['save'] == "save") {
	$nama_mastergol	=$_POST['nama_mastergol'];
	
	include "../../config/koneksi.php";
	function kdauto($tabel, $inisial){
		$struktur   = mysql_query("SELECT * FROM $tabel");
		$field      = mysql_field_name($struktur,0);
		$panjang    = mysql_field_len($struktur,0);
		$qry  = mysql_query("SELECT max(".$field.") FROM ".$tabel);
		$row  = mysql_fetch_array($qry);
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

	$cekname	=mysql_num_rows (mysql_query("SELECT nama_mastergol FROM tb_mastergol WHERE nama_mastergol='$_POST[nama_mastergol]'"));
	
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
		$query = mysql_query ($insert);
		
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