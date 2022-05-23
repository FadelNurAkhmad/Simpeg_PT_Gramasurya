<?php
	include "../../config/koneksi.php";
	$kepala	=mysql_query("SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='1'");
	$kep	=mysql_fetch_array($kepala);
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/admin/report/print-nominatif.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Report <small>Nominatif</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="table-responsive">
			<h5 align="center">DAFTAR NOMINATIF PEGAWAI NEGERI SIPIL</h5>
			<h6 align="center" style="text-transform:uppercase">PER <?php echo date("j F Y");?></h6>
			<h6 style="text-transform:uppercase">PEMERINTAH KABUPATEN <?=$kep['kab']?></h6>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th rowspan="2">NO</th>
					<th colspan="2">NAMA</th>
					<th rowspan="2">JNS KELAMIN</th>
					<th colspan="2">PKT TERAKHIR</th>
					<th colspan="2">JABATAN</th>
					<th rowspan="2">ESL</th>
					<th rowspan="2">PEND / JURUSAN / T.LULUS</th>
					<th rowspan="2">ALAMAT & NO. TELP</th>
					<th rowspan="2">KET</th>
				</tr>
				<tr>
					<th colspan="2">TTL / NIP / AGAMA</th>
					<th>GOL/RUANG</th>
					<th>TMT</th>
					<th>NAMA</th>
					<th>TMT</th>
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
				</tr>
				</thead>
				<tbody>
				<?php
					$no=0;
					$idPeg=mysql_query("SELECT * FROM tb_pegawai WHERE status_kepeg='PNS' AND status_mut='' ORDER BY urut_pangkat DESC");
					while($peg=mysql_fetch_array($idPeg)){
					$no++
					?>
				<tr>
					<td><?=$no;?></td>
					<td colspan="2"><?php echo $peg['nama']; ?><br /><br /><?php echo $peg['tempat_lhr']; ?>, <?php echo $peg['tgl_lhr']; ?><br /><?php echo $peg['nip']; ?><br /><?php echo $peg['agama']; ?></td>
					<td><?php echo $peg['jk']; ?></td>
					<td><?php
						$idPan=mysql_query("SELECT * FROM tb_pangkat WHERE (id_peg='$peg[id_peg]' AND status_pan='Aktif')");
						$hpan=mysql_fetch_array($idPan);
					?>
					<?php echo $hpan['pangkat']; ?><br /><?php echo $hpan['gol']; ?></td>
					<td><?php echo $hpan['tmt_pangkat']; ?></td>
					<td><?php
						$idJab=mysql_query("SELECT * FROM tb_jabatan WHERE (id_peg='$peg[id_peg]' AND status_jab='Aktif')");
						$hjab=mysql_fetch_array($idJab);
					?>
					<?php echo $hjab['jabatan']; ?></td>
					<td><?php echo $hjab['tmt_jabatan']; ?></td>
					<td><?php echo $hjab['eselon']; ?></td>
					<td><?php
						$idSek=mysql_query("SELECT * FROM tb_sekolah WHERE (id_peg='$peg[id_peg]' AND status='Akhir')");
						$hsek=mysql_fetch_array($idSek);
						?>
						<?php echo $hsek['tingkat']; ?><br /><?php echo $hsek['nama_sekolah']; ?><br /><?php echo $hsek['jurusan']; ?><br /><?php echo $hsek['tgl_ijazah']; ?>
					</td>
					<td><?php echo $peg['alamat']; ?><br /><br /><?php echo $peg['telp']; ?></td>
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
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>