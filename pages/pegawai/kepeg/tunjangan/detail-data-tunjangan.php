<?php
if (isset($_GET['id_tunjangan'])) {
	$id_tunjangan = $_GET['id_tunjangan'];
} else {
	die("Error. No ID Selected! ");
}
include "../../config/koneksi.php";
$query	= mysqli_query($koneksi, "SELECT * FROM tb_tunjangan WHERE id_tunjangan='$id_tunjangan'");
$data	= mysqli_fetch_array($query);

$tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$data[id_peg]'");
$peg    = mysqli_fetch_array($tampilPeg);

$tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$data[id_peg]'");
$jab    = mysqli_fetch_array($tampilJab);

// $tampilUni   = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
// $uni    = mysqli_fetch_array($tampilUni);

$tampilPeru	= mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
$peru	= mysqli_fetch_array($tampilPeru);

$pimpinan	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$peru[pimpinan]'");
$pim	= mysqli_fetch_array($pimpinan);

$tampilJab2   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peru[pimpinan]'");
$jab2    = mysqli_fetch_array($tampilJab2);
?>
<!-- begin page-header -->
<h1 class="page-header">Detail <small>Surat Perintah Tunjangan</small></h1>
<!-- end page-header -->
<div class="invoice">
	<div class="invoice-company">
		<span class="pull-right hidden-print">
			<a href="index.php?page=detail-data-pegawai&pegawai_id=<?= $data['id_peg'] ?>" title="back" class="btn btn-sm btn-white m-b-10"><i class="fa fa-step-backward"></i> &nbsp;Back</a>
			<a href="../../pages/superadmin/kepeg/tunjangan/print-detail-tunjangan.php?id_tunjangan=<?= $id_tunjangan ?>" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a>
		</span>
		Detail Surat Perintah Tunjangan Pegawai
	</div>
	<div class="invoice-header">
		<div class="invoice-from">
			<strong></strong>
		</div>
		<div class="invoice-to">
			<center>
				<strong><u>SURAT PERINTAH</u></strong>
				<br />
				NOMOR : <span style="color:red"><?= $data['no_tunjangan'] ?></span>
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
						<td colspan="4">Bersama ini diberitahukan bahwa :</td>
					</tr>
					<tr>
						<td width="8%">&nbsp;</td>
						<td width="25%">Nama</td>
						<td width="2%">:</td>
						<td width="65%"><span style="color:red"><?= $peg['pegawai_nama'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>NIP</td>
						<td>:</td>
						<td><span style="color:red"><?= $peg == 0 ? '-' : $peg['pegawai_nip']; ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Jabatan</td>
						<td>:</td>
						<td><span style="color:red"><?= $jab == 0 ? '-' : $jab['jabatan']; ?></span></td>
					</tr>
					<!-- <tr>
						<td>&nbsp;</td>
						<td>Satuan Organisasi</td>
						<td>:</td>
						<td><span style="color:red"><?= $uni['nama'] ?></span></td>
					</tr> -->
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4">Berdasarkan Surat Kutipan Akta Perkawinan dari <span style="color:red"><?= $data['akta_kawin'] ?></span>, Nomor : <span style="color:red"><?= $data['no_akta_kawin'] ?></span> tanggal : <span style="color:red"><?= $data['tgl_akta_kawin'] ?></span> , dan Akta Kelahiran dari <span style="color:red"><?= $data['akta_lahir'] ?></span>, Nomor : <span style="color:red"><?= $data['no_akta_lahir'] ?></span> tanggal : <span style="color:red"><?= $data['tgl_akta_lahir'] ?></span> , maka kepada Pegawai tersebut dapat dibayarkan Tunjangan <span style="color:red"><?= $data['jns_tunjangan'] ?></span>, terhitung mulai tanggal :</td>
					</tr>
				</table>
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr align="center">
						<td width="100%">------------------------------------------ <span style="color:red"><?= $data['tgl_terhitung'] ?></span> ------------------------------------------</td>
					</tr>
				</table><br />
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr>
						<td>Demikian untuk dapat dipergunakan seperlunya.</td>
					</tr>
				</table><br /><br />
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr align="center">
						<td width="75%">&nbsp;</td>
						<td width="25%" style="text-transform:uppercase">An. PIMPINAN PERUSAHAAN></td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td>PT GRAMASURYA</td>
					</tr>
					<tr>
						<td height="50">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td><span style="color:red"><?= $pim['pegawai_nama'] ?></span></td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td><span style="color:red"><?= $jab2 == 0 ? '-' : $jab2['jabatan']; ?></span></td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td>NIP : <span style="color:red"><?= $pim['pegawai_nip'] ?></span></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	// 500 = 0,5 s
	$(document).ready(function() {
		setTimeout(function() {
			$(".pesan").fadeIn('slow');
		}, 500);
	});
	setTimeout(function() {
		$(".pesan").fadeOut('slow');
	}, 7000);
</script>