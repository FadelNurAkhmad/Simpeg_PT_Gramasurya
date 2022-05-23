<?php
	if ($_POST['report'] == "report") {
	$pensiun_reminder	=$_POST['pensiun_reminder'];
	}
	if ($pensiun_reminder =="now"){
		$tahun=date("Y");
	}
	else if ($pensiun_reminder =="one"){
		$tahun=date("Y") + 1;
	}
	else{
		$tahun=date("Y") + 2;
	}
?>
<!-- begin page-header -->
<h1 class="page-header">Report <small>Pensiun <i class="fa fa-angle-right"></i> Tahun <?=$tahun?></small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="panel-body">
			<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
				<thead>
					<tr>
						<th width="5%"><i class="fa fa-key hidden-480"></i> No</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>TTL</th>
						<th>JK</th>
						<th>No. Telp</th>
						<th>Periode Pensiun</th>
					</tr>
				</thead>
				<tbody>
					<?php
						include "../../config/koneksi.php";
						$no=0;
						$tampilPeg	=mysql_query("SELECT * FROM tb_pegawai WHERE status_mut='' AND tgl_pensiun LIKE '$tahun%' ORDER BY tgl_pensiun");
						while($peg	=mysql_fetch_array($tampilPeg)){
						$no++
					?>
					<tr>
						<td><?=$no?></td>
						<td><?php echo $peg['nip'];?></td>
						<td><?php echo $peg['nama']?></td>
						<td><?php echo $peg['tempat_lhr']?>, <?php echo $peg['tgl_lhr']?></td>
						<td><?php echo $peg['jk']?></td>
						<td><?php echo $peg['telp']?></td>
						<td><?php echo $peg['tgl_pensiun']?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- end profile-section -->
</div>