<?php
if (isset($_GET['id_jab'])) {
	$id_jab = $_GET['id_jab'];

	include "../../config/koneksi.php";
	$query   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_jab='$id_jab'");
	$data    = mysqli_fetch_array($query, MYSQLI_ASSOC);

	$tampilPeg   = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$data[id_peg]'");
	$peg    = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
} else {
	die("Error. No ID Selected!");
}
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
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Riwayat <small>Jabatan <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai: <?= $peg['nama'] ?></small></h1>
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Form edit data jabatan</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-jabatan&id_jab=<?= $id_jab ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Jabatan</label>
						<div class="col-md-6">
							<?php
							$dataJ = mysqli_query($koneksi, "SELECT * FROM tb_masterjab ORDER BY nama_masterjab");
							echo '<select name="jabatan" class="default-select2 form-control">';
							echo '<option value="' . $data['jabatan'] . '">...</option>';
							while ($rowj = mysqli_fetch_array($dataJ, MYSQLI_ASSOC)) {
								echo '<option value="' . $rowj['nama_masterjab'] . '">' . $rowj['nama_masterjab'] . '</option>';
							}
							echo '</select>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Eselon</label>
						<div class="col-md-6">
							<?php
							$dataE = mysqli_query($koneksi, "SELECT * FROM tb_masteresl ORDER BY nama_masteresl DESC");
							echo '<select name="eselon" class="default-select2 form-control">';
							echo '<option value="' . $data['eselon'] . '">...</option>';
							while ($rowe = mysqli_fetch_array($dataE, MYSQLI_ASSOC)) {
								echo '<option value="' . $rowe['nama_masteresl'] . '">' . $rowe['nama_masteresl'] . '</option>';
							}
							echo '</select>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal SK</label>
						<div class="col-md-3">
							<input type="text" name="no_sk" maxlength="255" value="<?= $data['no_sk'] ?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_sk" value="<?= $data['tgl_sk'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">TMT Jabatan</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tmt_jabatan" value="<?= $data['tmt_jabatan'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
								<input type="text" name="sampai_tgl" value="<?= $data['sampai_tgl'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">File SK Jabatan</label>
						<div class="col-md-6">
							<input type="file" name="file" class="form-control" maxlength="255" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=detail-data-pegawai&id_peg=<?= $data['id_peg'] ?>"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end panel -->
	</div>
	<!-- end col-6 -->
</div>
<!-- end row -->
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