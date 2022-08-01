<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/rekap/print-rekap-skpd.php" target="_blank" title="print" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Rekapitulasi <small>Pegawai Berdasarkan Unit Kerja</small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
	<div class="col-md-4">
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="10%">No<br />#</th>
						<th width="70%">Unit Kerja<br />&nbsp;</th>
						<th width="20%">Jumlah<br />Pegawai</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=0;
						$rekapskpd	=mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE status_mut='' GROUP BY unit_kerja");
						while($skpd=mysqli_fetch_array($rekapskpd, MYSQLI_ASSOC)){
						$no++
					?>
					<tr>
						<td><?=$no?></td>
						<td><?php
								$namaskpd=mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$skpd[unit_kerja]'");
								$nama=mysqli_fetch_array($namaskpd, MYSQLI_ASSOC);
								echo $nama['nama'];
							?>
						</td>
						<td><?php
								$jml=mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE status_mut='' AND unit_kerja='$skpd[unit_kerja]'");
								echo mysqli_num_rows($jml);
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
	<div class="col-md-8">
		<div class="panel panel-inverse overflow-hidden">
			<div class="panel-heading">
				<h3 class="panel-title">
					<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					    <i class="fa fa-plus-circle pull-right"></i> 
						<i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Statistik Unit Kerja
					</a>
				</h3>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in">
				<div class="panel-body">
					<div id="container" class="col-sm-12" style="height:380px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../../assets/js/highcharts.js" type="text/javascript"></script>
	<script type="text/javascript">
		var chart1; // globally available
			$(document).ready(function() {
				chart1 = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						type: 'column'
					},   
					title: {
						text: 'Statistik Unit Kerja'
					},
					xAxis: {
						categories: ['Unit Kerja']
					},
						yAxis: {
						title: {
							text: 'Jumlah'
						}
					},
					series:             
						[
						<?php 
						$sql   = "SELECT * FROM tb_pegawai WHERE status_mut='' GROUP BY unit_kerja";
						$query = mysqli_query($koneksi, $sql )  or die(mysqli_error($koneksi));
							while( $ret = mysqli_fetch_array( $query, MYSQLI_ASSOC) ){
									$r	=$ret['unit_kerja'];
									
									$nmskpd=mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$r'");
									$nm=mysqli_fetch_array($nmskpd, MYSQLI_ASSOC);
									$namaskpd= $nm['nama'];
									
									$sql_jumlah   = "SELECT * FROM tb_pegawai WHERE status_mut='' AND unit_kerja='$r'";        
									$query_jumlah = mysqli_query($koneksi, $sql_jumlah ) or die(mysqli_error($koneksi));
									$data = mysqli_num_rows( $query_jumlah );																									
							?>,
								{
									name: '<?php echo $namaskpd; ?>',
									data: [<?php echo $data; ?>]
								},
							<?php 
							
							}
							?>
						]
				});
			});	
	</script>