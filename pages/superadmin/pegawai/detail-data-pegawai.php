<?php
if (isset($_GET['pegawai_id'])) {
	$id_peg = $_GET['pegawai_id'];
}
include "../../config/koneksi.php";
// mengambil data pegawai dari gabungan tabel pegawai, tb_pegawai, pegawai_d
$query = "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id = tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id = pegawai_d.pegawai_id WHERE pegawai.pegawai_id=$id_peg";
$sql   = mysqli_query($koneksi, $query);
$data    = mysqli_fetch_array($sql);

$jabatan	= mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$data[pembagian1_id]'");
$jab	= mysqli_fetch_array($jabatan);

$queryPan	= mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
$selpan		= mysqli_fetch_array($queryPan);

$queryCuti	= mysqli_query($koneksi, "SELECT * FROM tb_jatah_cuti WHERE id_peg='$id_peg'");
$jatCuti		= mysqli_fetch_array($queryCuti);

$birthday	= new DateTime($data['tgl_lahir']);
$today		= new DateTime();
$diff = $today->diff($birthday);

// mengambil data presensi dari mesin
$tampilPres    = mysqli_query($koneksi, "SELECT * FROM att_log WHERE pin='$data[pegawai_pin]' ORDER BY scan_date DESC");
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
	<li><a href="index.php?page=form-view-data-pegawai" title="back" class="btn btn-sm btn-white m-b-10"><i class="fa fa-step-backward"></i> &nbsp;Back</a></li>
	<li><a class="btn btn-info btn-sm m-b-10" href="index.php?page=form-edit-data-pegawai&pegawai_id=<?= $id_peg ?>" title="edit"><i class="fa fa-pencil fa-lg"></i> &nbsp;Edit</a></li>
	<li><a href="../../pages/superadmin/report/print-biodata-pegawai.php?pegawai_id=<?= $id_peg ?>" target="_blank" title="print" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Profile <small>Pegawai <i class="fa fa-angle-right"></i> <?= $data['pegawai_nama'] ?> <i class="fa fa-lock"></i> NIP :<?= $data == 0 ? '-' : $data['pegawai_nip']; ?></small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
	<div class="col-md-10">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#profile" data-toggle="tab"><span class="visible-xs">Profile</span><span class="hidden-xs"><i class="ion-ios-person fa-lg text-primary"></i> Profile</span></a></li>
			<li class=""><a href="#si" data-toggle="tab"><span class="visible-xs">Suami Istri</span><span class="hidden-xs"><i class="ion-ios-paper fa-lg text-warning"></i> Suami Istri</span></a></li>
			<li class=""><a href="#anak" data-toggle="tab"><span class="visible-xs">Anak</span><span class="hidden-xs"><i class="ion-ios-paper fa-lg text-success"></i> Anak</span></a></li>
			<li class=""><a href="#ortu" data-toggle="tab"><span class="visible-xs">Ortu</span><span class="hidden-xs"><i class="ion-ios-paper fa-lg text-danger"></i> Orang Tua</span></a></li>
			<li class=""><a href="#sekolah" data-toggle="tab"><span class="visible-xs">Pend</span><span class="hidden-xs"><i class="ion-university fa-lg text-inverse"></i> Pendidikan</span></a></li>
			<li class=""><a href="#bahasa" data-toggle="tab"><span class="visible-xs">Bhs</span><span class="hidden-xs"><i class="fa fa-language fa-lg text-warning"></i> Bahasa</span></a></li>
			<li class=""><a href="#skp" data-toggle="tab"><span class="visible-xs">SKP</span><span class="hidden-xs"><i class="ion-social-buffer fa-lg text-info"></i> SKP</span></a></li>
			<li class=""><a href="#gaji" data-toggle="tab"><span class="visible-xs">Gaji</span><span class="hidden-xs"><i class="fa fa-pencil text-inverse"></i> Gaji</span></a></li>
			<li class=""><a href="#dokumen" data-toggle="tab"><span class="visible-xs">Dokumen</span><span class="hidden-xs"><i class="fa fa-folder-open text-success"></i> Dokumen</span></a></li>
			<li class=""><a href="#presensi" data-toggle="tab"><span class="visible-xs">Presensi</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Presensi</span></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="profile">
				<!-- begin profile-container -->
				<div class="profile-container">
					<!-- begin profile-section -->
					<div class="profile-section">
						<!-- begin profile-left -->
						<div class="profile-left">
							<!-- begin profile-image -->
							<div class="profile-image">
								<a href="index.php?page=form-ganti-foto&pegawai_id=<?= $id_peg ?>" title="ganti foto">
									<?php
									if (empty($data['foto']))
										if ($data['gender'] == "1") {
											echo "<img src='../../assets/img/foto/no-foto-male.png' width='160' height='200' /><i class='fa fa-user hide'></i>";
										} else {
											echo "<img src='../../assets/img/foto/no-foto-female.png' width='160' height='200' /><i class='fa fa-user hide'></i>";
										}
									else
										echo "<img src='../../assets/img/foto/$data[foto]' width='160' height='200' /><i class='fa fa-user hide'></i>";
									?>
								</a>
							</div>
							<!-- end profile-image -->
							<div class="m-b-10">
								<a href="javascript:;" class="btn btn-warning btn-block btn-sm"><?= $data == 0 ? '-' : $data['pegawai_nip']; ?></a>
							</div>
						</div>
						<!-- end profile-left -->
						<!-- begin profile-right -->
						<div class="profile-right">
							<!-- begin profile-info -->
							<div class="profile-info">
								<!-- begin table -->
								<div class="table-responsive">
									<table class="table table-profile">
										<thead>
											<tr>
												<th>
													<h5><span class="label label-inverse pull-right"> # Biodata Pegawai </span></h5>
												</th>
												<th>
													<h4><?= $data['pegawai_nama'] ?> <small><?= (isset($jab['pembagian1_id']) ? $jab['pembagian1_nama'] : "") ?></small></h4>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr class="highlight">
												<td class="field">NIP</td>
												<td><?= $data == 0 ? '-' : $data['pegawai_nip']; ?></td>
											</tr>
											<tr class="divider">
												<td colspan="2"></td>
											</tr>
											<tr>
												<td class="field">Jenis Kelamin</td>
												<td><i class="fa fa-intersex fa-lg m-r-5"></i> <?= ($data['gender'] == '1') ? "Laki-laki" : "Perempuan"; ?></td>
											</tr>
											<tr>
												<td class="field">Tempat Tanggal Lahir</td>
												<td><i class="fa fa-map-marker fa-lg m-r-5"></i> <?= $data['tempat_lahir'] ?>, <?= $data['tgl_lahir'] ?></td>
											</tr>
											<tr>
												<td class="field">Umur</td>
												<td><?php echo $diff->y . " Tahun, " . $diff->m . " Bulan, " . $diff->d . " Hari"; ?></td>
											</tr>
											<tr>
												<td class="field">Golongan Darah</td>
												<td><?php
													switch ($data['gol_darah']) {
														case 1:
															echo "A+";
															break;
														case 2:
															echo "B+";
															break;
														case 3:
															echo "O+";
															break;
														case 4:
															echo "AB+";
															break;
														case 5:
															echo "A-";
															break;
														case 6:
															echo "B-";
															break;
														case 7:
															echo "O-";
															break;
														case 8:
															echo "AB-";
															break;
													}
													?>
												</td>
											</tr>
											<tr>
												<td class="field">Agama</td>
												<td>
													<?php
													switch ($data['agama']) {
														case 1:
															echo "Islam";
															break;
														case 2:
															echo "Katolik";
															break;
														case 3:
															echo "Protestan";
															break;
														case 4:
															echo "Hindu";
															break;
														case 5:
															echo "Budha";
															break;
														case 6:
															echo "Lainnya";
															break;
													}
													?>
												</td>
											</tr>
											<tr>
												<td class="field">Status Pernikahan</td>
												<td>
													<?php
													switch ($data['stat_nikah']) {
														case 1:
															echo "Sudah Menikah";
															break;
														case 2:
															echo "Belum Menikah";
															break;
														case 3:
															echo "Duda/Janda Meninggal";
															break;
														case 4:
															echo "Duda/Janda Cerai";
															break;
													}
													?>
												</td>
											</tr>
											<tr>
												<td class="field">No. Telp</td>
												<td><i class="fa fa-mobile fa-lg m-r-5"></i> <?= $data['pegawai_telp'] ?></td>
											</tr>
											<tr>
												<td class="field">Email</td>
												<td><?= $data['email'] ?></td>
											</tr>
											<tr>
												<td class="field">Alamat</td>
												<td><?= $data['alamat'] ?></td>
											</tr>
											<!-- <tr>
												<td class="field">Status Kepegawaian</td>
												<td><?= $data['status_kepeg'] ?></td>
											</tr>
											<tr>
												<td class="field">Unit Kerja</td>
												<td><?php
													$seluni	= mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$data[unit_kerja]'");
													$uni = mysqli_fetch_array($seluni, MYSQLI_ASSOC);
													echo $uni['nama'];
													?>
												</td>
											</tr> -->
											<tr>
												<td class="field">Jatah Cuti</td>
												<td>
													<?php
													if ($jatCuti == 0) {
														echo "-";
													} else {
														echo "$jatCuti[jatah_c_jml]";
													}
													?>
												</td>
											</tr>
											<tr>
												<td class="field">Sisa Cuti</td>
												<td>
													<?php
													if ($jatCuti == 0) {
														echo "-";
													} else {
														echo "$jatCuti[jatah_c_sisa]";
													}
													?>
													&nbsp; &nbsp;
													Per Tanggal
													<?php echo date('j/m/Y'); ?></p>
												</td>
											</tr>
											<tr>
										</tbody>
									</table>
								</div>
								<!-- end table -->
							</div>
							<!-- end profile-info -->
						</div>
						<hr />
						<!-- end profile-right -->
					</div>
					<!-- end profile-section -->
				</div>
				<!-- end profile-container -->
			</div>
			<div class="tab-pane fade" id="si">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><i class="fa fa-caret-right"></i> NIK</th>
								<th><i class="fa fa-caret-right"></i> Nama</th>
								<th><i class="fa fa-caret-right"></i> TTL</th>
								<th><i class="fa fa-caret-right"></i> Pendidikan</th>
								<th><i class="fa fa-caret-right"></i> Pekerjaan</th>
								<th><i class="fa fa-caret-right"></i> Hubungan</th>
								<th width="10%">
									<center><i class="fa fa-code fa-lg"></i></center>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$tampilSi	= mysqli_query($koneksi, "SELECT * FROM tb_suamiistri WHERE id_peg='$id_peg'");
							while ($si = mysqli_fetch_array($tampilSi, MYSQLI_ASSOC)) {
							?>
								<tr>
									<td><?php echo $si['nik']; ?></td>
									<td><?php echo $si['nama']; ?></td>
									<td><?php echo $si['tmp_lhr']; ?>, <?php echo $si['tgl_lhr']; ?></td>
									<td><?php echo $si['pendidikan']; ?></td>
									<td><?php echo $si['pekerjaan']; ?></td>
									<td><?php echo $si['status_hub']; ?></td>
									<td class="tools" align="center">
										<a href="index.php?page=form-edit-data-si&id_si=<?= $si['id_si']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa-lg fa fa-edit"></i></a>&nbsp;
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delsi<?php echo $si['id_si'] ?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Delsi<?php echo $si['id_si'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Suami / Istri <u><?php echo $si['nama'] ?></u> from Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-si&id_si=<?= $si['id_si'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<div class="tab-pane fade" id="anak">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><i class="fa fa-caret-right"></i> NIK</th>
								<th><i class="fa fa-caret-right"></i> Nama</th>
								<th><i class="fa fa-caret-right"></i> TTL</th>
								<th><i class="fa fa-caret-right"></i> JK</th>
								<th><i class="fa fa-caret-right"></i> Pendidikan</th>
								<th><i class="fa fa-caret-right"></i> Pekerjaan</th>
								<th><i class="fa fa-caret-right"></i> Hubungan</th>
								<th width="10%">
									<center><i class="fa fa-code fa-lg"></i></center>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$tampilAna	= mysqli_query($koneksi, "SELECT * FROM tb_anak WHERE id_peg='$id_peg' ORDER BY tgl_lhr DESC");
							while ($ana = mysqli_fetch_array($tampilAna, MYSQLI_ASSOC)) {
							?>
								<tr>
									<td><?php echo $ana['nik']; ?></td>
									<td><?php echo $ana['nama']; ?></td>
									<td><?php echo $ana['tmp_lhr']; ?>, <?php echo $ana['tgl_lhr']; ?></td>
									<td><?php echo $ana['jk']; ?></td>
									<td><?php echo $ana['pendidikan']; ?></td>
									<td><?php echo $ana['pekerjaan']; ?></td>
									<td><?php echo $ana['status_hub']; ?></td>
									<td class="tools" align="center">
										<a href="index.php?page=form-edit-data-anak&id_anak=<?= $ana['id_anak']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa-lg fa fa-edit"></i></a>&nbsp;
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delanak<?php echo $ana['id_anak'] ?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Delanak<?php echo $ana['id_anak'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Anak <u><?php echo $ana['nama'] ?></u> from Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-anak&id_anak=<?= $ana['id_anak'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<div class="tab-pane fade" id="ortu">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><i class="fa fa-caret-right"></i> NIK</th>
								<th><i class="fa fa-caret-right"></i> Nama</th>
								<th><i class="fa fa-caret-right"></i> TTL</th>
								<th><i class="fa fa-caret-right"></i> Pendidikan</th>
								<th><i class="fa fa-caret-right"></i> Pekerjaan</th>
								<th><i class="fa fa-caret-right"></i> Hubungan</th>
								<th width="10%">
									<center><i class="fa fa-code fa-lg"></i></center>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$tampilOrt	= mysqli_query($koneksi, "SELECT * FROM tb_ortu WHERE id_peg='$id_peg' ORDER BY tgl_lhr DESC");
							while ($ort = mysqli_fetch_array($tampilOrt, MYSQLI_ASSOC)) {
							?>
								<tr>
									<td><?php echo $ort['nik']; ?></td>
									<td><?php echo $ort['nama']; ?></td>
									<td><?php echo $ort['tmp_lhr']; ?>, <?php echo $ort['tgl_lhr']; ?></td>
									<td><?php echo $ort['pendidikan']; ?></td>
									<td><?php echo $ort['pekerjaan']; ?></td>
									<td><?php echo $ort['status_hub']; ?></td>
									<td class="tools" align="center">
										<a href="index.php?page=form-edit-data-ortu&id_ortu=<?= $ort['id_ortu']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa-lg fa fa-edit"></i></a>&nbsp;
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delortu<?php echo $ort['id_ortu'] ?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Delortu<?php echo $ort['id_ortu'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Orang Tua <u><?php echo $ort['nama'] ?></u> from Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-ortu&id_ortu=<?= $ort['id_ortu'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<div class="tab-pane fade" id="sekolah">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Klik "Setup" untuk menentukan pendidikan terakhir pegawai ...
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Tingat<br />&nbsp;</th>
								<th>Nama Sekolah<br />&nbsp;</th>
								<th>Lokasi<br />&nbsp;</th>
								<th>Jurusan<br />&nbsp;</th>
								<th>No. Ijazah<br />Tgl. Ijazah</th>
								<th>Kepala / Rektor<br />&nbsp;</th>
								<th>Status<br />Pend.</th>
								<th>Set<br />Akhir</th>
								<th width="10%">
									<center><i class="fa fa-code fa-lg"></i><br />&nbsp;</center>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$tampilSek	= mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$id_peg' ORDER BY tgl_ijazah DESC");
							while ($sek = mysqli_fetch_array($tampilSek)) {
							?>
								<tr>
									<td><?php echo $sek['tingkat']; ?></td>
									<td><?php echo $sek['nama_sekolah']; ?></td>
									<td><?php echo $sek['lokasi']; ?></td>
									<td><?php echo $sek['jurusan']; ?></td>
									<td><?php echo $sek['no_ijazah']; ?><br /><?php echo $sek['tgl_ijazah']; ?></td>
									<td><?php echo $sek['kepala']; ?></td>
									<td><?php
										if ($sek['status'] == "") {
											echo "-";
										} else {
											echo "$sek[status]";
										}
										?>
									</td>
									<td class="tools"><a type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#Setpend<?php echo $sek['id_sekolah'] ?><?php echo $id_peg ?>" title="setup sebagai pendidikan akhir">Setup</a></td>
									<td class="tools" align="center">
										<a href="index.php?page=form-edit-data-sekolah&id_sekolah=<?= $sek['id_sekolah']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa-lg fa fa-edit"></i></a>&nbsp;
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delpend<?php echo $sek['id_sekolah'] ?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Setpend<?php echo $sek['id_sekolah'] ?><?php echo $id_peg ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Setup</span> &nbsp; Apakah Anda yakin ingin setup sebagai Pendidikan Akhir ?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=set-pendidikan-akhir&id_sekolah=<?= $sek['id_sekolah']; ?>&id_peg=<?= $id_peg ?>" class="btn btn-success">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
											</div>
											<div class="modal-footer">
												<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
											</div>
										</div>
									</div>
								</div>
								<!-- #modal-dialog -->
								<div id="Delpend<?php echo $sek['id_sekolah'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Apakah Anda yakin ingin delete Data Pendidikan dari Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-sekolah&id_sekolah=<?= $sek['id_sekolah'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<div class="tab-pane fade" id="bahasa">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><i class="fa fa-caret-right"></i> Jenis Bahasa</th>
								<th><i class="fa fa-caret-right"></i> Bahasa</th>
								<th><i class="fa fa-caret-right"></i> Kemampuan Bicara</th>
								<th width="10%">
									<center><i class="fa fa-code fa-lg"></i></center>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$tampilBhs	= mysqli_query($koneksi, "SELECT * FROM tb_bahasa WHERE id_peg='$id_peg'");
							while ($bhs = mysqli_fetch_array($tampilBhs)) {
							?>
								<tr>
									<td><?php echo $bhs['jns_bhs']; ?></td>
									<td><?php echo $bhs['bahasa']; ?></td>
									<td><?php echo $bhs['kemampuan']; ?></td>
									<td class="tools" align="center">
										<a href="index.php?page=form-edit-data-bahasa&id_bhs=<?= $bhs['id_bhs']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa-lg fa fa-edit"></i></a>&nbsp;
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delbah<?php echo $bhs['id_bhs'] ?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Delbah<?php echo $bhs['id_bhs'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Apakah Anda yakin ingin delete Data Bahasa dari Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-bahasa&id_bhs=<?= $bhs['id_bhs'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<div class="tab-pane fade" id="skp">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th rowspan="2">No<br />&nbsp;</th>
								<th colspan="2">Periode Penilaian</th>
								<th colspan="2">Penilai</th>
								<th rowspan="2">N Total<br />&nbsp;</th>
								<th rowspan="2">Rata<sup>2</sup><br />&nbsp;</th>
								<th rowspan="2">Mutu<br />&nbsp;</th>
								<th width="10%" rowspan="2">
									<center><i class="fa fa-code fa-lg"></i><br />&nbsp;</center>
								</th>
								<th width="6%" rowspan="2">View<br />&nbsp;</th>
							</tr>
							<tr>
								<th scope="col">Awal</th>
								<th scope="col">Akhir</th>
								<th scope="col">Pejabat</th>
								<th scope="col">Atasan Pejabat</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							$tampilSkp	= mysqli_query($koneksi, "SELECT * FROM tb_skp WHERE id_peg='$id_peg' ORDER BY periode_akhir");
							while ($skp = mysqli_fetch_array($tampilSkp, MYSQLI_ASSOC)) {
								$id_skp	= $skp['id_skp'];
								$no++
							?>
								<tr>
									<td><?= $no ?></td>
									<td><?php echo $skp['periode_awal']; ?></td>
									<td><?php echo $skp['periode_akhir']; ?></td>
									<td><?php echo $skp['penilai']; ?></td>
									<td><?php echo $skp['atasan_penilai']; ?></td>
									<td><?php
										$nilai	= mysqli_query($koneksi, "SELECT * FROM tb_skp WHERE id_skp='$id_skp'");
										while ($nskp = mysqli_fetch_array($nilai, MYSQLI_ASSOC)) {
											$orientasi		= $nskp['nilai_orientasi'];
											$integritas		= $nskp['nilai_integritas'];
											$komitmen		= $nskp['nilai_komitmen'];
											$disiplin		= $nskp['nilai_disiplin'];
											$kerjasama		= $nskp['nilai_kerjasama'];
											$kepemimpinan	= $nskp['nilai_kepemimpinan'];
										}
										$jml_nilai	= $orientasi + $integritas + $komitmen + $disiplin + $kerjasama + $kepemimpinan;
										$rata		= $jml_nilai / 6;
										echo $jml_nilai;
										?>
									</td>
									<td><?= number_format($rata, 2, ".", ",") ?></td>
									<td><?php echo $skp['hasil_penilaian']; ?></td>
									<td class="tools" align="center">
										<a href="index.php?page=form-edit-data-skp&id_skp=<?= $skp['id_skp']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa-lg fa fa-edit"></i></a>&nbsp;
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delskp<?php echo $skp['id_skp'] ?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
									</td>
									<td class="tools"><a href="index.php?page=detail-data-skp&id_skp=<?= $skp['id_skp']; ?>" title="view detail" type="button" class="btn btn-warning btn-xs">Detail</a></td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Delskp<?php echo $skp['id_skp'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Apakah Anda yakin ingin delete Data SKP dari Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-skp&id_skp=<?= $skp['id_skp'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<div class="tab-pane fade" id="gaji">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Klik "Detail" untuk menuju halaman preview dan print ...
				</div>
				<div class="panel-body">
					<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
						<thead>
							<tr>
								<th width="4%">No</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Periode Gaji</th>
								<th>Total Gaji</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							$tampilGaji   = mysqli_query(
								$koneksi,
								"SELECT * FROM tb_gaji_konfigurasi WHERE id_peg='$id_peg' ORDER BY id_gaji_konfig"
							);

							while ($gaji = mysqli_fetch_array($tampilGaji)) {
								$no++
							?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $data['pegawai_nip'] ?></td>
									<td><?php echo $data['pegawai_nama'] ?></td>
									<td>
										<?php echo $gaji['bulan'] ?>
										<b>-</b>
										<?php echo $gaji['tahun'] ?>
									</td>
									<td align="right"><?php echo 'Rp. ' . number_format($gaji['gaji_diterima']); ?></td>
									<td class="text-center">
										<a type="button" class="btn btn-success btn-icon btn-sm" href="index.php?page=detail-pegawai-data-gaji-konfigurasi&id_gaji_konfig=<?= $gaji['id_gaji_konfig'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
										<a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-data-gaji-konfigurasi&id_gaji_konfig=<?= $gaji['id_gaji_konfig'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?= $gaji['id_gaji_konfig'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Del<?php echo $gaji['id_gaji_konfig'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Apakah Anda yakin ingin delete Data Gaji dari Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-gaji-konfigurasi&id_gaji_konfig=<?= $gaji['id_gaji_konfig'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<!-- tab dokumen -->
			<div class="tab-pane fade" id="dokumen">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk menyimpan dokumen kepegawaian apapun ...
				</div>
				<a type="button" class="btn btn-sm btn-warning m-b-10" data-toggle="modal" data-target="#dok"><i class="fa fa-plus-circle"></i> Add Dokumen&nbsp;</a>

				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="10%">No #</th>
								<th>Nama Dokumen</th>
								<th>File</th>
								<th width="10%">
									<center><i class="fa fa-code fa-lg"></i></center>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							$tampilDokumen	= mysqli_query($koneksi, "SELECT * FROM tb_dokumen WHERE id_peg='$id_peg'");
							while ($dok = mysqli_fetch_array($tampilDokumen)) {
								$no++
							?>
								<tr>
									<td><?= $no ?></td>
									<td><?php echo $dok['dokumen']; ?></td>
									<td><?php
										if ($dok['file'] == "") {
											echo "-";
										} else {
											echo "<a href='../../assets/file/$dok[file]' target='_blank' title='download'><i class='fa fa-file-pdf-o fa-lg text-danger'></i></a>";
										}
										?>
									</td>
									<td class="tools">
										<a href="index.php?page=form-edit-data-dokumen&id_dokumen=<?= $dok['id_dokumen']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?= $dok['id_dokumen'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Del<?php echo $dok['id_dokumen'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Apakah Anda yakin ingin delete Data Dokumen dari Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-gaji-konfigurasi&id_gaji_konfig=<?= $dok['id_dokumen'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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

			<!-- Modal Dokumen -->
			<div id="dok" class="modal fade">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">
								<i class="ion-ios-gear text-danger"></i>
								Upload Dokumen Kepegawaian
							</h4>
						</div>
						<div class="col-sm-12">
							<div class="modal-body">
								<form action="index.php?page=masterdok&pegawai_id=<?= $id_peg ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Dokumen</label>
										<div class="col-md-6">
											<input type="text" name="dokumen" maxlength="128" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">File</label>
										<div class="col-md-6">
											<input type="file" name="file" maxlength="255" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label"></label>
										<div class="col-md-6">
											<p>* Max size 500 KB</p>
											<p>* Format PDF</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label"></label>
										<div class="col-md-6">
											<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
											<a type="button" class="btn btn-default active" data-dismiss="modal" aria-hidden="true"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="modal-footer no-margin-top">
						</div>
					</div>
				</div>
			</div>
			<!-- end tab dokumen -->
			<!-- tab presensi -->
			<div class="tab-pane fade" id="presensi">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat rekap presensi ...
				</div>
				<div class="row ">
					<div class="col-6 col-md-8">
						<label class="col-md-1 control-label">Periode</label>
						<form action="index.php?page=detail-data-pegawai&pegawai_id=<?= $id_peg ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group col-md-3">
								<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" name="periode_awal" placeholder="Dari" class="form-control" />
								</div>
							</div>
							<div class="form-group col-md-3">
								<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" name="periode_akhir" placeholder="Sampai" class="form-control" />
								</div>
							</div>
							<div class="form-group col-sm-4 m-b-10">
								<button type="submit" name="cari" value="cari" class="btn btn-primary"><i class="ion-ios-search-strong"></i> &nbsp;Cari</button>&nbsp;
								<a href="#" class="btn btn-sm btn-success" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a>
							</div>
						</form>
					</div>

				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Jam</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>PIN</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!empty($_POST['periode_awal']) && !empty($_POST['periode_awal'])) {
								$tampilCari = mysqli_query($koneksi, "SELECT * FROM att_log WHERE pin='$data[pegawai_pin]' AND DATE(scan_date) >= '$_POST[periode_awal]' AND DATE(scan_date) <= '$_POST[periode_akhir]'");
								$no = 0;
								while ($cari = mysqli_fetch_array($tampilCari, MYSQLI_ASSOC)) {
									$no++;
							?>
									<tr>
										<td><?php echo $no ?></td>
										<?php
										$myvalue = $cari['scan_date'];
										$datetime = new DateTime($myvalue);

										$date = $datetime->format('Y-m-d');
										$time = $datetime->format('H:i:s');
										?>
										<td><?= $date ?></td>
										<td><?= $time ?></td>
										<?php
										$tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$cari[pin]'");
										$peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
										?>
										<td><?= $peg['pegawai_nip'] ?></td>
										<td><?= $peg['pegawai_nama'] ?></td>
										<td><?= $cari['pin'] ?></td>
									</tr>
							<?php
								}
							}
							?>


							<?php
							if (empty($_POST['periode_awal']) && empty($_POST['periode_awal'])) {
								$no = 0;
								while ($pres    = mysqli_fetch_array($tampilPres, MYSQLI_ASSOC)) {
									$no++;
							?>
									<tr>
										<td><?php echo $no ?></td>
										<?php
										$myvalue = $pres['scan_date'];
										$datetime = new DateTime($myvalue);

										$tanggal = $datetime->format('Y-m-d');
										$jam = $datetime->format('H:i:s');
										?>
										<td><?= $tanggal ?></td>
										<td><?= $jam ?></td>
										<?php
										$tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$pres[pin]'");
										$peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
										?>
										<td><?= $peg['pegawai_nip'] ?></td>
										<td><?= $peg['pegawai_nama'] ?></td>
										<td><?= $pres['pin'] ?></td>
									</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-inverse overflow-hidden">
			<div class="panel-heading">
				<h3 class="panel-title">
					<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
						<i class="fa fa-plus-circle pull-right"></i>
						<i class="ion-filing fa-lg text-warning"></i> &nbsp;Kepegawaian
					</a>
				</h3>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in">
				<div class="panel-body">
					<!-- <p class="pull-right"><a type="button" data-toggle="modal" data-target="#pensiun" class="btn btn-default"><i class="fa fa-calendar"></i> Pensiun</a></p> -->
					<!-- <p class="pull-right"><a type="button" data-toggle="modal" data-target="#naikpangkat" class="btn btn-default"><i class="fa fa-calendar"></i> Naik Pangkat</a></p> -->
					<!-- <p class="pull-right"><a type="button" data-toggle="modal" data-target="#naikgaji" class="btn btn-default"><i class="fa fa-calendar"></i> Naik Gaji</a></p> -->
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#jabatan" class="btn btn-default"><i class="fa fa-star"></i> Jabatan</a></p>
					<!-- <p class="pull-right"><a type="button" data-toggle="modal" data-target="#pangkat" class="btn btn-default"><i class="fa fa-star"></i> Kepangkatan</a></p> -->
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#hukuman" class="btn btn-default"><i class="fa fa-gavel"></i> Hukuman</a></p>
					<!-- <p class="pull-right"><a type="button" data-toggle="modal" data-target="#diklat" class="btn btn-default"><i class="fa fa-graduation-cap"></i> Diklat</a></p> -->
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#harga" class="btn btn-default"><i class="fa fa-certificate"></i> Penghargaan</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#tugas" class="btn btn-default"><i class="fa fa-flag"></i> Penugasan</a></p>
					<!-- <p class="pull-right"><a type="button" data-toggle="modal" data-target="#seminar" class="btn btn-default"><i class="fa fa-desktop"></i> Seminar</a></p> -->
					<!-- <p class="pull-right"><a type="button" data-toggle="modal" data-target="#cuti" class="btn btn-default"><i class="fa fa-calendar"></i> Cuti</a></p> -->
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#riwayatcuti" class="btn btn-default"><i class="fa fa-calendar"></i> Riwayat Cuti</a></p>
					<!-- <p class="pull-right"><a type="button" data-toggle="modal" data-target="#latjab" class="btn btn-default"><i class="fa fa-book"></i> Latihan Jabatan</a></p> -->
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#mutasi" class="btn btn-default"><i class="fa fa-exchange"></i> Mutasi</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#tunjangan" class="btn btn-default"><i class="fa fa-money"></i> Tunjangan</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#kawin" class="btn btn-default"><i class="fa fa-book"></i> Izin Kawin</a></p>
				</div>
			</div>
		</div>
		<!-- modal -->
		<!-- <div id="pensiun" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Schedule Pensiun</h4>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th width="40%"><i class="fa fa-caret-right"></i> Tanggal Kelahiran</th>
											<th width="60%"><i class="fa fa-caret-right"></i> Tanggal Jatuh Tempo Pensiun</th>
										</tr>
									</thead>
									<tbody>
										<?php
										// $tampilPens	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
										// $pens	= mysqli_fetch_array($tampilPens, MYSQLI_ASSOC);
										$lahir	= $data['tgl_lahir'];
										$pensiiun = $data['tgl_pensiun'];
										?>
										<tr>
											<td><?= $lahir ?></td>
											<td><?= $pensiun ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div> -->
		<!-- <div id="naikpangkat" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Schedule Periode Kenaikan Pangkat</h4>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th width="40%"><i class="fa fa-caret-right"></i> Periode</th>
											<th width="60%"><i class="fa fa-caret-right"></i> Tanggal Kenaikan Pangkat</th>
										</tr>
									</thead>
									<tbody>
										<?php
										// $tampilNp	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
										// $np	= mysqli_fetch_array($tampilNp, MYSQLI_ASSOC);
										$naikpangkat	= $data['tgl_naikpangkat'];
										$naikpensiun	= $data['tgl_pensiun'];

										$begin = new DateTime($naikpangkat);
										$end = new DateTime($naikpensiun);
										$no = 0;
										for ($i = $begin; $begin <= $end; $i->modify('+4 year')) {
											$no++;
										?>
											<tr>
												<td>Periode <?= $no ?></td>
												<td><?php echo $i->format("Y-m-d"); ?></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<div id="naikgaji" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Schedule Periode Kenaikan Gaji</h4>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th width="40%"><i class="fa fa-caret-right"></i> Periode</th>
											<th width="60%"><i class="fa fa-caret-right"></i> Tanggal Kenaikan Gaji</th>
										</tr>
									</thead>
									<tbody>
										<?php
										// $tampilGj	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
										// $ng	= mysqli_fetch_array($tampilGj, MYSQLI_ASSOC);
										$naikgaji	= $data['tgl_naikgaji'];
										$naikpens	= $data['tgl_pensiun'];

										$beging = new DateTime($naikgaji);
										$endg = new DateTime($naikpens);
										$nog = 0;
										for ($ig = $beging; $beging <= $endg; $ig->modify('+2 year')) {
											$nog++;
										?>
											<tr>
												<td>Periode <?= $nog ?></td>
												<td><?php echo $ig->format("Y-m-d"); ?></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div> -->
		<div id="jabatan" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Jabatan</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="alert alert-success fade in">
								<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-info fa-2x pull-left"></i> Klik "Set" untuk menentukan jabatan sekarang ...
							</div>
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th width="2%">No<br />&nbsp;</th>
											<th>Jabatan<br />&nbsp;</th>
											<th>No. SK <br />Tgl. SK</th>
											<th width="25%">TMT / SK<br />&nbsp;</th>
											<th width="8%">Status<br />&nbsp;</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center><br />
											</th>
											<th width="5%">Set<br />&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilJab	= mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$id_peg' ORDER BY tmt_jabatan DESC");
										while ($jab = mysqli_fetch_array($tampilJab, MYSQLI_ASSOC)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td>-&nbsp;<?php echo $jab['jabatan']; ?></td>
												<td>-&nbsp;<?php echo $jab['no_sk']; ?><br />-&nbsp;<?php echo ($jab['tgl_sk'] == "0000-00-00") ? "-" : $jab['tgl_sk']; ?></td>
												<td><?php echo ($jab['tmt_jabatan'] == "0000-00-00") ? "-" : $jab['tmt_jabatan']; ?> s/d <?php echo ($jab['sampai_tgl'] == "0000-00-00") ? "-" : $jab['sampai_tgl']; ?>
													<br />
													<?php
													if ($jab['file'] == "") {
														echo "-";
													} else {
														echo "<a href='../../assets/file/$jab[file]' target='_blank' title='download'><i class='fa fa-file'></i></a>";
													}
													?>
												</td>
												<td><?php
													if ($jab['status_jab'] == "") {
														echo "-";
													} else {
														echo "$jab[status_jab]";
													}
													?>
												</td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-jabatan&id_jab=<?= $jab['id_jab']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-jabatan&id_jab=<?= $jab['id_jab']; ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Apakah kamu ingin delete == Data Jabatan == Dari Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
												<td class="tools"><a href="index.php?page=set-jabatan-sekarang&id_jab=<?= $jab['id_jab']; ?>&pegawai_id=<?= $id_peg ?>&jabatan=<?= $jab['jabatan'] ?>" title="setup sebagai jabatan sekarang" type="button" class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want Setup == Jabatan Sekarang == ?');">Set</a></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- <div id="pangkat" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Pangkat</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="alert alert-success fade in">
								<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-info fa-2x pull-left"></i> Klik "Set" untuk menentukan pangkat sekarang ...
							</div>
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th rowspan="2" width="1%">No<br />&nbsp;</th>
											<th rowspan="2">Pangkat<br />Gol</th>
											<th rowspan="2">Jenis<br />&nbsp;</th>
											<th rowspan="2">TMT<br />&nbsp;</th>
											<th colspan="2">Surat Keputusan</th>
											<th rowspan="2">SK<br />&nbsp;</th>
											<th rowspan="2">Status<br />&nbsp;</th>
											<th rowspan="2" width="10%">
												<center><i class="fa fa-code fa-lg"></i></center><br />
											</th>
											<th rowspan="2" width="5%">Set<br />&nbsp;</th>
										</tr>
										<tr>
											<th>Pejabat</th>
											<th>Nomor / TGL</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilPan	= mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$id_peg' ORDER BY tgl_sk");
										while ($pangkat = mysqli_fetch_array($tampilPan, MYSQLI_ASSOC)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $pangkat['pangkat']; ?><br /><?php echo $pangkat['gol']; ?></td>
												<td><?php echo $pangkat['jns_pangkat']; ?></td>
												<td><?php echo $pangkat['tmt_pangkat']; ?></td>
												<td><?php echo $pangkat['pejabat_sk']; ?></td>
												<td><?php echo $pangkat['no_sk']; ?><br /><?php echo $pangkat['tgl_sk']; ?></td>
												<td><?php
													if ($pangkat['file'] == "") {
														echo "-";
													} else {
														echo "<a href='../../assets/file/$pangkat[file]' target='_blank' title='download'><i class='fa fa-file'></i></a>";
													}
													?>
												</td>
												<td><?php
													if ($pangkat['status_pan'] == "") {
														echo "-";
													} else {
														echo "$pangkat[status_pan]";
													}
													?>
												</td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-pangkat&id_pangkat=<?= $pangkat['id_pangkat']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-pangkat&id_pangkat=<?= $pangkat['id_pangkat'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Pangkat == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
												<td class="tools"><a href="index.php?page=set-pangkat-sekarang&id_pangkat=<?= $pangkat['id_pangkat']; ?>&id_peg=<?= $id_peg ?>&gol=<?= $pangkat['gol'] ?>&pangkat=<?= $pangkat['pangkat'] ?>" title="setup sebagai pangkat sekarang" type="button" class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want Setup == Pangkat Sekarang == ?');">Set</a></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div> -->
		<div id="hukuman" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Hukuman</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th rowspan="2">No<br />&nbsp;</th>
											<th rowspan="2">Jenis Hukuman<br />&nbsp;</th>
											<th colspan="3">Surat Keputusan</th>
											<th colspan="3">Pemulihan</th>
											<th rowspan="2" width="10%">
												<center><i class="fa fa-code fa-lg"></i></center><br />
											</th>
										</tr>
										<tr>
											<th>Pejabat</th>
											<th>No. SK</th>
											<th>Tgl</th>
											<th>Pejabat</th>
											<th>Nomor</th>
											<th>Tgl</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilHuk	= mysqli_query($koneksi, "SELECT * FROM tb_hukuman WHERE id_peg='$id_peg' ORDER BY tgl_sk");
										while ($hukum = mysqli_fetch_array($tampilHuk)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $hukum['hukuman']; ?></td>
												<td><?php echo $hukum['pejabat_sk']; ?></td>
												<td><?php echo $hukum['no_sk']; ?></td>
												<td><?php echo $hukum['tgl_sk']; ?></td>
												<td><?php echo $hukum['pejabat_pulih']; ?></td>
												<td><?php echo $hukum['no_pulih']; ?></td>
												<td><?php echo $hukum['tgl_pulih']; ?></td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-hukuman&id_hukuman=<?= $hukum['id_hukuman']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-hukuman&id_hukuman=<?= $hukum['id_hukuman'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Apakah kamu ingin delete == Data Hukuman == dari Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- <div id="diklat" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Diklat</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>No<br />&nbsp;</th>
											<th>Nama Diklat<br />&nbsp;</th>
											<th>Jumlah Jam<br />&nbsp;</th>
											<th>Penyelenggara<br />&nbsp;</th>
											<th>Tempat<br />&nbsp;</th>
											<th>Angkatan<br />Tahun</th>
											<th>No STTPP<br />Tgl STTPP</th>
											<th>Sertifikat<br />&nbsp;</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center><br />
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilDik	= mysqli_query($koneksi, "SELECT * FROM tb_diklat WHERE id_peg='$id_peg' ORDER BY tahun");
										while ($dik = mysqli_fetch_array($tampilDik, MYSQLI_ASSOC)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $dik['diklat']; ?></td>
												<td><?php echo $dik['jml_jam']; ?></td>
												<td><?php echo $dik['penyelenggara']; ?></td>
												<td><?php echo $dik['tempat']; ?></td>
												<td><?php echo $dik['angkatan']; ?><br /><?php echo $dik['tahun']; ?></td>
												<td><?php echo $dik['no_sttpp']; ?><br /><?php echo $dik['tgl_sttpp']; ?></td>
												<td><?php
													if ($dik['file'] == "") {
														echo "-";
													} else {
														echo "<a href='../../assets/file/$dik[file]' target='_blank' title='download'><i class='fa fa-file'></i></a>";
													}
													?>
												</td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-diklat&id_diklat=<?= $dik['id_diklat']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-diklat&id_diklat=<?= $dik['id_diklat'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Diklat == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div> -->
		<div id="harga" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Penghargaan</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>No</th>
											<th>Nama Penghargaan</th>
											<th>Tahun</th>
											<th>Negara / Instansi Pemberi</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilHar	= mysqli_query($koneksi, "SELECT * FROM tb_penghargaan WHERE id_peg='$id_peg' ORDER BY tahun");
										while ($har = mysqli_fetch_array($tampilHar)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $har['penghargaan']; ?></td>
												<td><?php echo $har['tahun']; ?></td>
												<td><?php echo $har['pemberi']; ?></td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-penghargaan&id_penghargaan=<?= $har['id_penghargaan']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-penghargaan&id_penghargaan=<?= $har['id_penghargaan'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Apakah kamu ingin delete == Data Penghargaan == dari Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<div id="tugas" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Penugasan Luar Negeri</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>No</th>
											<th>Negara Tujuan</th>
											<th>Tahun</th>
											<th>Lama Penugasan (Hari)</th>
											<th>Alasan Penugasan</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilTug	= mysqli_query($koneksi, "SELECT * FROM tb_penugasan WHERE id_peg='$id_peg' ORDER BY tahun");
										while ($tug = mysqli_fetch_array($tampilTug)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $tug['tujuan']; ?></td>
												<td><?php echo $tug['tahun']; ?></td>
												<td><?php echo $tug['lama']; ?></td>
												<td><?php echo $tug['alasan']; ?></td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-penugasan&id_penugasan=<?= $tug['id_penugasan']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-penugasan&id_penugasan=<?= $tug['id_penugasan'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Apakah anda ingin delete == Data Penugasan == dari Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- <div id="seminar" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Seminar</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>No<br />&nbsp;</th>
											<th>Seminar<br />&nbsp;</th>
											<th>Tempat<br />&nbsp;</th>
											<th>Penyelenggara<br />&nbsp;</th>
											<th>Tanggal Pelaksanaan<br />&nbsp;</th>
											<th>No. Piagam<br />Tgl</th>
											<th>Sertifikat<br />&nbsp;</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center><br />
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilSem	= mysqli_query($koneksi, "SELECT * FROM tb_seminar WHERE id_peg='$id_peg' ORDER BY tgl_selesai");
										while ($sem = mysqli_fetch_array($tampilSem, MYSQLI_ASSOC)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $sem['seminar']; ?></td>
												<td><?php echo $sem['tempat']; ?></td>
												<td><?php echo $sem['penyelenggara']; ?></td>
												<td><?php echo $sem['tgl_mulai']; ?> s/d <?php echo $sem['tgl_selesai']; ?></td>
												<td><?php echo $sem['no_piagam']; ?><br /><?php echo $sem['tgl_piagam']; ?></td>
												<td><?php
													if ($sem['file'] == "") {
														echo "-";
													} else {
														echo "<a href='../../assets/file/$sem[file]' target='_blank' title='download'><i class='fa fa-file'></i></a>";
													}
													?>
												</td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-seminar&id_seminar=<?= $sem['id_seminar']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-seminar&id_seminar=<?= $sem['id_seminar'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Seminar == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div> -->
		<!-- <div id="cuti" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Cuti</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>No</th>
											<th>Jenis Cuti</th>
											<th>No. Surat Cuti</th>
											<th>Tgl Surat Cuti</th>
											<th>Tanggal Pelaksanaan</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center>
											</th>
											<th width="6%">View</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilCut	= mysqli_query($koneksi, "SELECT * FROM tb_cuti WHERE id_peg='$id_peg' ORDER BY tgl_suratcuti");
										while ($cut = mysqli_fetch_array($tampilCut, MYSQLI_ASSOC)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $cut['jns_cuti']; ?></td>
												<td><?php echo $cut['no_suratcuti']; ?></td>
												<td><?php echo $cut['tgl_suratcuti']; ?></td>
												<td><?php echo $cut['tgl_mulai']; ?> s/d <?php echo $cut['tgl_selesai']; ?></td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-cuti&id_cuti=<?= $cut['id_cuti']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-cuti&id_cuti=<?= $cut['id_cuti'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Cuti == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
												<td class="tools"><a href="index.php?page=detail-data-cuti&id_cuti=<?= $cut['id_cuti']; ?>" title="view detail" type="button" class="btn btn-warning btn-xs">Detail</a></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div> -->
		<div id="riwayatcuti" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">
							<i class="fa fa-calendar text-danger"></i>
							Riwayat Pengajuan Cuti
						</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>No</th>
											<th>Jenis Cuti</th>
											<th>Keperluan</th>
											<th>Tanggal Pelaksanaan</th>
											<th>Status</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilCuti	= mysqli_query($koneksi, "SELECT * FROM tb_data_cuti WHERE id_peg='$id_peg' ORDER BY tanggal_cuti");
										while ($cuti = mysqli_fetch_array($tampilCuti)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $cuti['jenis_cuti']; ?></td>
												<td><?php echo $cuti['keperluan']; ?></td>
												<td><?php echo $cuti['tanggal_mulai']; ?> <b>s/d</b> <?php echo $cuti['tanggal_selesai']; ?></td>
												<td class="text-center">
													<?php
													if ($cuti['status'] == 'Process') {
														echo '<span class="badge badge-primary">PROCESS</span>';
													} else if ($cuti['status'] == 'Approve') {
														echo '<span class="badge badge-success">APPROVED</span>';
													} else if ($cuti['status'] == 'Reject') {
														echo '<span class="badge badge-danger">REJECTED</span>';
													}
													?>
												</td>
												<td class="text-center">
													<?php
													if ($cuti['status'] == 'Process') {
														echo '<a href="javascript:;" title="belum di approve" type="button" class="btn btn-default btn-icon btn-sm"><i class="fa fa-print fa-lg"></i></a>';
													} else if ($cuti['status'] == 'Approve') {
														echo '<a href="index.php?page=detail-cuti&id_cuti=' . $cuti['id_cuti'] . '" title="cetak" type="button" class="btn btn-success btn-icon btn-sm"><i class="fa fa-print fa-lg"></i></a>';
													} else if ($cuti['status'] == 'Reject') {
														echo '<a href="javascript:;" title="belum di approve" type="button" class="btn btn-default btn-icon btn-sm"><i class="fa fa-print fa-lg"></i></a>';
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
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- <div id="latjab" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Pelatihan Jabatan</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>Nama Pelatih</th>
											<th>Tahun</th>
											<th>Jumlah Jam</th>
											<th>Sertifikat</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$tampilLatjab	= mysqli_query($koneksi, "SELECT * FROM tb_lat_jabatan WHERE id_peg='$id_peg' ORDER BY tahun_lat");
										while ($latjab = mysqli_fetch_array($tampilLatjab, MYSQLI_ASSOC)) {
										?>
											<tr>
												<td><?php echo $latjab['nama_pelatih']; ?></td>
												<td><?php echo $latjab['tahun_lat']; ?></td>
												<td><?php echo $latjab['jml_jam']; ?></td>
												<td><?php
													if ($latjab['file'] == "") {
														echo "-";
													} else {
														echo "<a href='../../assets/file/$latjab[file]' target='_blank' title='download'><i class='fa fa-file'></i></a>";
													}
													?>
												</td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-lat-jabatan&id_lat_jabatan=<?= $latjab['id_lat_jabatan']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-lat-jabatan&id_lat_jabatan=<?= $latjab['id_lat_jabatan'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Latihan Jabatan == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div> -->
		<div id="mutasi" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Mutasi</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>No.</th>
											<th>Jenis Mutasi</th>
											<th>Tanggal</th>
											<th>Nomor SK</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilMut	= mysqli_query($koneksi, "SELECT * FROM tb_mutasi WHERE id_peg='$id_peg'");
										while ($mut = mysqli_fetch_array($tampilMut, MYSQLI_ASSOC)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $mut['jns_mutasi']; ?></td>
												<td><?php echo $mut['tgl_mutasi']; ?></td>
												<td><?php echo $mut['no_mutasi']; ?></td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-mutasi&id_mutasi=<?= $mut['id_mutasi']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-mutasi&id_mutasi=<?= $mut['id_mutasi'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Mutasi == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<div id="tunjangan" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Tunjangan</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>No</th>
											<th>Jenis Tunjangan</th>
											<th>Nomor</th>
											<th>Tanggal</th>
											<th>Terhitung Mulai</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center>
											</th>
											<th width="6%">View</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilTun	= mysqli_query($koneksi, "SELECT * FROM tb_tunjangan WHERE id_peg='$id_peg' ORDER BY tgl_tunjangan DESC");
										while ($tun = mysqli_fetch_array($tampilTun)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $tun['jns_tunjangan']; ?></td>
												<td><?php echo $tun['no_tunjangan']; ?></td>
												<td><?php echo $tun['tgl_tunjangan']; ?></td>
												<td><?php echo $tun['tgl_terhitung']; ?></td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-tunjangan&id_tunjangan=<?= $tun['id_tunjangan']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-tunjangan&id_tunjangan=<?= $tun['id_tunjangan'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Apakah kamu ingin delete == Data Tunjangan == dari Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
												<td class="tools"><a href="index.php?page=detail-data-tunjangan&id_tunjangan=<?= $tun['id_tunjangan']; ?>" title="view detail" type="button" class="btn btn-warning btn-xs">Detail</a></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<div id="kawin" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Riwayat Izin Kawin</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th>No</th>
											<th>Nomor Izin</th>
											<th>Tanggal</th>
											<th>Kawin Dengan</th>
											<th>Tempat dan Tanggal Kawin</th>
											<th width="10%">
												<center><i class="fa fa-code fa-lg"></i></center>
											</th>
											<th width="6%">View</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilKaw	= mysqli_query($koneksi, "SELECT * FROM tb_kawin WHERE id_peg='$id_peg' ORDER BY tgl_izin DESC");
										while ($kaw = mysqli_fetch_array($tampilKaw, MYSQLI_ASSOC)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $kaw['no_kawin']; ?></td>
												<td><?php echo $kaw['tgl_izin']; ?></td>
												<td><?php echo $kaw['nama']; ?></td>
												<td><?php echo $kaw['tmp_kawin']; ?>, <?php echo $kaw['tgl_kawin']; ?></td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-kawin&id_kawin=<?= $kaw['id_kawin']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-kawin&id_kawin=<?= $kaw['id_kawin'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Izin Kawin == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
												<td class="tools"><a href="index.php?page=detail-data-kawin&id_kawin=<?= $kaw['id_kawin']; ?>" title="view detail" type="button" class="btn btn-warning btn-xs">Detail</a></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
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