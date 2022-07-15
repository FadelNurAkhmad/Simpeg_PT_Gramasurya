<?php
include "../../config/koneksi.php";

$id_peg	 = $_SESSION['id_peg'];
$query = "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id = tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id = pegawai_d.pegawai_id WHERE pegawai.pegawai_id=$id_peg";
$sql   = mysqli_query($koneksi, $query);
$data    = mysqli_fetch_array($sql);

$jabatan	= mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$data[pegawai_id]'");
$jab	= mysqli_fetch_array($jabatan);

// mengambil data presensi dari mesin
$tampilPres    = mysqli_query($koneksi, "SELECT * FROM att_log WHERE pin='$data[pegawai_pin]' ORDER BY scan_date DESC");

$queryCuti	= mysqli_query($koneksi, "SELECT * FROM tb_jatah_cuti WHERE id_peg='$id_peg'");
$jatCuti		= mysqli_fetch_array($queryCuti);

$birthday	= new DateTime($data['tgl_lahir']);
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
	<li><a href="../../pages/pegawai/report/print-biodata-pegawai.php?id_peg=<?= $id_peg ?>" target="_blank" title="print" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Profile <small>Saya <i class="fa fa-angle-right"></i> NIP : <?= $data['pegawai_nip'] ?></small></h1>
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
			<!-- <li class=""><a href="#skp" data-toggle="tab"><span class="visible-xs">SKP</span><span class="hidden-xs"><i class="ion-social-buffer fa-lg text-info"></i> SKP</span></a></li> -->
			<li class=""><a href="#kpi" data-toggle="tab"><span class="visible-xs">KPI</span><span class="hidden-xs"><i class="ion-social-buffer fa-lg text-info"></i> KPI</span></a></li>
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
							</div>
							<!-- end profile-image -->
							<div class="m-b-10">
								<a href="javascript:;" class="btn btn-warning btn-block btn-sm"><?= $data['pegawai_nip'] ?></a>
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
													<h4><?= $data['pegawai_nama'] ?> <small><?= $jab == 0 ? '-' : $jab['jabatan']; ?></small></h4>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr class="highlight">
												<td class="field">NIP</td>
												<td><?= $data['pegawai_nip'] ?></td>
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
											<tr>
												<td class="field">Jatah Cuti Tahunan</td>
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
												<td class="field">Sisa Cuti Tahunan</td>
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
										</tbody>
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
								</tr>
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
								</tr>
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
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="sekolah">
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
							</tr>
						</thead>
						<tbody>
							<?php
							$tampilSek	= mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$id_peg' ORDER BY tgl_ijazah DESC");
							while ($sek = mysqli_fetch_array($tampilSek, MYSQLI_ASSOC)) {
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
								</tr>
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
							</tr>
						</thead>
						<tbody>
							<?php
							$tampilBhs	= mysqli_query($koneksi, "SELECT * FROM tb_bahasa WHERE id_peg='$id_peg'");
							while ($bhs = mysqli_fetch_array($tampilBhs, MYSQLI_ASSOC)) {
							?>
								<tr>
									<td><?php echo $bhs['jns_bhs']; ?></td>
									<td><?php echo $bhs['bahasa']; ?></td>
									<td><?php echo $bhs['kemampuan']; ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- tab KPI -->
			<div class="tab-pane fade" id="kpi">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Klik "Detail" untuk melihat hasil KPI ...
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="4%">No</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Tanggal Buat</th>
								<th>Divisi</th>
								<th>Periode Penilaian</th>
								<th class="text-center" width="10%">View</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							$tampilKPI    = mysqli_query(
								$koneksi,
								"SELECT DISTINCT id_kategori, id_peg, tanggal_kpi, divisi, bulan, tahun FROM tb_kpi WHERE id_peg='$id_peg' ORDER BY id_data_kpi DESC"
							);
							while ($kpi    = mysqli_fetch_array($tampilKPI)) {
								$no++
							?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $data == 0 ? '-' : $data['pegawai_nip']; ?></td>
									<td><?php echo $data == 0 ? '-' : $data['pegawai_nama']; ?></td>
									<td><?php echo $kpi['tanggal_kpi'] ?></td>
									<td><?php echo $kpi['divisi'] ?></td>
									<td>
										<?php echo $kpi['bulan'] ?>
										<b>-</b>
										<?php echo $kpi['tahun'] ?>
									</td>
									<td class="text-center">
										<a href="index.php?page=detail-pegawai-kpi&id_kategori=<?= $kpi['id_kategori'] ?>" title="view detail" type="button" class="btn btn-warning btn-xs">Detail</a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- tab gaji -->
			<div class="tab-pane fade" id="gaji">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Klik "Detail" untuk menuju halaman preview dan print ...
				</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered nowrap display" width="100%">
						<thead>
							<tr>
								<th width="4%">No</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Periode Gaji</th>
								<th>Total Gaji</th>
								<th class="text-center" width="10%">View</th>
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
										<a href="index.php?page=detail-pegawai-data-gaji-konfigurasi&id_gaji_konfig=<?= $gaji['id_gaji_konfig'] ?>" title="view detail" type="button" class="btn btn-warning btn-xs">Detail</a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="dokumen">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk menyimpan dokumen kepegawaian apapun ...
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="10%">No #</th>
								<th>Nama Dokumen</th>
								<th>File</th>
								<th class="text-center">Download Dokumen</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							$tampilDokumen	= mysqli_query($koneksi, "SELECT * FROM tb_dokumen WHERE id_peg='$id_peg'");
							while ($dok = mysqli_fetch_array($tampilDokumen, MYSQLI_ASSOC)) {
								$no++
							?>
								<tr>
									<td><?= $no ?></td>
									<td><?php echo $dok['dokumen']; ?></td>
									<td><?php
										if ($dok['file'] == "") {
											echo "-";
										} else {
											echo "<a href='../../assets/file/$dok[file]' target='_blank' title='View Dokumen'><i class='fa fa-file-pdf-o fa-lg text-danger'></i></a>";
										}
										?>
									</td>
									<td class="text-center">
										<a href="../../assets/file/<?= $dok['file']; ?>" title="Download" type="button" class="btn btn-warning btn-xs">Download</a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- tab presensi -->
			<div class="tab-pane fade" id="presensi">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat rekap presensi ...
				</div>
				<div class="row ">
					<div class="col-6 col-md-8">
						<label class="col-md-1 control-label">Periode</label>
						<form action="" method="POST" enctype="multipart/form-data">
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
					<table class="table table-bordered table-striped display">
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
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#riwayatcutitahunan" class="btn btn-default"><i class="fa fa-calendar"></i> Riwayat Cuti Tahunan</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#riwayatizin" class="btn btn-default"><i class="fa fa-calendar"></i> Riwayat Izin</a></p>
					<!-- <p class="pull-right"><a type="button" data-toggle="modal" data-target="#latjab" class="btn btn-default"><i class="fa fa-book"></i> Latihan Jabatan</a></p> -->
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#mutasi" class="btn btn-default"><i class="fa fa-exchange"></i> Mutasi</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#tunjangan" class="btn btn-default"><i class="fa fa-money"></i> Tunjangan</a></p>
					<p class="pull-right"><a type="button" data-toggle="modal" data-target="#kawin" class="btn btn-default"><i class="fa fa-book"></i> Izin Kawin</a></p>
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
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>
											<th width="2%">No<br />&nbsp;</th>
											<th>Jabatan<br />ESL</th>
											<th>No. SK <br />Tgl. SK</th>
											<th width="25%">TMT / SK<br />&nbsp;</th>
											<th width="8%">Status<br />&nbsp;</th>
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
										while ($hukum = mysqli_fetch_array($tampilHuk, MYSQLI_ASSOC)) {
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
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilHar	= mysqli_query($koneksi, "SELECT * FROM tb_penghargaan WHERE id_peg='$id_peg' ORDER BY tahun");
										while ($har = mysqli_fetch_array($tampilHar, MYSQLI_ASSOC)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $har['penghargaan']; ?></td>
												<td><?php echo $har['tahun']; ?></td>
												<td><?php echo $har['pemberi']; ?></td>
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
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$tampilTug	= mysqli_query($koneksi, "SELECT * FROM tb_penugasan WHERE id_peg='$id_peg' ORDER BY tahun");
										while ($tug = mysqli_fetch_array($tampilTug, MYSQLI_ASSOC)) {
											$no++
										?>
											<tr>
												<td><?= $no ?></td>
												<td><?php echo $tug['tujuan']; ?></td>
												<td><?php echo $tug['tahun']; ?></td>
												<td><?php echo $tug['lama']; ?></td>
												<td><?php echo $tug['alasan']; ?></td>
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

		<div id="riwayatcutitahunan" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">
							<i class="fa fa-calendar text-danger"></i>
							Riwayat Pengajuan Cuti Tahunan
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
										$tampilCuti	= mysqli_query($koneksi, "SELECT * FROM tb_approval_cuti_tahunan WHERE id_peg='$id_peg' ORDER BY tanggal_cuti");
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
														echo '<a href="index.php?page=detail-cuti&id_approval_cuti=' . $cuti['id_approval_cuti'] . '" title="cetak" type="button" class="btn btn-success btn-icon btn-sm"><i class="fa fa-print fa-lg"></i></a>';
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
		<div id="riwayatizin" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">
							<i class="fa fa-calendar text-danger"></i>
							Riwayat Pengajuan Izin
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
										$tampilCuti	= mysqli_query($koneksi, "SELECT * FROM tb_approval_cuti_umum WHERE id_peg='$id_peg' ORDER BY tanggal_cuti");
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
														echo '<a href="index.php?page=detail-cuti-umum&id_approval_umum=' . $cuti['id_approval_umum'] . '" title="cetak" type="button" class="btn btn-success btn-icon btn-sm"><i class="fa fa-print fa-lg"></i></a>';
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
			$(".pesan").fadeIn(' slow');
		}, 500);
	});
	setTimeout(function() {
		$(".pesan").fadeOut('slow');
	}, 7000);

	$(document).ready(function() {
		$('table.display').DataTable();
	});
</script>