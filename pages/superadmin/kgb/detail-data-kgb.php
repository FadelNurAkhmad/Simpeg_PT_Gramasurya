<?php	
	if (isset($_GET['id_spkgb'])) {
	$id_spkgb = $_GET['id_spkgb'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	include "../../config/koneksi.php";
	$query	=mysql_query("SELECT * FROM tb_spkgb WHERE id_spkgb='$id_spkgb'");
	$data	=mysql_fetch_array($query);
	
	$tampilPeg   =mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$data[id_peg]'");
	$peg    =mysql_fetch_array($tampilPeg);
	
	$tampilUni   =mysql_query("SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
	$uni    =mysql_fetch_array($tampilUni);
	
	$tampilSek	=mysql_query("SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='1'");
	$set	=mysql_fetch_array($tampilSek);
	
	$kepala	=mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$set[kepala]'");
	$kep	=mysql_fetch_array($kepala);
?>
<!-- begin page-header -->
<h1 class="page-header">Detail <small>KBG</small></h1>
<!-- end page-header -->			
<div class="invoice">
	<div class="invoice-company">
		<span class="pull-right hidden-print">
			<a href="index.php?page=detail-data-pegawai&id_peg=<?=$peg['id_peg']?>" title="back" class="btn btn-sm btn-white m-b-10"><i class="fa fa-step-backward"></i> &nbsp;Back</a>
			<a href="../../pages/superadmin/kgb/print-detail-kgb.php?id_spkgb=<?=$id_spkgb?>" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a>
		</span>
		Detail Kenaikan Gaji Berkala
	</div>
	<div class="invoice-header">
		<div class="invoice-from">
			<strong></strong>
		</div>
		<div class="invoice-to">
			<center>
				NOMOR : <span style="color:red"><?=$data['no_kgb']?></span>
			</center>
		</div>
		<div class="invoice-date">
			<strong></strong>
            <div class="invoice-detail"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="table-responsive">
				<table border="0" width="100%">
					<tr>
						<td colspan="5">Dengan ini diberitahukan bahwa dengan telah dipenuhinya masa kerja dan syarat-syarat lainnya  kepada :</td>
					</tr>
					<tr>
						<td width="15%">&nbsp;</td>
						<td width="5%">1.</td>
						<td width="28%">Nama</td>
						<td width="2%">:</td>
						<td width="50%"><span style="color:red"><?=$peg['nama']?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>2.</td>
						<td>NIP</td>
						<td>:</td>
						<td><span style="color:red"><?=$peg['nip']?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>3.</td>
						<td>Pangkat / Golongan Ruang</td>
						<td>:</td>
						<td><span style="color:red"><?=$peg['pangkat']?> ( <?=$peg['urut_pangkat']?> )</span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>4.</td>
						<td>Kantor / Tempat Bekerja</td>
						<td>:</td>
						<td><span style="color:red"><?=$uni['nama']?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>5.</td>
						<td colspan="3">Gaji Pokok Lama ( Atas Dasar Surat Keputusan Terakhir Tentang Gaji / Pangkat ) yang ditetapkan Oleh :</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>a. Pejabat</td>
						<td>:</td>
						<td><span style="color:red"><?=$data['pejabat_lama']?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>b. Nomor dan Tanggal</td>
						<td>:</td>
						<td><span style="color:red"><?=$data['no_lama']?> Tgl <?=$data['tgl_lama']?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>c. Tanggal berlakunya Gaji</td>
						<td>:</td>
						<td><span style="color:red"><?=$data['tgl_berlaku_lama']?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>d. Masa kerja golongan Gaji pada tanggal tersebut</td>
						<td>:</td>
						<td><span style="color:red"><?=$data['mk_lama']?> Rp <?=number_format($data['gaji_lama'],0,",",".");?></span></td>
					</tr>
					<tr>
						<td colspan="5">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="4">Diberikan Kenaikan Gaji Berkala Hingga Memperoleh  :</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>6.</td>
						<td>Gaji Pokok Baru</td>
						<td>:</td>
						<td><span style="color:red">Rp <?=number_format($data['gaji_baru'],0,",",".");?> ( <?=$data['terbilang_gajibaru']?> )</span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>7.</td>
						<td>Berdasarkan Masa Kerja</td>
						<td>:</td>
						<td><span style="color:red"><?=$data['mk_baru']?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>8.</td>
						<td>Dalam Golongan Ruang</td>
						<td>:</td>
						<td><span style="color:red"><?=$data['gol_baru']?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>9.</td>
						<td>Terhitung Mulai Tanggal</td>
						<td>:</td>
						<td><span style="color:red"><?=$data['tgl_terhitung']?></span></td>
					</tr>
				</table><br />
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr>
						<td>Diharapkan agar sesuai dengan Peraturan Pemerintah Nomor : 25 Tahun 2010, maka kepada Pegawai Negeri Sipil tersebut dapat dibayarkan penghasilannya berdasarkan Gaji Pokok Baru.</td>
					</tr>
				</table><br /><br />
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr align="center">
						<td width="50%">&nbsp;</td>
						<td width="50%">KEPALA BADAN KEPEGAWAIAN DAERAH</td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td style="text-transform:uppercase">KABUPATEN <?=$set['kab']?></td>
					</tr>
					<tr>
						<td height="50">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td><span style="color:red"><?=$kep['nama']?></span></td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td>NIP : <span style="color:red"><?=$kep['nip']?></span></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>