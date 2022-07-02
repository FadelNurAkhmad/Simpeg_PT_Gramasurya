<?php
include "../../config/koneksi.php";
if ($_POST['search'] == "search") {
	$nama	= $_POST['pegawai_nama'];

	$tampilPeg	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_status='1' AND pegawai_nama LIKE '%$nama%'");
}
?>
<!-- begin page-header -->
<h1 class="page-header">Result <small>Direct Search</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="panel-body">
			<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
				<thead>
					<tr>
						<th width="4%">No</th>
						<th>Nama</th>
						<th>NIP</th>
						<th>JK</th>
						<th>Agama</th>
						<th>Pendidikan</th>
						<th>Status Nikah</th>
						<th>Pangkat</th>
						<th>Unit Kerja</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					while ($peg	= mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC)) {
						$no++
					?>
						<tr>
							<td><?= $no ?></td>
							<td><?php echo $peg['pegawai_nama']; ?></td>
							<td><?php echo $peg['pegawai_nip'] ?></td>
							<td><?php echo $peg['jk'] ?></td>
							<td><?php echo $peg['agama'] ?></td>
							<td><?php echo $peg['sekolah'] ?></td>
							<td><?php echo $peg['status_nikah'] ?></td>
							<td><?php echo $peg['pangkat'] ?></td>
							<td><?php
								$unit	= mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
								$uni	= mysqli_fetch_array($unit, MYSQLI_ASSOC);
								echo $uni['nama']
								?>
							</td>
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