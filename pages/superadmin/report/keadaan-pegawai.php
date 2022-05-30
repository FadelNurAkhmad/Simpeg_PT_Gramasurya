<?php
include "../../config/koneksi.php";
$kepala	= mysql_query("SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='1'");
$kep	= mysql_fetch_array($kepala);
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/report/print-keadaan-pegawai.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Report <small>Keadaan Pegawai</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="table-responsive">
			<h5 align="center">LAPORAN BULANAN KEADAAN PEGAWAI</h5>
			<h6 align="center" style="text-transform:uppercase">DI <?= $kep['kab'] ?></h6>
			<h6 style="text-transform:uppercase">PERIODE : BULAN <?php echo date("m"); ?> TAHUN <?php echo date("Y"); ?></h6>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th rowspan="2">NO</th>
						<th rowspan="2">JENIS LAPORAN</th>
						<th colspan="4">GOLONGAN</th>
						<th rowspan="2">JML</th>
						<th colspan="4">ESELON</th>
						<th rowspan="2">STAFF</th>
						<th rowspan="2">KET</th>
					</tr>
					<tr>
						<th>I</th>
						<th>II</th>
						<th>III</th>
						<th>IV</th>
						<th>II</th>
						<th>III</th>
						<th>IV</th>
						<th>V</th>
					</tr>
					<tr>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
						<th>10</th>
						<th>11</th>
						<th>12</th>
						<th>13</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>JUMLAH PEGAWAI</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- PRIA</td>
						<td><?php
							$pegL1 = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol LIKE 'I/%'");
							$jL1 = mysql_num_rows($pegL1);
							if ($jL1 == 0) {
								echo "-";
							} else {
								echo $jL1;
							}
							?>
						</td>
						<td><?php
							$pegL2 = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol LIKE 'II/%'");
							$jL2 = mysql_num_rows($pegL2);
							if ($jL2 == 0) {
								echo "-";
							} else {
								echo $jL2;
							}
							?>
						</td>
						<td><?php
							$pegL3 = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol LIKE 'III/%'");
							$jL3 = mysql_num_rows($pegL3);
							if ($jL3 == 0) {
								echo "-";
							} else {
								echo $jL3;
							}
							?>
						</td>
						<td><?php
							$pegL4 = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol LIKE 'IV/%'");
							$jL4 = mysql_num_rows($pegL4);
							if ($jL4 == 0) {
								echo "-";
							} else {
								echo $jL4;
							}
							?>
						</td>
						<td><?php
							$pegL = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND gol !=''");
							$jL = mysql_num_rows($pegL);
							if ($jL == 0) {
								echo "-";
							} else {
								echo $jL;
							}
							?>
						</td>
						<td><?php
							$eL2 = mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Laki-laki' AND status_jab='Aktif' AND eselon LIKE 'II/%'");
							$jeL2 = mysql_num_rows($eL2);
							if ($jeL2 == 0) {
								echo "-";
							} else {
								echo $jeL2;
							}
							?>
						</td>
						<td><?php
							$eL3 = mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Laki-laki' AND status_jab='Aktif' AND eselon LIKE 'III/%'");
							$jeL3 = mysql_num_rows($eL3);
							if ($jeL3 == 0) {
								echo "-";
							} else {
								echo $jeL3;
							}
							?>
						</td>
						<td><?php
							$eL4 = mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Laki-laki' AND status_jab='Aktif' AND eselon LIKE 'IV/%'");
							$jeL4 = mysql_num_rows($eL4);
							if ($jeL4 == 0) {
								echo "-";
							} else {
								echo $jeL4;
							}
							?>
						</td>
						<td><?php
							$eL5 = mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Laki-laki' AND status_jab='Aktif' AND eselon LIKE 'V/%'");
							$jeL5 = mysql_num_rows($eL5);
							if ($jeL5 == 0) {
								echo "-";
							} else {
								echo $jeL5;
							}
							?>
						</td>
						<td>
							<?php
							$pegSl = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Laki-laki' AND status_pan='Aktif' AND pangkat LIKE 'staf%'");
							$jSl = mysql_num_rows($pegSl);
							if ($jSl == 0) {
								echo "-";
							} else {
								echo $jSl;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- WANITA</td>
						<td><?php
							$pegP1 = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol LIKE 'I/%'");
							$jP1 = mysql_num_rows($pegP1);
							if ($jP1 == 0) {
								echo "-";
							} else {
								echo $jP1;
							}
							?>
						</td>
						<td><?php
							$pegP2 = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol LIKE 'II/%'");
							$jP2 = mysql_num_rows($pegP2);
							if ($jP2 == 0) {
								echo "-";
							} else {
								echo $jP2;
							}
							?>
						</td>
						<td><?php
							$pegP3 = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol LIKE 'III/%'");
							$jP3 = mysql_num_rows($pegP3);
							if ($jP3 == 0) {
								echo "-";
							} else {
								echo $jP3;
							}
							?>
						</td>
						<td><?php
							$pegP4 = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol LIKE 'IV/%'");
							$jP4 = mysql_num_rows($pegP4);
							if ($jP4 == 0) {
								echo "-";
							} else {
								echo $jP4;
							}
							?>
						</td>
						<td><?php
							$pegP = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND gol !=''");
							$jP = mysql_num_rows($pegP);
							if ($jP == 0) {
								echo "-";
							} else {
								echo $jP;
							}
							?>
						</td>
						<td><?php
							$eP2 = mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Perempuan' AND status_jab='Aktif' AND eselon LIKE 'II/%'");
							$jeP2 = mysql_num_rows($eP2);
							if ($jeP2 == 0) {
								echo "-";
							} else {
								echo $jeP2;
							}
							?>
						</td>
						<td><?php
							$eP3 = mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Perempuan' AND status_jab='Aktif' AND eselon LIKE 'III/%'");
							$jeP3 = mysql_num_rows($eP3);
							if ($jeP3 == 0) {
								echo "-";
							} else {
								echo $jeP3;
							}
							?>
						</td>
						<td><?php
							$eP4 = mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Perempuan' AND status_jab='Aktif' AND eselon LIKE 'IV/%'");
							$jeP4 = mysql_num_rows($eP4);
							if ($jeP4 == 0) {
								echo "-";
							} else {
								echo $jeP4;
							}
							?>
						</td>
						<td><?php
							$eP5 = mysql_query("SELECT * FROM tb_jabatan WHERE jk_jab='Perempuan' AND status_jab='Aktif' AND eselon LIKE 'V/%'");
							$jeP5 = mysql_num_rows($eP5);
							if ($jeP5 == 0) {
								echo "-";
							} else {
								echo $jeP5;
							}
							?>
						</td>
						<td>
							<?php
							$pegSp = mysql_query("SELECT * FROM tb_pangkat WHERE jk_pan='Perempuan' AND status_pan='Aktif' AND pangkat LIKE 'staf%'");
							$jSp = mysql_num_rows($pegSp);
							if ($jSp == 0) {
								echo "-";
							} else {
								echo $jSp;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>2</td>
						<td>JENIS PENDIDIKAN</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- SD/MI</td>
						<td><?php
							$sd1 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND gol LIKE 'I/%'");
							$jsd1 = mysql_num_rows($sd1);
							if ($jsd1 == 0) {
								echo "-";
							} else {
								echo $jsd1;
							}
							?>
						</td>
						<td><?php
							$sd2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir'AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND gol LIKE 'II/%'");
							$jsd2 = mysql_num_rows($sd2);
							if ($jsd2 == 0) {
								echo "-";
							} else {
								echo $jsd2;
							}
							?>
						</td>
						<td><?php
							$sd3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND gol LIKE 'III/%'");
							$jsd3 = mysql_num_rows($sd3);
							if ($jsd3 == 0) {
								echo "-";
							} else {
								echo $jsd3;
							}
							?>
						</td>
						<td><?php
							$sd4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND gol LIKE 'IV/%'");
							$jsd4 = mysql_num_rows($sd4);
							if ($jsd4 == 0) {
								echo "-";
							} else {
								echo $jsd4;
							}
							?>
						</td>
						<td><?php
							$sd = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%')");
							$jsd = mysql_num_rows($sd);
							if ($jsd == 0) {
								echo "-";
							} else {
								echo $jsd;
							}
							?>
						</td>
						<td><?php
							$sde2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND eselon LIKE 'II/%'");
							$jsde2 = mysql_num_rows($sde2);
							if ($jsde2 == 0) {
								echo "-";
							} else {
								echo $jsde2;
							}
							?>
						</td>
						<td><?php
							$sde3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND eselon LIKE 'III/%'");
							$jsde3 = mysql_num_rows($sde3);
							if ($jsde3 == 0) {
								echo "-";
							} else {
								echo $jsde3;
							}
							?>
						</td>
						<td><?php
							$sde4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND eselon LIKE 'IV/%'");
							$jsde4 = mysql_num_rows($sde4);
							if ($jsde4 == 0) {
								echo "-";
							} else {
								echo $jsde4;
							}
							?>
						</td>
						<td><?php
							$sde5 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND eselon LIKE 'V/%'");
							$jsde5 = mysql_num_rows($sde5);
							if ($jsde5 == 0) {
								echo "-";
							} else {
								echo $jsde5;
							}
							?>
						</td>
						<td><?php
							$sds = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SD%' OR tingkat LIKE 'MI%') AND pangkat LIKE 'Staff%'");
							$jsds = mysql_num_rows($sds);
							if ($jsds == 0) {
								echo "-";
							} else {
								echo $jsds;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- SMP/MTS</td>
						<td><?php
							$smp1 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND gol LIKE 'I/%'");
							$jsmp1 = mysql_num_rows($smp1);
							if ($jsmp1 == 0) {
								echo "-";
							} else {
								echo $jsmp1;
							}
							?>
						</td>
						<td><?php
							$smp2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND gol LIKE 'II/%'");
							$jsmp2 = mysql_num_rows($smp2);
							if ($jsmp2 == 0) {
								echo "-";
							} else {
								echo $jsmp2;
							}
							?>
						</td>
						<td><?php
							$smp3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND gol LIKE 'III/%'");
							$jsmp3 = mysql_num_rows($smp3);
							if ($jsmp3 == 0) {
								echo "-";
							} else {
								echo $jsmp3;
							}
							?>
						</td>
						<td><?php
							$smp4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND gol LIKE 'IV/%'");
							$jsmp4 = mysql_num_rows($smp4);
							if ($jsmp4 == 0) {
								echo "-";
							} else {
								echo $jsmp4;
							}
							?>
						</td>
						<td><?php
							$smp = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%')");
							$jsmp = mysql_num_rows($smp);
							if ($jsmp == 0) {
								echo "-";
							} else {
								echo $jsmp;
							}
							?>
						</td>
						<td><?php
							$smpe2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND eselon LIKE 'II/%'");
							$jsmpe2 = mysql_num_rows($smpe2);
							if ($jsmpe2 == 0) {
								echo "-";
							} else {
								echo $jsmpe2;
							}
							?>
						</td>
						<td><?php
							$smpe3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND eselon LIKE 'III/%'");
							$jsmpe3 = mysql_num_rows($smpe3);
							if ($jsmpe3 == 0) {
								echo "-";
							} else {
								echo $jsmpe3;
							}
							?>
						</td>
						<td><?php
							$smpe4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND eselon LIKE 'IV/%'");
							$jsmpe4 = mysql_num_rows($smpe4);
							if ($jsmpe4 == 0) {
								echo "-";
							} else {
								echo $jsmpe4;
							}
							?>
						</td>
						<td><?php
							$smpe5 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND eselon LIKE 'V/%'");
							$jsmpe5 = mysql_num_rows($smpe5);
							if ($jsmpe5 == 0) {
								echo "-";
							} else {
								echo $jsmpe5;
							}
							?>
						</td>
						<td><?php
							$smps = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMP%' OR tingkat LIKE 'MTS%') AND pangkat LIKE 'Staff%'");
							$jsmps = mysql_num_rows($smps);
							if ($jsmps == 0) {
								echo "-";
							} else {
								echo $jsmps;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- SMK/SMA/MA</td>
						<td><?php
							$sma1 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND gol LIKE 'I/%'");
							$jsma1 = mysql_num_rows($sma1);
							if ($jsma1 == 0) {
								echo "-";
							} else {
								echo $jsma1;
							}
							?>
						</td>
						<td><?php
							$sma2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND gol LIKE 'II/%'");
							$jsma2 = mysql_num_rows($sma2);
							if ($jsma2 == 0) {
								echo "-";
							} else {
								echo $jsma2;
							}
							?>
						</td>
						<td><?php
							$sma3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND gol LIKE 'III/%'");
							$jsma3 = mysql_num_rows($sma3);
							if ($jsma3 == 0) {
								echo "-";
							} else {
								echo $jsma3;
							}
							?>
						</td>
						<td><?php
							$sma4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND gol LIKE 'IV/%'");
							$jsma4 = mysql_num_rows($sma4);
							if ($jsma4 == 0) {
								echo "-";
							} else {
								echo $jsma4;
							}
							?>
						</td>
						<td><?php
							$sma = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%')");
							$jsma = mysql_num_rows($sma);
							if ($jsma == 0) {
								echo "-";
							} else {
								echo $jsma;
							}
							?>
						</td>
						<td><?php
							$smae2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND eselon LIKE 'II/%'");
							$jsmae2 = mysql_num_rows($smae2);
							if ($jsmae2 == 0) {
								echo "-";
							} else {
								echo $jsmae2;
							}
							?>
						</td>
						<td><?php
							$smae3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND eselon LIKE 'III/%'");
							$jsmae3 = mysql_num_rows($smae3);
							if ($jsmae3 == 0) {
								echo "-";
							} else {
								echo $jsmae3;
							}
							?>
						</td>
						<td><?php
							$smae4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND eselon LIKE 'IV/%'");
							$jsmae4 = mysql_num_rows($smae4);
							if ($jsmae4 == 0) {
								echo "-";
							} else {
								echo $jsmae4;
							}
							?>
						</td>
						<td><?php
							$smae5 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND eselon LIKE 'V/%'");
							$jsmae5 = mysql_num_rows($smae5);
							if ($jsmae5 == 0) {
								echo "-";
							} else {
								echo $jsmae5;
							}
							?>
						</td>
						<td><?php
							$smas = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'SMA%' OR tingkat LIKE 'SMK%' OR tingkat LIKE 'MA%') AND pangkat LIKE 'Staff%'");
							$jsmas = mysql_num_rows($smas);
							if ($jsmas == 0) {
								echo "-";
							} else {
								echo $jsmas;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- D2/D3</td>
						<td><?php
							$d1 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND gol LIKE 'I/%'");
							$jd1 = mysql_num_rows($d1);
							if ($jd1 == 0) {
								echo "-";
							} else {
								echo $jd1;
							}
							?>
						</td>
						<td><?php
							$d2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND gol LIKE 'II/%'");
							$jd2 = mysql_num_rows($d2);
							if ($jd2 == 0) {
								echo "-";
							} else {
								echo $jd2;
							}
							?>
						</td>
						<td><?php
							$d3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND gol LIKE 'III/%'");
							$jd3 = mysql_num_rows($d3);
							if ($jd3 == 0) {
								echo "-";
							} else {
								echo $jd3;
							}
							?>
						</td>
						<td><?php
							$d4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND gol LIKE 'IV/%'");
							$jd4 = mysql_num_rows($d4);
							if ($jd4 == 0) {
								echo "-";
							} else {
								echo $jd4;
							}
							?>
						</td>
						<td><?php
							$d = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%')");
							$jd = mysql_num_rows($d);
							if ($jd == 0) {
								echo "-";
							} else {
								echo $jd;
							}
							?>
						</td>
						<td><?php
							$de2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND eselon LIKE 'II/%'");
							$jde2 = mysql_num_rows($de2);
							if ($jde2 == 0) {
								echo "-";
							} else {
								echo $jde2;
							}
							?>
						</td>
						<td><?php
							$de3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND eselon LIKE 'III/%'");
							$jde3 = mysql_num_rows($de3);
							if ($jde3 == 0) {
								echo "-";
							} else {
								echo $jde3;
							}
							?>
						</td>
						<td><?php
							$de4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND eselon LIKE 'IV/%'");
							$jde4 = mysql_num_rows($de4);
							if ($jde4 == 0) {
								echo "-";
							} else {
								echo $jde4;
							}
							?>
						</td>
						<td><?php
							$de5 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND eselon LIKE 'V/%'");
							$jde5 = mysql_num_rows($de5);
							if ($jde5 == 0) {
								echo "-";
							} else {
								echo $jde5;
							}
							?>
						</td>
						<td><?php
							$ds = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'D2%' OR tingkat LIKE 'D3%') AND pangkat LIKE 'Staff%'");
							$jds = mysql_num_rows($ds);
							if ($jds == 0) {
								echo "-";
							} else {
								echo $jds;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- S1/D4</td>
						<td><?php
							$s11 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND gol LIKE 'I/%'");
							$js11 = mysql_num_rows($s11);
							if ($js11 == 0) {
								echo "-";
							} else {
								echo $js11;
							}
							?>
						</td>
						<td><?php
							$s12 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND gol LIKE 'II/%'");
							$js12 = mysql_num_rows($s12);
							if ($js12 == 0) {
								echo "-";
							} else {
								echo $js12;
							}
							?>
						</td>
						<td><?php
							$s13 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND gol LIKE 'III/%'");
							$js13 = mysql_num_rows($s13);
							if ($js13 == 0) {
								echo "-";
							} else {
								echo $js13;
							}
							?>
						</td>
						<td><?php
							$s14 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND gol LIKE 'IV/%'");
							$js14 = mysql_num_rows($s14);
							if ($js14 == 0) {
								echo "-";
							} else {
								echo $js14;
							}
							?>
						</td>
						<td><?php
							$s1 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%')");
							$js1 = mysql_num_rows($s1);
							if ($js1 == 0) {
								echo "-";
							} else {
								echo $js1;
							}
							?>
						</td>
						<td><?php
							$s1e2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND eselon LIKE 'II/%'");
							$js1e2 = mysql_num_rows($s1e2);
							if ($js1e2 == 0) {
								echo "-";
							} else {
								echo $js1e2;
							}
							?>
						</td>
						<td><?php
							$s1e3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND eselon LIKE 'III/%'");
							$js1e3 = mysql_num_rows($s1e3);
							if ($js1e3 == 0) {
								echo "-";
							} else {
								echo $js1e3;
							}
							?>
						</td>
						<td><?php
							$s1e4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND eselon LIKE 'IV/%'");
							$js1e4 = mysql_num_rows($s1e4);
							if ($js1e4 == 0) {
								echo "-";
							} else {
								echo $js1e4;
							}
							?>
						</td>
						<td><?php
							$s1e5 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND eselon LIKE 'V/%'");
							$js1e5 = mysql_num_rows($s1e5);
							if ($js1e5 == 0) {
								echo "-";
							} else {
								echo $js1e5;
							}
							?>
						</td>
						<td><?php
							$s1s = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S1%' OR tingkat LIKE 'D4%') AND pangkat LIKE 'Staff%'");
							$js1s = mysql_num_rows($s1s);
							if ($js1s == 0) {
								echo "-";
							} else {
								echo $js1s;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- S2/S3</td>
						<td><?php
							$s21 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND gol LIKE 'I/%'");
							$js21 = mysql_num_rows($s21);
							if ($js21 == 0) {
								echo "-";
							} else {
								echo $js21;
							}
							?>
						</td>
						<td><?php
							$s22 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND gol LIKE 'II/%'");
							$js22 = mysql_num_rows($s22);
							if ($js22 == 0) {
								echo "-";
							} else {
								echo $js22;
							}
							?>
						</td>
						<td><?php
							$s23 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND gol LIKE 'III/%'");
							$js23 = mysql_num_rows($s23);
							if ($js23 == 0) {
								echo "-";
							} else {
								echo $js23;
							}
							?>
						</td>
						<td><?php
							$s24 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND gol LIKE 'IV/%'");
							$js24 = mysql_num_rows($s24);
							if ($js24 == 0) {
								echo "-";
							} else {
								echo $js24;
							}
							?>
						</td>
						<td><?php
							$s2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%')");
							$js2 = mysql_num_rows($s2);
							if ($js2 == 0) {
								echo "-";
							} else {
								echo $js2;
							}
							?>
						</td>
						<td><?php
							$s2e2 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND eselon LIKE 'II/%'");
							$js2e2 = mysql_num_rows($s2e2);
							if ($js2e2 == 0) {
								echo "-";
							} else {
								echo $js2e2;
							}
							?>
						</td>
						<td><?php
							$s2e3 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND eselon LIKE 'III/%'");
							$js2e3 = mysql_num_rows($s2e3);
							if ($js2e3 == 0) {
								echo "-";
							} else {
								echo $js2e3;
							}
							?>
						</td>
						<td><?php
							$s2e4 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND eselon LIKE 'IV/%'");
							$js2e4 = mysql_num_rows($s2e4);
							if ($js2e4 == 0) {
								echo "-";
							} else {
								echo $js2e4;
							}
							?>
						</td>
						<td><?php
							$s2e5 = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND eselon LIKE 'V/%'");
							$js2e5 = mysql_num_rows($s2e5);
							if ($js2e5 == 0) {
								echo "-";
							} else {
								echo $js2e5;
							}
							?>
						</td>
						<td><?php
							$s2s = mysql_query("SELECT * FROM tb_sekolah WHERE status='Akhir' AND (tingkat LIKE 'S2%' OR tingkat LIKE 'S3%') AND pangkat LIKE 'Staff%'");
							$js2s = mysql_num_rows($s2s);
							if ($js2s == 0) {
								echo "-";
							} else {
								echo $js2s;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>3</td>
						<td>MUTASI PEGAWAI</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php
					$skrg = date("Y-m");
					?>
					<tr>
						<td></td>
						<td>- MASUK</td>
						<td><?php
							$mg1 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jmg1 = mysql_num_rows($mg1);
							if ($jmg1 == 0) {
								echo "-";
							} else {
								echo $jmg1;
							}
							?>
						</td>
						<td><?php
							$mg2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jmg2 = mysql_num_rows($mg2);
							if ($jmg2 == 0) {
								echo "-";
							} else {
								echo $jmg2;
							}
							?>
						</td>
						<td><?php
							$mg3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jmg3 = mysql_num_rows($mg3);
							if ($jmg3 == 0) {
								echo "-";
							} else {
								echo $jmg3;
							}
							?>
						</td>
						<td><?php
							$mg4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jmg4 = mysql_num_rows($mg4);
							if ($jmg4 == 0) {
								echo "-";
							} else {
								echo $jmg4;
							}
							?>
						</td>
						<td><?php
							$mg = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%'");
							$jmg = mysql_num_rows($mg);
							if ($jmg == 0) {
								echo "-";
							} else {
								echo $jmg;
							}
							?>
						</td>
						<td><?php
							$me2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jme2 = mysql_num_rows($me2);
							if ($jme2 == 0) {
								echo "-";
							} else {
								echo $jme2;
							}
							?>
						</td>
						<td><?php
							$me3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jme3 = mysql_num_rows($me3);
							if ($jme3 == 0) {
								echo "-";
							} else {
								echo $jme3;
							}
							?>
						</td>
						<td><?php
							$me4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jme4 = mysql_num_rows($me4);
							if ($jme4 == 0) {
								echo "-";
							} else {
								echo $jme4;
							}
							?>
						</td>
						<td><?php
							$me5 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jme5 = mysql_num_rows($me5);
							if ($jme5 == 0) {
								echo "-";
							} else {
								echo $jme5;
							}
							?>
						</td>
						<td><?php
							$ms = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Masuk' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jms = mysql_num_rows($ms);
							if ($jms == 0) {
								echo "-";
							} else {
								echo $jms;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- KELUAR</td>
						<td><?php
							$mkg1 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jmkg1 = mysql_num_rows($mkg1);
							if ($jmkg1 == 0) {
								echo "-";
							} else {
								echo $jmkg1;
							}
							?>
						</td>
						<td><?php
							$mkg2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jmkg2 = mysql_num_rows($mkg2);
							if ($jmkg2 == 0) {
								echo "-";
							} else {
								echo $jmkg2;
							}
							?>
						</td>
						<td><?php
							$mkg3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jmkg3 = mysql_num_rows($mkg3);
							if ($jmkg3 == 0) {
								echo "-";
							} else {
								echo $jmkg3;
							}
							?>
						</td>
						<td><?php
							$mkg4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jmkg4 = mysql_num_rows($mkg4);
							if ($jmkg4 == 0) {
								echo "-";
							} else {
								echo $jmkg4;
							}
							?>
						</td>
						<td><?php
							$mkg = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%'");
							$jmkg = mysql_num_rows($mkg);
							if ($jmkg == 0) {
								echo "-";
							} else {
								echo $jmkg;
							}
							?>
						</td>
						<td><?php
							$mke2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jmke2 = mysql_num_rows($mke2);
							if ($jmke2 == 0) {
								echo "-";
							} else {
								echo $jmke2;
							}
							?>
						</td>
						<td><?php
							$mke3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jmke3 = mysql_num_rows($mke3);
							if ($jmke3 == 0) {
								echo "-";
							} else {
								echo $jmke3;
							}
							?>
						</td>
						<td><?php
							$mke4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jmke4 = mysql_num_rows($mke4);
							if ($jmke4 == 0) {
								echo "-";
							} else {
								echo $jmke4;
							}
							?>
						</td>
						<td><?php
							$mke5 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jmke5 = mysql_num_rows($mke5);
							if ($jmke5 == 0) {
								echo "-";
							} else {
								echo $jmke5;
							}
							?>
						</td>
						<td><?php
							$mks = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Keluar' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jmks = mysql_num_rows($mks);
							if ($jmks == 0) {
								echo "-";
							} else {
								echo $jmks;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- PINDAH ANTAR INSTANSI</td>
						<td><?php
							$mpg1 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jmpg1 = mysql_num_rows($mpg1);
							if ($jmpg1 == 0) {
								echo "-";
							} else {
								echo $jmpg1;
							}
							?>
						</td>
						<td><?php
							$mpg2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jmpg2 = mysql_num_rows($mpg2);
							if ($jmpg2 == 0) {
								echo "-";
							} else {
								echo $jmpg2;
							}
							?>
						</td>
						<td><?php
							$mpg3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jmpg3 = mysql_num_rows($mpg3);
							if ($jmpg3 == 0) {
								echo "-";
							} else {
								echo $jmpg3;
							}
							?>
						</td>
						<td><?php
							$mpg4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jmpg4 = mysql_num_rows($mpg4);
							if ($jmpg4 == 0) {
								echo "-";
							} else {
								echo $jmpg4;
							}
							?>
						</td>
						<td><?php
							$mpg = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%'");
							$jmpg = mysql_num_rows($mpg);
							if ($jmpg == 0) {
								echo "-";
							} else {
								echo $jmpg;
							}
							?>
						</td>
						<td><?php
							$mpe2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jmpe2 = mysql_num_rows($mpe2);
							if ($jmpe2 == 0) {
								echo "-";
							} else {
								echo $jmpe2;
							}
							?>
						</td>
						<td><?php
							$mpe3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jmpe3 = mysql_num_rows($mpe3);
							if ($jmpe3 == 0) {
								echo "-";
							} else {
								echo $jmpe3;
							}
							?>
						</td>
						<td><?php
							$mpe4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jmpe4 = mysql_num_rows($mpe4);
							if ($jmpe4 == 0) {
								echo "-";
							} else {
								echo $jmpe4;
							}
							?>
						</td>
						<td><?php
							$mpe5 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jmpe5 = mysql_num_rows($mpe5);
							if ($jmpe5 == 0) {
								echo "-";
							} else {
								echo $jmpe5;
							}
							?>
						</td>
						<td><?php
							$mps = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pindah Antar Instansi' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jmps = mysql_num_rows($mps);
							if ($jmps == 0) {
								echo "-";
							} else {
								echo $jmps;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- PENSIUN</td>
						<td><?php
							$mpng1 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jmpng1 = mysql_num_rows($mpng1);
							if ($jmpng1 == 0) {
								echo "-";
							} else {
								echo $jmpng1;
							}
							?>
						</td>
						<td><?php
							$mpng2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jmpng2 = mysql_num_rows($mpng2);
							if ($jmpng2 == 0) {
								echo "-";
							} else {
								echo $jmpng2;
							}
							?>
						</td>
						<td><?php
							$mpng3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jmpng3 = mysql_num_rows($mpng3);
							if ($jmpng3 == 0) {
								echo "-";
							} else {
								echo $jmpng3;
							}
							?>
						</td>
						<td><?php
							$mpng4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jmpng4 = mysql_num_rows($mpng4);
							if ($jmpng4 == 0) {
								echo "-";
							} else {
								echo $jmpng4;
							}
							?>
						</td>
						<td><?php
							$mpng = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%'");
							$jmpng = mysql_num_rows($mpng);
							if ($jmpng == 0) {
								echo "-";
							} else {
								echo $jmpng;
							}
							?>
						</td>
						<td><?php
							$mpne2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jmpne2 = mysql_num_rows($mpne2);
							if ($jmpne2 == 0) {
								echo "-";
							} else {
								echo $jmpne2;
							}
							?>
						</td>
						<td><?php
							$mpne3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jmpne3 = mysql_num_rows($mpne3);
							if ($jmpne3 == 0) {
								echo "-";
							} else {
								echo $jmpne3;
							}
							?>
						</td>
						<td><?php
							$mpne4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jmpne4 = mysql_num_rows($mpne4);
							if ($jmpne4 == 0) {
								echo "-";
							} else {
								echo $jmpne4;
							}
							?>
						</td>
						<td><?php
							$mpne5 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jmpne5 = mysql_num_rows($mpne5);
							if ($jmpne5 == 0) {
								echo "-";
							} else {
								echo $jmpne5;
							}
							?>
						</td>
						<td><?php
							$mpns = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Pensiun' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jmpns = mysql_num_rows($mpns);
							if ($jmpns == 0) {
								echo "-";
							} else {
								echo $jmpns;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- WAFAT</td>
						<td><?php
							$mwafg1 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jmwafg1 = mysql_num_rows($mwafg1);
							if ($jmwafg1 == 0) {
								echo "-";
							} else {
								echo $jmwafg1;
							}
							?>
						</td>
						<td><?php
							$mwafg2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jmwafg2 = mysql_num_rows($mwafg2);
							if ($jmwafg2 == 0) {
								echo "-";
							} else {
								echo $jmwafg2;
							}
							?>
						</td>
						<td><?php
							$mwafg3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jmwafg3 = mysql_num_rows($mwafg3);
							if ($jmwafg3 == 0) {
								echo "-";
							} else {
								echo $jmwafg3;
							}
							?>
						</td>
						<td><?php
							$mwafg4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jmwafg4 = mysql_num_rows($mwafg4);
							if ($jmwafg4 == 0) {
								echo "-";
							} else {
								echo $jmwafg4;
							}
							?>
						</td>
						<td><?php
							$mwafg = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%'");
							$jmwafg = mysql_num_rows($mwafg);
							if ($jmwafg == 0) {
								echo "-";
							} else {
								echo $jmwafg;
							}
							?>
						</td>
						<td><?php
							$mwafe2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jmwafe2 = mysql_num_rows($mwafe2);
							if ($jmwafe2 == 0) {
								echo "-";
							} else {
								echo $jmwafe2;
							}
							?>
						</td>
						<td><?php
							$mwafe3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jmwafe3 = mysql_num_rows($mwafe3);
							if ($jmwafe3 == 0) {
								echo "-";
							} else {
								echo $jmwafe3;
							}
							?>
						</td>
						<td><?php
							$mwafe4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jmwafe4 = mysql_num_rows($mwafe4);
							if ($jmwafe4 == 0) {
								echo "-";
							} else {
								echo $jmwafe4;
							}
							?>
						</td>
						<td><?php
							$mwafe5 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jmwafe5 = mysql_num_rows($mwafe5);
							if ($jmwafe5 == 0) {
								echo "-";
							} else {
								echo $jmwafe5;
							}
							?>
						</td>
						<td><?php
							$mwafs = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Wafat' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jmwafs = mysql_num_rows($mwafs);
							if ($jmwafs == 0) {
								echo "-";
							} else {
								echo $jmwafs;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- KENAIKAN PANGKAT</td>
						<td><?php
							$mnaikg1 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jmnaikg1 = mysql_num_rows($mnaikg1);
							if ($jmnaikg1 == 0) {
								echo "-";
							} else {
								echo $jmnaikg1;
							}
							?>
						</td>
						<td><?php
							$mnaikg2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jmnaikg2 = mysql_num_rows($mnaikg2);
							if ($jmnaikg2 == 0) {
								echo "-";
							} else {
								echo $jmnaikg2;
							}
							?>
						</td>
						<td><?php
							$mnaikg3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jmnaikg3 = mysql_num_rows($mnaikg3);
							if ($jmnaikg3 == 0) {
								echo "-";
							} else {
								echo $jmnaikg3;
							}
							?>
						</td>
						<td><?php
							$mnaikg4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jmnaikg4 = mysql_num_rows($mnaikg4);
							if ($jmnaikg4 == 0) {
								echo "-";
							} else {
								echo $jmnaikg4;
							}
							?>
						</td>
						<td><?php
							$mnaikg = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%'");
							$jmnaikg = mysql_num_rows($mnaikg);
							if ($jmnaikg == 0) {
								echo "-";
							} else {
								echo $jmnaikg;
							}
							?>
						</td>
						<td><?php
							$mnaike2 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jmnaike2 = mysql_num_rows($mnaike2);
							if ($jmnaike2 == 0) {
								echo "-";
							} else {
								echo $jmnaike2;
							}
							?>
						</td>
						<td><?php
							$mnaike3 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jmnaike3 = mysql_num_rows($mnaike3);
							if ($jmnaike3 == 0) {
								echo "-";
							} else {
								echo $jmnaike3;
							}
							?>
						</td>
						<td><?php
							$mnaike4 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jmnaike4 = mysql_num_rows($mnaike4);
							if ($jmnaike4 == 0) {
								echo "-";
							} else {
								echo $jmnaike4;
							}
							?>
						</td>
						<td><?php
							$mnaike5 = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jmnaike5 = mysql_num_rows($mnaike5);
							if ($jmnaike5 == 0) {
								echo "-";
							} else {
								echo $jmnaike5;
							}
							?>
						</td>
						<td><?php
							$mnaiks = mysql_query("SELECT * FROM tb_mutasi WHERE jns_mutasi='Kenaikan Pangkat' AND tgl_mutasi LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jmnaiks = mysql_num_rows($mnaiks);
							if ($jmnaiks == 0) {
								echo "-";
							} else {
								echo $jmnaiks;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>4</td>
						<td>JENIS HUKUMAN DISIPLIN</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- TEGURAN LISAN</td>
						<td><?php
							$hlisg1 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jhlisg1 = mysql_num_rows($hlisg1);
							if ($jhlisg1 == 0) {
								echo "-";
							} else {
								echo $jhlisg1;
							}
							?>
						</td>
						<td><?php
							$hlisg2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jhlisg2 = mysql_num_rows($hlisg2);
							if ($jhlisg2 == 0) {
								echo "-";
							} else {
								echo $jhlisg2;
							}
							?>
						</td>
						<td><?php
							$hlisg3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jhlisg3 = mysql_num_rows($hlisg3);
							if ($jhlisg3 == 0) {
								echo "-";
							} else {
								echo $jhlisg3;
							}
							?>
						</td>
						<td><?php
							$hlisg4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jhlisg4 = mysql_num_rows($hlisg4);
							if ($jhlisg4 == 0) {
								echo "-";
							} else {
								echo $jhlisg4;
							}
							?>
						</td>
						<td><?php
							$hlisg = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%'");
							$jhlisg = mysql_num_rows($hlisg);
							if ($jhlisg == 0) {
								echo "-";
							} else {
								echo $jhlisg;
							}
							?>
						</td>
						<td><?php
							$hlise2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jhlise2 = mysql_num_rows($hlise2);
							if ($jhlise2 == 0) {
								echo "-";
							} else {
								echo $jhlise2;
							}
							?>
						</td>
						<td><?php
							$hlise3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jhlise3 = mysql_num_rows($hlise3);
							if ($jhlise3 == 0) {
								echo "-";
							} else {
								echo $jhlise3;
							}
							?>
						</td>
						<td><?php
							$hlise4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jhlise4 = mysql_num_rows($hlise4);
							if ($jhlise4 == 0) {
								echo "-";
							} else {
								echo $jhlise4;
							}
							?>
						</td>
						<td><?php
							$hlise5 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jhlise5 = mysql_num_rows($hlise5);
							if ($jhlise5 == 0) {
								echo "-";
							} else {
								echo $jhlise5;
							}
							?>
						</td>
						<td><?php
							$hliss = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Lisan' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jhliss = mysql_num_rows($hliss);
							if ($jhliss == 0) {
								echo "-";
							} else {
								echo $jhliss;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- TEGURAN TERTULIS</td>
						<td><?php
							$hterg1 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jhterg1 = mysql_num_rows($hterg1);
							if ($jhterg1 == 0) {
								echo "-";
							} else {
								echo $jhterg1;
							}
							?>
						</td>
						<td><?php
							$hterg2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jhterg2 = mysql_num_rows($hterg2);
							if ($jhterg2 == 0) {
								echo "-";
							} else {
								echo $jhterg2;
							}
							?>
						</td>
						<td><?php
							$hterg3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jhterg3 = mysql_num_rows($hterg3);
							if ($jhterg3 == 0) {
								echo "-";
							} else {
								echo $jhterg3;
							}
							?>
						</td>
						<td><?php
							$hterg4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jhterg4 = mysql_num_rows($hterg4);
							if ($jhterg4 == 0) {
								echo "-";
							} else {
								echo $jhterg4;
							}
							?>
						</td>
						<td><?php
							$hterg = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%'");
							$jhterg = mysql_num_rows($hterg);
							if ($jhterg == 0) {
								echo "-";
							} else {
								echo $jhterg;
							}
							?>
						</td>
						<td><?php
							$htere2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jhtere2 = mysql_num_rows($htere2);
							if ($jhtere2 == 0) {
								echo "-";
							} else {
								echo $jhtere2;
							}
							?>
						</td>
						<td><?php
							$htere3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jhtere3 = mysql_num_rows($htere3);
							if ($jhtere3 == 0) {
								echo "-";
							} else {
								echo $jhtere3;
							}
							?>
						</td>
						<td><?php
							$htere4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jhtere4 = mysql_num_rows($htere4);
							if ($jhtere4 == 0) {
								echo "-";
							} else {
								echo $jhtere4;
							}
							?>
						</td>
						<td><?php
							$htere5 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jhtere5 = mysql_num_rows($htere5);
							if ($jhtere5 == 0) {
								echo "-";
							} else {
								echo $jhtere5;
							}
							?>
						</td>
						<td><?php
							$hters = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Teguran Tertulis' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jhters = mysql_num_rows($hters);
							if ($jhters == 0) {
								echo "-";
							} else {
								echo $jhters;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- TUNDA KENAIKAN BERKALA</td>
						<td><?php
							$hberg1 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jhberg1 = mysql_num_rows($hberg1);
							if ($jhberg1 == 0) {
								echo "-";
							} else {
								echo $jhberg1;
							}
							?>
						</td>
						<td><?php
							$hberg2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jhberg2 = mysql_num_rows($hberg2);
							if ($jhberg2 == 0) {
								echo "-";
							} else {
								echo $jhberg2;
							}
							?>
						</td>
						<td><?php
							$hberg3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jhberg3 = mysql_num_rows($hberg3);
							if ($jhberg3 == 0) {
								echo "-";
							} else {
								echo $jhberg3;
							}
							?>
						</td>
						<td><?php
							$hberg4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jhberg4 = mysql_num_rows($hberg4);
							if ($jhberg4 == 0) {
								echo "-";
							} else {
								echo $jhberg4;
							}
							?>
						</td>
						<td><?php
							$hberg = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%'");
							$jhberg = mysql_num_rows($hberg);
							if ($jhberg == 0) {
								echo "-";
							} else {
								echo $jhberg;
							}
							?>
						</td>
						<td><?php
							$hbere2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jhbere2 = mysql_num_rows($hbere2);
							if ($jhbere2 == 0) {
								echo "-";
							} else {
								echo $jhbere2;
							}
							?>
						</td>
						<td><?php
							$hbere3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jhbere3 = mysql_num_rows($hbere3);
							if ($jhbere3 == 0) {
								echo "-";
							} else {
								echo $jhbere3;
							}
							?>
						</td>
						<td><?php
							$hbere4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jhbere4 = mysql_num_rows($hbere4);
							if ($jhbere4 == 0) {
								echo "-";
							} else {
								echo $jhbere4;
							}
							?>
						</td>
						<td><?php
							$hbere5 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jhbere5 = mysql_num_rows($hbere5);
							if ($jhbere5 == 0) {
								echo "-";
							} else {
								echo $jhbere5;
							}
							?>
						</td>
						<td><?php
							$hbers = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Berkala' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jhbers = mysql_num_rows($hbers);
							if ($jhbers == 0) {
								echo "-";
							} else {
								echo $jhbers;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- TUNDA KENAIKAN PANGKAT</td>
						<td><?php
							$hpg1 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jhpg1 = mysql_num_rows($hpg1);
							if ($jhpg1 == 0) {
								echo "-";
							} else {
								echo $jhpg1;
							}
							?>
						</td>
						<td><?php
							$hpg2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jhpg2 = mysql_num_rows($hpg2);
							if ($jhpg2 == 0) {
								echo "-";
							} else {
								echo $jhpg2;
							}
							?>
						</td>
						<td><?php
							$hpg3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jhpg3 = mysql_num_rows($hpg3);
							if ($jhpg3 == 0) {
								echo "-";
							} else {
								echo $jhpg3;
							}
							?>
						</td>
						<td><?php
							$hpg4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jhpg4 = mysql_num_rows($hpg4);
							if ($jhpg4 == 0) {
								echo "-";
							} else {
								echo $jhpg4;
							}
							?>
						</td>
						<td><?php
							$hpg = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%'");
							$jhpg = mysql_num_rows($hpg);
							if ($jhpg == 0) {
								echo "-";
							} else {
								echo $jhpg;
							}
							?>
						</td>
						<td><?php
							$hpe2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jhpe2 = mysql_num_rows($hpe2);
							if ($jhpe2 == 0) {
								echo "-";
							} else {
								echo $jhpe2;
							}
							?>
						</td>
						<td><?php
							$hpe3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jhpe3 = mysql_num_rows($hpe3);
							if ($jhpe3 == 0) {
								echo "-";
							} else {
								echo $jhpe3;
							}
							?>
						</td>
						<td><?php
							$hpe4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jhpe4 = mysql_num_rows($hpe4);
							if ($jhpe4 == 0) {
								echo "-";
							} else {
								echo $jhpe4;
							}
							?>
						</td>
						<td><?php
							$hpe5 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jhpe5 = mysql_num_rows($hpe5);
							if ($jhpe5 == 0) {
								echo "-";
							} else {
								echo $jhpe5;
							}
							?>
						</td>
						<td><?php
							$hps = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Tunda Kenaikan Pangkat' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jhps = mysql_num_rows($hps);
							if ($jhps == 0) {
								echo "-";
							} else {
								echo $jhps;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- PEMBERHENTIAN</td>
						<td><?php
							$hpemg1 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'I/%'");
							$jhpemg1 = mysql_num_rows($hpemg1);
							if ($jhpemg1 == 0) {
								echo "-";
							} else {
								echo $jhpemg1;
							}
							?>
						</td>
						<td><?php
							$hpemg2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'II/%'");
							$jhpemg2 = mysql_num_rows($hpemg2);
							if ($jhpemg2 == 0) {
								echo "-";
							} else {
								echo $jhpemg2;
							}
							?>
						</td>
						<td><?php
							$hpemg3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'III/%'");
							$jhpemg3 = mysql_num_rows($hpemg3);
							if ($jhpemg3 == 0) {
								echo "-";
							} else {
								echo $jhpemg3;
							}
							?>
						</td>
						<td><?php
							$hpemg4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND gol LIKE 'IV/%'");
							$jhpemg4 = mysql_num_rows($hpemg4);
							if ($jhpemg4 == 0) {
								echo "-";
							} else {
								echo $jhpemg4;
							}
							?>
						</td>
						<td><?php
							$hpemg = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%'");
							$jhpemg = mysql_num_rows($hpemg);
							if ($jhpemg == 0) {
								echo "-";
							} else {
								echo $jhpemg;
							}
							?>
						</td>
						<td><?php
							$hpeme2 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'II/%'");
							$jhpeme2 = mysql_num_rows($hpeme2);
							if ($jhpeme2 == 0) {
								echo "-";
							} else {
								echo $jhpeme2;
							}
							?>
						</td>
						<td><?php
							$hpeme3 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'III/%'");
							$jhpeme3 = mysql_num_rows($hpeme3);
							if ($jhpeme3 == 0) {
								echo "-";
							} else {
								echo $jhpeme3;
							}
							?>
						</td>
						<td><?php
							$hpeme4 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'IV/%'");
							$jhpeme4 = mysql_num_rows($hpeme4);
							if ($jhpeme4 == 0) {
								echo "-";
							} else {
								echo $jhpeme4;
							}
							?>
						</td>
						<td><?php
							$hpeme5 = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND eselon LIKE 'V/%'");
							$jhpeme5 = mysql_num_rows($hpeme5);
							if ($jhpeme5 == 0) {
								echo "-";
							} else {
								echo $jhpeme5;
							}
							?>
						</td>
						<td><?php
							$hpems = mysql_query("SELECT * FROM tb_hukuman WHERE hukuman='Pemberhentian' AND tgl_sk LIKE '$skrg%' AND pangkat LIKE 'Staff%'");
							$jhpems = mysql_num_rows($hpems);
							if ($jhpems == 0) {
								echo "-";
							} else {
								echo $jhpems;
							}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>5</td>
						<td>JUMLAH PTT</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><?php
							$ptt = mysql_query("SELECT * FROM tb_pegawai WHERE status_kepeg='PTT' ");
							$jptt = mysql_num_rows($ptt);
							if ($jptt == 0) {
								echo "-";
							} else {
								echo $jptt;
							}
							?>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- PRIA</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><?php
							$pttl = mysql_query("SELECT * FROM tb_pegawai WHERE status_kepeg='PTT' AND jk='Laki-laki'");
							$jpttl = mysql_num_rows($pttl);
							if ($jpttl == 0) {
								echo "-";
							} else {
								echo $jpttl;
							}
							?>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>- WANITA</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><?php
							$pttp = mysql_query("SELECT * FROM tb_pegawai WHERE status_kepeg='PTT' AND jk='Perempuan'");
							$jpttp = mysql_num_rows($pttp);
							if ($jpttp == 0) {
								echo "-";
							} else {
								echo $jpttp;
							}
							?>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- end profile-section -->
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