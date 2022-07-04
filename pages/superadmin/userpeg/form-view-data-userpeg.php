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
<h1 class="page-header">Master Setup <small><i class="fa fa-angle-right"></i> User Pegawai&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";
$tampilUsr	= mysqli_query($koneksi, "SELECT * FROM tb_user WHERE hak_akses='Pegawai'");
?>
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilUsr); ?></span> rows for "Data User Pegawai"</h4>
			</div>
			<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-info fa-2x pull-left"></i> Gunakan button di sebelah kanan setiap baris tabel untuk menuju instruksi edit dan hapus data ...
			</div>
			<div class="panel-body">
				<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
							<th>No #</th>
							<th><i class="fa fa-lock"></i> Username</th>
							<th>Nama</th>
							<th><i class="fa fa-key"></i> Password</th>
							<th>Hak Akses</th>
							<th>Avatar</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 0;
						while ($usr		= mysqli_fetch_array($tampilUsr, MYSQLI_ASSOC)) {
							$id	= str_replace(' ', '-', $usr['id_user']);
							$no++;
						?>
							<tr>
								<td class="center"><?= $no ?></td>
								<td><?php echo $usr['id_user'] ?></td>
								<td><?php echo $usr['nama_user'] ?></td>
								<td>***</td>
								<td><?php echo $usr['hak_akses'] ?></td>
								<td><?php echo $usr['avatar'] ?></td>
								<td class="text-center">
									<a type="button" class="btn btn-warning btn-icon btn-sm" data-toggle="modal" data-target="#Reset<?php echo $id ?>" title="reset password"><i class="ion-ios-loop-strong fa-lg"></i></a>
								</td>
							</tr>
							<!-- #modal-dialog -->
							<div id="Reset<?php echo $id ?>" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title"><span class="label label-inverse"> # Reset Password</span> &nbsp; Password <u><?= $usr['id_user'] ?></u> will be reset to <u>123</u></h5>
										</div>
										<div class="modal-body" align="center">
											<a href="index.php?page=reset-passwordpeg&id_user=<?= $usr['id_user'] ?>" class="btn btn-warning">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- end panel -->
	</div>
	<!-- end col-10 -->
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