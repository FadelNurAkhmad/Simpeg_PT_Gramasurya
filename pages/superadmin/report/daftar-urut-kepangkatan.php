<?php
include "../../config/koneksi.php";
$kepala	= mysqli_query($koneksi, "SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='1'");
$kep	= mysqli_fetch_array($kepala, MYSQLI_ASSOC);
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/report/print-daftar-urut-kepangkatan.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Report <small>DUK</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="table-responsive">
			<h5 align="center">DAFTAR URUT KEPANGKATAN PEGAWAI</h5>
			<h6 align="center" style="text-transform:uppercase"><?= $kep['kab'] ?> TAHUN <?php echo date("Y"); ?></h6>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th rowspan="2">No</th>
						<th colspan="2">NAMA</th>
						<th rowspan="2">NIP</th>
						<th colspan="2">PKT TERAKHIR</th>
						<th colspan="2">JABATAN</th>
						<th rowspan="2">ESL</th>
						<th colspan="2">MK GOL</th>
						<th colspan="2">PEND AKHIR</th>
						<th rowspan="2">KET</th>
					</tr>
					<tr>
						<th colspan="2">TTL</th>
						<th>GOL/RUANG</th>
						<th>TMT</th>
						<th>NAMA</th>
						<th>TMT</th>
						<th>THN</th>
						<th>BLN</th>
						<th>ASAL / TK</th>
						<th>T.LLS</th>
					</tr>
					<tr>
						<th>1</th>
						<th colspan="2">2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
						<th>10</th>
						<th>11</th>
						<th>12</th>
						<th>13</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$idPeg = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE status_kepeg='PNS' AND status_mut='' ORDER BY urut_pangkat DESC");
					while ($peg = mysqli_fetch_array($idPeg, MYSQLI_ASSOC)) {
						$no++
					?>
						<tr>
							<td><?= $no; ?></td>
							<td colspan="2"><?php echo $peg['nama']; ?><br /><?php echo $peg['tempat_lhr']; ?>, <?php echo $peg['tgl_lhr']; ?></td>
							<td><?php echo $peg['nip']; ?></td>
							<td><?php
								$idPan = mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE (id_peg='$peg[id_peg]' AND status_pan='Aktif')");
								$hpan = mysqli_fetch_array($idPan, MYSQLI_ASSOC);
								?>
								<?php echo $hpan['pangkat']; ?><br /><?php echo $hpan['gol']; ?></td>
							<td><?php echo $hpan['tmt_pangkat']; ?></td>
							<td><?php
								$idJab = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE (id_peg='$peg[id_peg]' AND status_jab='Aktif')");
								$hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
								?>
								<?php echo $hjab['jabatan']; ?></td>
							<td><?php echo $hjab['tmt_jabatan']; ?></td>
							<td><?php echo $hjab['eselon']; ?></td>
							<td><?php
								$tgl_sk	= new DateTime($hpan['tgl_sk']);
								$today	= new DateTime();
								$selisih	= $today->diff($tgl_sk);
								echo $selisih->y;
								?>
							</td>
							<td><?php echo $selisih->m; ?></td>
							<td><?php
								$idSek = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE (id_peg='$peg[id_peg]' AND status='Akhir')");
								$hsek = mysqli_fetch_array($idSek, MYSQLI_ASSOC);
								?>
								<?php echo $hsek['nama_sekolah']; ?><br><?php echo $hsek['tingkat']; ?>
							</td>
							<td><?php echo $hsek['tgl_ijazah']; ?></td>
							<td><?php echo $peg['status_kepeg']; ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- end profile-section -->
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