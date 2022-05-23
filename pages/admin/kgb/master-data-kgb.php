<div class="row">
<?php
	if (isset($_GET['id_spkgb']) AND ($_GET['id_peg'])) {
		$id_spkgb = $_GET['id_spkgb'];
		$id_peg = $_GET['id_peg'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$no_kgb			=$_POST['no_kgb'];
	$tgl			=$_POST['tgl'];
	$pejabat_lama	=$_POST['pejabat_lama'];
	$no_lama		=$_POST['no_lama'];
	$tgl_lama		=$_POST['tgl_lama'];
	$tgl_berlaku_lama	=$_POST['tgl_berlaku_lama'];
	$mk_lama		=$_POST['mk_lama'];
	$gaji_lama		=$_POST['gaji_lama'];
	$gaji_baru		=$_POST['gaji_baru'];
	$terbilang_gajibaru	=$_POST['terbilang_gajibaru'];
	$mk_baru		=$_POST['mk_baru'];
	$gol_baru		=$_POST['gol_baru'];
	$tgl_terhitung	=$_POST['tgl_terhitung'];
	$tembusan1		=$_POST['tembusan1'];
	$tembusan2		=$_POST['tembusan2'];
	$tembusan3		=$_POST['tembusan3'];
	$tembusan4		=$_POST['tembusan4'];
	$tembusan5		=$_POST['tembusan5'];
	$tembusan6		=$_POST['tembusan6'];
	$tembusan7		=$_POST['tembusan7'];
	$tembusan8		=$_POST['tembusan8'];
	$tembusan9		=$_POST['tembusan9'];
	$tembusan10		=$_POST['tembusan10'];
	$tembusan11		=$_POST['tembusan11'];
	$tembusan12		=$_POST['tembusan12'];
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['no_kgb']) || empty($_POST['tgl']) || empty($_POST['no_lama']) || empty($_POST['gaji_lama']) || empty($_POST['terbilang_gajibaru']) || empty($_POST['tgl_terhitung']) || empty($_POST['tembusan1'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-kgb&id_peg=$id_peg");
		}
		
		else{
		$insert = "INSERT INTO tb_spkgb (id_spkgb, id_peg, no_kgb, tgl, pejabat_lama, no_lama, tgl_lama, tgl_berlaku_lama, mk_lama, gaji_lama, gaji_baru, terbilang_gajibaru, mk_baru, gol_baru, tgl_terhitung, tembusan1, tembusan2, tembusan3, tembusan4, tembusan5, tembusan6, tembusan7, tembusan8, tembusan9, tembusan10, tembusan11, tembusan12)
		VALUES ('$id_spkgb', '$id_peg', '$no_kgb', '$tgl', '$pejabat_lama', '$no_lama', '$tgl_lama', '$tgl_berlaku_lama', '$mk_lama', '$gaji_lama', '$gaji_baru', '$terbilang_gajibaru', '$mk_baru', '$gol_baru', '$tgl_terhitung', '$tembusan1', '$tembusan2', '$tembusan3', '$tembusan4', '$tembusan5', '$tembusan6', '$tembusan7', '$tembusan8', '$tembusan9', '$tembusan10', '$tembusan11', '$tembusan12')";
		$query = mysql_query ($insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data KGB success ...";
			header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>