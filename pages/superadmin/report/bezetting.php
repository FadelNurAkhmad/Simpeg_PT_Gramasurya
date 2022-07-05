<?php

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';
require 'report/export-bezetting.php';



?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
			echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; " . $_SESSION['pesan'] . " &nbsp; &nbsp; &nbsp;</div></span>";
		}
		$_SESSION['pesan'] = "";
		?>
	</li>
	<li><a href="<?php echo $file; ?>" class="btn btn-sm btn-success m-b-10" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a></li>

</ol>
<?php
if (isset($_GET['pegawai_id'])) {
	$id_peg = $_GET['pegawai_id'];
}
include "../../config/koneksi.php";
$kepala	= mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
$kep	= mysqli_fetch_array($kepala, MYSQLI_ASSOC);
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/report/print-bezetting.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>

<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Report <small>Bezetting</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="table-responsive">
			<h5 align="center">DAFTAR BEZETTING PEGAWAI</h5>
			<h6 align="center" style="text-transform:uppercase"><?= $kep['nama_peru'] ?> PERIODE BULAN <?php echo date("m"); ?> TAHUN <?php echo date("Y"); ?></h6>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>NAMA<br />TEMPAT TANGGAL LAHIR</th>
						<th>NIP</th>
						<th>JABATAN</th>
						<th>PENDIDIKAN<br />TERAKHIR</th>
						<th>UMUR (THN)</th>
						<th>KET</th>
					</tr>
					<tr>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$idPeg = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id JOIN tb_pegawai ON pegawai_d.pegawai_id=tb_pegawai.pegawai_id ORDER BY urut_pangkat DESC");
					while ($peg = mysqli_fetch_array($idPeg, MYSQLI_ASSOC)) {
						$no++
					?>
						<td><?= $no; ?></td>
						<td><?php echo $peg['pegawai_nama']; ?><br /><?php echo $peg['tempat_lahir']; ?> <?php echo $peg['tgl_lahir']; ?></td>
						<td><?php echo $peg['pegawai_nip']; ?></td>

						<td><?php
							$idJab = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
							$hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
							$hjab1 = isset($hjab['jabatan']) ? $hjab['jabatan'] : '';
							?>
							<?php echo $hjab1; ?></td>

						<td><?php
							$idSek = mysqli_query($koneksi, " SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]' AND status='Akhir'");
							$hsek = mysqli_fetch_array($idSek, MYSQLI_ASSOC);
							$hsek1 = isset($hsek['tingkat']) ? $hsek['tingkat'] : '';
							?>
							<?php echo $hsek1; ?>
						</td>

						<td><?php
							$lhr	= new DateTime($peg['tgl_lahir']);
							$today	= new DateTime();
							$selisih	= $today->diff($lhr);
							echo $selisih->y;
							?>
						</td>

						<td><?php
							if ($peg['pegawai_status'] == '1') {
								$pgw = 'Aktif';
							}
							echo $pgw; ?></td>
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