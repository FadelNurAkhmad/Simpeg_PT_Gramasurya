<?php
if (isset($_GET['id_pembinaan'])) {
	$id_pembinaan = $_GET['id_pembinaan'];

	include "../../config/koneksi.php";
	$query   = mysqli_query($koneksi, "SELECT * FROM tb_pembinaan WHERE id_pembinaan='$id_pembinaan'");
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
<h1 class="page-header">Riwayat <small>pembinaan <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?></small></h1>
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
				<h4 class="panel-title">Form edit data pembinaan</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-pembinaan&id_pembinaan=<?= $id_pembinaan ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Jenis pembinaan<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<select name="pembinaan" class="default-select2 form-control">
								<option value="Teguran Lisan" <?php echo ($data['pembinaan'] == 'Teguran Lisan') ? "selected" : ""; ?>>Teguran Lisan
								<option value="Teguran Tertulis" <?php echo ($data['pembinaan'] == 'Teguran Tertulis') ? "selected" : ""; ?>>Teguran Tertulis
								<option value="Tunda Kenaikan Berkala" <?php echo ($data['pembinaan'] == 'Tunda Kenaikan Berkala') ? "selected" : ""; ?>>Tunda Kenaikan Berkala
								<option value="Tunda Kenaikan Pangkat" <?php echo ($data['pembinaan'] == 'Tunda Kenaikan Pangkat') ? "selected" : ""; ?>>Tunda Kenaikan Pangkat
								<option value="Pemberhentian" <?php echo ($data['pembinaan'] == 'Pemberhentian') ? "selected" : ""; ?>>Pemberhentian
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pejabat Pengesah SK pembinaan<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<input type="text" name="pejabat_sk" maxlength="64" value="<?= $data['pejabat_sk'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal Pengesahan SK<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-3">
							<input type="text" name="no_sk" maxlength="32" value="<?= $data['no_sk'] ?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_sk" value="<?= $data['tgl_sk'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pejabat Pemulih pembinaan</label>
						<div class="col-md-6">
							<input type="text" name="pejabat_pulih" maxlength="64" value="<?= $data['pejabat_pulih'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal Pemulihan pembinaan</label>
						<div class="col-md-3">
							<input type="text" name="no_pulih" maxlength="32" value="<?= $data['no_pulih'] ?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_pulih" value="<?= $data['tgl_pulih'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
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