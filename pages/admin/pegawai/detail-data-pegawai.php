<?php
if (isset($_GET['id_peg'])) {
	$id_peg = $_GET['id_peg'];
}
include "../../config/koneksi.php";
$query   = mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
$data    = mysql_fetch_array($query);

$queryPan	= mysql_query("SELECT * FROM tb_pangkat WHERE id_peg='$id_peg' AND status_pan='Aktif'");
$selpan		= mysql_fetch_array($queryPan);

$birthday	= new DateTime($data['tgl_lhr']);
$today		= new DateTime();
$diff = $today->diff($birthday);
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
	<li><a href="../../pages/admin/report/print-biodata-pegawai.php?id_peg=<?= $id_peg ?>" target="_blank" title="print" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Profile <small>Pegawai <i class="fa fa-angle-right"></i> <?= $data['nama'] ?> <i class="fa fa-lock"></i> NIP : <?= $data['nip'] ?></small></h1>
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
			<li class=""><a href="#kgb" data-toggle="tab"><span class="visible-xs">Gaji</span><span class="hidden-xs"><i class="fa fa-pencil text-inverse"></i> Gaji</span></a></li>
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
								<a href="index.php?page=form-ganti-foto&id_peg=<?= $id_peg ?>" title="ganti foto">
									<?php
									if (empty($data['foto']))
										if ($data['jk'] == "Laki-laki") {
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
								<a href="javascript:;" class="btn btn-warning btn-block btn-sm"><?= $data['nip'] ?></a>
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
													<h4><?= $data['nama'] ?> <small><?= $selpan['pangkat'] ?></small></h4>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr class="highlight">
												<td class="field">NIP</td>
												<td><?= $data['nip'] ?></td>
											</tr>
											<tr class="divider">
												<td colspan="2"></td>
											</tr>
											<tr>
												<td class="field">Jenis Kelamin</td>
												<td><i class="fa fa-intersex fa-lg m-r-5"></i> <?= $data['jk'] ?></td>
											</tr>
											<tr>
												<td class="field">Tempat Tanggal Lahir</td>
												<td><i class="fa fa-map-marker fa-lg m-r-5"></i> <?= $data['tempat_lhr'] ?>, <?= $data['tgl_lhr'] ?></td>
											</tr>
											<tr>
												<td class="field">Umur</td>
												<td><?php echo $diff->y . " Tahun, " . $diff->m . " Bulan, " . $diff->d . " Hari"; ?></td>
											</tr>
											<tr>
												<td class="field">Golongan Darah</td>
												<td><?= $data['gol_darah'] ?></td>
											</tr>
											<tr>
												<td class="field">Agama</td>
												<td><?= $data['agama'] ?></td>
											</tr>
											<tr>
												<td class="field">Status Pernikahan</td>
												<td><?= $data['status_nikah'] ?></td>
											</tr>
											<tr>
												<td class="field">No. Telp</td>
												<td><i class="fa fa-mobile fa-lg m-r-5"></i> <?= $data['telp'] ?></td>
											</tr>
											<tr>
												<td class="field">Email</td>
												<td><?= $data['email'] ?></td>
											</tr>
											<tr>
												<td class="field">Alamat</td>
												<td><?= $data['alamat'] ?></td>
											</tr>
											<tr>
												<td class="field">Status Kepegawaian</td>
												<td><?= $data['status_kepeg'] ?></td>
											</tr>
											<tr>
												<td class="field">Unit Kerja</td>
												<td><?php
													$seluni	= mysql_query("SELECT * FROM tb_unit WHERE id_unit='$data[unit_kerja]'");
													$uni = mysql_fetch_array($seluni);
													echo $uni['nama'];
													?>
												</td>
											</tr>
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
							$tampilSi	= mysql_query("SELECT * FROM tb_suamiistri WHERE id_peg='$id_peg'");
							while ($si = mysql_fetch_array($tampilSi)) {
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
							$tampilAna	= mysql_query("SELECT * FROM tb_anak WHERE id_peg='$id_peg' ORDER BY tgl_lhr DESC");
							while ($ana = mysql_fetch_array($tampilAna)) {
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
							$tampilOrt	= mysql_query("SELECT * FROM tb_ortu WHERE id_peg='$id_peg' ORDER BY tgl_lhr DESC");
							while ($ort = mysql_fetch_array($tampilOrt)) {
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
							$tampilSek	= mysql_query("SELECT * FROM tb_sekolah WHERE id_peg='$id_peg' ORDER BY tgl_ijazah DESC");
							while ($sek = mysql_fetch_array($tampilSek)) {
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
												<h5 class="modal-title"><span class="label label-inverse"> # Setup</span> &nbsp; Are you sure you want to setup as Pendidikan Akhir?</h5>
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
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Data Pendidikan from Database?</h5>
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
							$tampilBhs	= mysql_query("SELECT * FROM tb_bahasa WHERE id_peg='$id_peg'");
							while ($bhs = mysql_fetch_array($tampilBhs)) {
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
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Data Bahasa from Database?</h5>
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
							$tampilSkp	= mysql_query("SELECT * FROM tb_skp WHERE id_peg='$id_peg' ORDER BY periode_akhir");
							while ($skp = mysql_fetch_array($tampilSkp)) {
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
										$nilai	= mysql_query("SELECT * FROM tb_skp WHERE id_skp='$id_skp'");
										while ($nskp = mysql_fetch_array($nilai)) {
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
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Data SKP from Database?</h5>
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
			<div class="tab-pane fade" id="kgb">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Klik "Detail" untuk menuju halaman preview dan print ...
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No #</th>
								<th>Nomor KGB</th>
								<th>Tanggal</th>
								<th>Gaji Lama</th>
								<th>Gaji Baru</th>
								<th>Gol Baru</th>
								<th width="10%">
									<center><i class="fa fa-code fa-lg"></i></center>
								</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							$tampilKgb	= mysql_query("SELECT * FROM tb_spkgb WHERE id_peg='$id_peg' ORDER BY tgl DESC");
							while ($kgb = mysql_fetch_array($tampilKgb)) {
								$no++
							?>
								<tr>
									<td><?= $no ?></td>
									<td><?php echo $kgb['no_kgb']; ?></td>
									<td><?php echo $kgb['tgl']; ?></td>
									<td><?= number_format($kgb['gaji_lama'], 0, ",", "."); ?></td>
									<td><?= number_format($kgb['gaji_baru'], 0, ",", "."); ?></td>
									<td><?php echo $kgb['gol_baru']; ?></td>
									<td class="tools" align="center">
										<a href="index.php?page=form-edit-data-kgb&id_spkgb=<?= $kgb['id_spkgb']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa-lg fa fa-edit"></i></a>&nbsp;
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delkgb<?php echo $kgb['id_spkgb'] ?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
									</td>
									<td class="tools"><a href="index.php?page=detail-data-kgb&id_spkgb=<?= $kgb['id_spkgb']; ?>" title="view detail" type="button" class="btn btn-warning btn-xs">Detail</a></td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Delkgb<?php echo $kgb['id_spkgb'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Data KGB from Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-kgb&id_spkgb=<?= $kgb['id_spkgb'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#pensiun" class="btn btn-default"><i class="fa fa-calendar"></i> Pensiun</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#naikpangkat" class="btn btn-default"><i class="fa fa-calendar"></i> Naik Pangkat</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#naikgaji" class="btn btn-default"><i class="fa fa-calendar"></i> Naik Gaji</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#jabatan" class="btn btn-default"><i class="fa fa-star"></i> Jabatan</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#pangkat" class="btn btn-default"><i class="fa fa-star"></i> Kepangkatan</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#hukuman" class="btn btn-default"><i class="fa fa-gavel"></i> Hukuman</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#diklat" class="btn btn-default"><i class="fa fa-graduation-cap"></i> Diklat</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#harga" class="btn btn-default"><i class="fa fa-certificate"></i> Penghargaan</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#tugas" class="btn btn-default"><i class="fa fa-flag"></i> Penugasan LN</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#seminar" class="btn btn-default"><i class="fa fa-desktop"></i> Seminar</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#cuti" class="btn btn-default"><i class="fa fa-calendar"></i> Cuti</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#latjab" class="btn btn-default"><i class="fa fa-book"></i> Latihan Jabatan</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#mutasi" class="btn btn-default"><i class="fa fa-exchange"></i> Mutasi</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#tunjangan" class="btn btn-default"><i class="fa fa-money"></i> Tunjangan</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#kawin" class="btn btn-default"><i class="fa fa-book"></i> Izin Kawin</a></p>
				</div>
			</div>
		</div>
		<!-- modal -->
		<div id="pensiun" class="modal fade">
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
										$tampilPens	= mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
										$pens	= mysql_fetch_array($tampilPens);
										$lahir	= $pens['tgl_lhr'];
										$pensiun = $pens['tgl_pensiun'];
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
		</div>
		<div id="naikpangkat" class="modal fade">
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
										$tampilNp	= mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
										$np	= mysql_fetch_array($tampilNp);
										$naikpangkat	= $np['tgl_naikpangkat'];
										$naikpensiun	= $np['tgl_pensiun'];

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
										$tampilGj	= mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
										$ng	= mysql_fetch_array($tampilGj);
										$naikgaji	= $ng['tgl_naikgaji'];
										$naikpens	= $ng['tgl_pensiun'];

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
		</div>
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
											<th>Jabatan<br />ESL</th>
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
										$tampilJab	= mysql_query("SELECT * FROM tb_jabatan WHERE id_peg='$id_peg' ORDER BY tmt_jabatan DESC");
										while ($jab = mysql_fetch_array($tampilJab)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td>-&nbsp;<?php echo $jab['jabatan']; ?><br />-&nbsp;<?php echo $jab['eselon']; ?></td>
												<td>-&nbsp;<?php echo $jab['no_sk']; ?><br />-&nbsp;<?php echo $jab['tgl_sk']; ?></td>
												<td><?php echo $jab['tmt_jabatan']; ?> s/d <?php echo $jab['sampai_tgl']; ?>
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
													<a href="index.php?page=delete-data-jabatan&id_jab=<?= $jab['id_jab']; ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Jabatan == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
												</td>
												<td class="tools"><a href="index.php?page=set-jabatan-sekarang&id_jab=<?= $jab['id_jab']; ?>&id_peg=<?= $id_peg ?>&jabatan=<?= $jab['jabatan'] ?>" title="setup sebagai jabatan sekarang" type="button" class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want Setup == Jabatan Sekarang == ?');">Set</a></td>
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
		<div id="pangkat" class="modal fade">
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
										$tampilPan	= mysql_query("SELECT * FROM tb_pangkat WHERE id_peg='$id_peg' ORDER BY tgl_sk");
										while ($pangkat = mysql_fetch_array($tampilPan)) {
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
		</div>
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
										$tampilHuk	= mysql_query("SELECT * FROM tb_hukuman WHERE id_peg='$id_peg' ORDER BY tgl_sk");
										while ($hukum = mysql_fetch_array($tampilHuk)) {
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
													<a href="index.php?page=delete-data-hukuman&id_hukuman=<?= $hukum['id_hukuman'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Hukuman == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
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
		<div id="diklat" class="modal fade">
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
										$tampilDik	= mysql_query("SELECT * FROM tb_diklat WHERE id_peg='$id_peg' ORDER BY tahun");
										while ($dik = mysql_fetch_array($tampilDik)) {
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
		</div>
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
										$tampilHar	= mysql_query("SELECT * FROM tb_penghargaan WHERE id_peg='$id_peg' ORDER BY tahun");
										while ($har = mysql_fetch_array($tampilHar)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $har['penghargaan']; ?></td>
												<td><?php echo $har['tahun']; ?></td>
												<td><?php echo $har['pemberi']; ?></td>
												<td class="tools">
													<a href="index.php?page=form-edit-data-penghargaan&id_penghargaan=<?= $har['id_penghargaan']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
													<a href="index.php?page=delete-data-penghargaan&id_penghargaan=<?= $har['id_penghargaan'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Penghargaan == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
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
										$tampilTug	= mysql_query("SELECT * FROM tb_penugasan WHERE id_peg='$id_peg' ORDER BY tahun");
										while ($tug = mysql_fetch_array($tampilTug)) {
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
													<a href="index.php?page=delete-data-penugasan&id_penugasan=<?= $tug['id_penugasan'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Penugasan LN == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
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
		<div id="seminar" class="modal fade">
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
										$tampilSem	= mysql_query("SELECT * FROM tb_seminar WHERE id_peg='$id_peg' ORDER BY tgl_selesai");
										while ($sem = mysql_fetch_array($tampilSem)) {
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
		</div>
		<div id="cuti" class="modal fade">
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
										$tampilCut	= mysql_query("SELECT * FROM tb_cuti WHERE id_peg='$id_peg' ORDER BY tgl_suratcuti");
										while ($cut = mysql_fetch_array($tampilCut)) {
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
		</div>
		<div id="latjab" class="modal fade">
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
										$tampilLatjab	= mysql_query("SELECT * FROM tb_lat_jabatan WHERE id_peg='$id_peg' ORDER BY tahun_lat");
										while ($latjab = mysql_fetch_array($tampilLatjab)) {
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
		</div>
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
										$tampilMut	= mysql_query("SELECT * FROM tb_mutasi WHERE id_peg='$id_peg'");
										while ($mut = mysql_fetch_array($tampilMut)) {
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
										$tampilTun	= mysql_query("SELECT * FROM tb_tunjangan WHERE id_peg='$id_peg' ORDER BY tgl_tunjangan DESC");
										while ($tun = mysql_fetch_array($tampilTun)) {
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
													<a href="index.php?page=delete-data-tunjangan&id_tunjangan=<?= $tun['id_tunjangan'] ?>" title="delete" type="button" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete == Data Tunjangan == from Database?');"><i class="fa fa-trash-o fa-lg"></i></a>
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
										$tampilKaw	= mysql_query("SELECT * FROM tb_kawin WHERE id_peg='$id_peg' ORDER BY tgl_izin DESC");
										while ($kaw = mysql_fetch_array($tampilKaw)) {
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