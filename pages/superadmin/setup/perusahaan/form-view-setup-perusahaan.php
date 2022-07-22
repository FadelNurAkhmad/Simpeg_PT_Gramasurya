<?php
include "../../config/koneksi.php";
$query	= mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
$data	= mysqli_fetch_array($query);
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
	<li><a href="index.php?page=form-setup-perusahaan&id_setup_peru=<?= (isset($data['id_setup_peru'])) ? $data['id_setup_peru'] : "1" ?>" title="setup" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-gear"></i> &nbsp;Setup</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Master Setup <small><i class="fa fa-angle-right"></i> Perusahaan &nbsp;</small></h1>
<!-- end page-header -->
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="tab-content">
			<!-- begin table -->
			<div class="table-responsive">
				<table class="table table-profile">
					<thead>
						<tr>
							<th>
								<h5><span class="label label-inverse pull-right"> # PT </span></h5>
							</th>
							<th>
								<h4>Perseroan Terbatas</h4>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="highlight">
							<td class="field">Nama Perusahaan</td>
							<td><?= (isset($data['nama_peru'])) ? $data['nama_peru'] : "" ?></td>
						</tr>
						<tr class="divider">
							<td colspan="2"></td>
						</tr>
						<tr>
							<td class="field">Alamat</td>
							<td><i class="fa fa-map-marker fa-lg m-r-5"></i> <?= (isset($data['alamat'])) ? $data['alamat'] : "" ?></td>
						</tr>
						<tr>
							<td class="field">Pimpinan</td>
							<td><?php
								$idPimpinan = (isset($data['pimpinan'])) ? $data['pimpinan'] : "";
								$pimpinan	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$idPimpinan'");
								$kep	= mysqli_fetch_array($pimpinan);
								echo (isset($kep['pegawai_nama'])) ? $kep['pegawai_nama'] : "";
								?>
							</td>
						</tr>
						<tr>
							<td class="field">Helpdesk</td>
							<td><?php
								$noHelpdesk = (isset($data['helpdesk'])) ? $data['helpdesk'] : "";
								$helpdesk	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_telp='$noHelpdesk'");
								$help	= mysqli_fetch_array($helpdesk);
								echo (isset($help['pegawai_telp'])) ? $help['pegawai_nama'] . " - " . $help['pegawai_telp'] : "";
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- end table -->
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