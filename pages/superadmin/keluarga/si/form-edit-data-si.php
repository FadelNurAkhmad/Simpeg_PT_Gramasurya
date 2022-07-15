<?php
if (isset($_GET['id_si'])) {
	$id_si = $_GET['id_si'];

	include "../../config/koneksi.php";
	$query   = mysqli_query($koneksi, "SELECT * FROM tb_suamiistri WHERE id_si='$id_si'");
	$data    = mysqli_fetch_array($query);

	$tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$data[id_peg]'");
	$peg    = mysqli_fetch_array($tampilPeg);
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
<h1 class="page-header">Riwayat <small>Suami Istri <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?></small></h1>
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
				</div>
				<h4 class="panel-title">Form edit data suami / istri</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-si&id_si=<?= $id_si ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">NIK<span aria-required="true" class="text-warning"> * </span></label>
						<div class="col-md-6">
							<input type="text" name="nik" maxlength="16" value="<?= $data['nik'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama<span aria-required="true" class="text-warning"> * </span></label>
						<div class="col-md-6">
							<input type="text" name="nama" maxlength="64" value="<?= $data['nama'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tempat, Tanggal Lahir<span aria-required="true" class="text-warning"> * </span></label>
						<div class="col-md-3">
							<input type="text" name="tmp_lhr" maxlength="64" value="<?= $data['tmp_lhr'] ?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_lhr" value="<?= $data['tgl_lhr'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pendidikan<span aria-required="true" class="text-warning"> * </span></label>
						<div class="col-md-6">
							<select name="pendidikan" class="default-select2 form-control">
								<option value="SD" <?php echo ($data['pendidikan'] == 'SD') ? "selected" : ""; ?>>SD
								<option value="SMP" <?php echo ($data['pendidikan'] == 'SMP') ? "selected" : ""; ?>>SMP
								<option value="SMA" <?php echo ($data['pendidikan'] == 'SMA') ? "selected" : ""; ?>>SMA
								<option value="DI" <?php echo ($data['pendidikan'] == 'DI') ? "selected" : ""; ?>>DI
								<option value="DII" <?php echo ($data['pendidikan'] == 'DII') ? "selected" : ""; ?>>DII
								<option value="DIII" <?php echo ($data['pendidikan'] == 'DIII') ? "selected" : ""; ?>>DIII
								<option value="DIV" <?php echo ($data['pendidikan'] == 'DIV') ? "selected" : ""; ?>>DIV
								<option value="S1" <?php echo ($data['pendidikan'] == 'S1') ? "selected" : ""; ?>>S1
								<option value="S2" <?php echo ($data['pendidikan'] == 'S2') ? "selected" : ""; ?>>S2
								<option value="S3" <?php echo ($data['pendidikan'] == 'S3') ? "selected" : ""; ?>>S3
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pekerjaan<span aria-required="true" class="text-warning"> * </span></label>
						<div class="col-md-6">
							<input type="text" name="pekerjaan" maxlength="32" value="<?= $data['pekerjaan'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status Hubungan<span aria-required="true" class="text-warning"> * </span></label>
						<div class="col-md-6">
							<select name="status_hub" class="default-select2 form-control">
								<option value="Suami" <?php echo ($data['status_hub'] == 'Suami') ? "selected" : ""; ?>>Suami
								<option value="Istri" <?php echo ($data['status_hub'] == 'Istri') ? "selected" : ""; ?>>Istri
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=detail-data-pegawai&pegawai_id=<?= $data['id_peg'] ?>"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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