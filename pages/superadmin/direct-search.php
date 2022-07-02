<?php
include "../../config/koneksi.php";
if ($_POST['search'] == "search") {
	$nama	= $_POST['nama'];

	$tampilPeg	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_nama LIKE '%$nama%'");
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
						<th>Jabatan</th>
						<th>Status Pegawai</th>
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
							<td><a href="index.php?page=detail-data-pegawai&pegawai_id=<?= $peg['pegawai_id'] ?>" title="detail"><?php echo $peg['pegawai_nama']; ?></a></td>
							<td><?php echo $peg['pegawai_nip'] ?></td>
							<td><?php
								$tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
								$jab    = mysqli_fetch_array($tampilJab);

								if (isset($jab)) {
									echo $jab['jabatan'];
								} else {
									echo "";
								}
								?>
							</td>
							<td><?php
								switch ($peg['pegawai_status']) {
									case 0:
										echo "Non Aktif";
										break;
									case 1:
										echo "Aktif";
										break;
									case 2:
										echo "Berhenti";
										break;
								}
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