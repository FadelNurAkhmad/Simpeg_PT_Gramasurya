<?php
if (isset($_GET['id_cuti'])) {
	$id_cuti = $_GET['id_cuti'];
} else {
	die("Error. No ID Selected! ");
}
include "../../config/koneksi.php";
$query	= mysqli_query($koneksi, "SELECT * FROM tb_cuti WHERE id_cuti='$id_cuti'");
$data	= mysqli_fetch_array($query, MYSQLI_ASSOC);

$tampilPeg   = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$data[id_peg]'");
$peg    = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);

$tampilUni   = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
$uni    = mysqli_fetch_array($tampilUni, MYSQLI_ASSOC);

$tampilsek	= mysqli_query($koneksi, "SELECT * FROM tb_setup_sekda WHERE id_setup_sekda='1'");
$setsek	= mysqli_fetch_array($tampilsek, MYSQLI_ASSOC);

$sekda	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$setsek[sekda]'");
$sek	= mysqli_fetch_array($sekda, MYSQLI_ASSOC);
?>
<!-- begin page-header -->
<h1 class="page-header">Detail <small>Cuti</small></h1>
<!-- end page-header -->
<div class="invoice">
	<div class="invoice-company">
		<span class="pull-right hidden-print">
			<a href="index.php?page=detail-data-pegawai&id_peg=<?= $peg['id_peg'] ?>" title="back" class="btn btn-sm btn-white m-b-10"><i class="fa fa-step-backward"></i> &nbsp;Back</a>
			<a href="../../pages/admin/kepeg/cuti/print-detail-cuti.php?id_cuti=<?= $id_cuti ?>" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a>
		</span>
		Detail Cuti Pegawai
	</div>
	<div class="invoice-header">
		<div class="invoice-from">
			<strong></strong>
		</div>
		<div class="invoice-to">
			<center>
				<strong><u>SURAT IZIN CUTI <span style="text-transform:uppercase;color:red"><?= $data['jns_cuti'] ?></span></u></strong>
				<br />
				NOMOR : <span style="color:red"><?= $data['no_suratcuti'] ?></span>
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
						<td colspan="4">Diberikan Cuti <span style="color:red"><?= $data['jns_cuti'] ?></span> kepada Pegawai Negeri Sipil :</td>
					</tr>
					<tr>
						<td width="8%">&nbsp;</td>
						<td width="25%">Nama</td>
						<td width="2%">:</td>
						<td width="65%"><span style="color:red"><?= $peg['nama'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>NIP</td>
						<td>:</td>
						<td><span style="color:red"><?= $peg['nip'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Pangkat / Golongan Ruang</td>
						<td>:</td>
						<td><span style="color:red"><?= $peg['pangkat'] ?> ( <?= $peg['urut_pangkat'] ?> )</span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Jabatan</td>
						<td>:</td>
						<td><span style="color:red"><?= $peg['jabatan'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Satuan Organisasi</td>
						<td>:</td>
						<td><span style="color:red"><?= $uni['nama'] ?></span></td>
					</tr>
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4">Selama <span style="color:red"><?= $data['lama'] ?> (<?= $data['lama_terbilang'] ?>) <?= $data['lama_satuan'] ?></span>, Terhitung Mulai Tanggal <span style="color:red"><?= $data['tgl_mulai'] ?></span> sampai dengan tanggal <span style="color:red"><?= $data['tgl_selesai'] ?></span> , dengan ketentuan sebagai berikut :</td>
					</tr>
				</table>
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr>
						<td width="8%">&nbsp;</td>
						<td width="92%"><?= $data['point1'] ?> <?= $data['ket1'] ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><?= $data['point2'] ?> <?= $data['ket2'] ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><?= $data['point3'] ?> <?= $data['ket3'] ?></td>
					</tr>
				</table><br />
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr>
						<td>Demikian Surat Cuti <span style="color:red"><?= $data['jns_cuti'] ?></span> ini dibuat untuk dapat digunakan sebagaimana mestinya.</td>
					</tr>
				</table><br /><br />
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr align="center">
						<td width="65%">&nbsp;</td>
						<td width="35%"><span style="color:red">Yogyakarta , <?= $data['tgl_suratcuti'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<!-- <td style="text-transform:uppercase">An. BUPATI <?= $setsek['kab'] ?></td> -->
						<td style="text-transform:uppercase">An. PIMPINAN PERUSAHAAN</td>
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
						<td><span style="color:red"><?= $sek['nama'] ?></span></td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td><span style="color:red"><?= $sek['pangkat'] ?></span></td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td>NIP : <span style="color:red"><?= $sek['nip'] ?></span></td>
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