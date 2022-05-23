<!-- begin page-header -->
<h1 class="page-header">Report <small>Pensiun</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="panel-body">
			<form action="index.php?page=pensiun" class="form-horizontal" method="POST" enctype="multipart/form-data" >
				<div class="form-group">
					<label class="col-md-4 control-label">Pilih Periode</label>
					<div class="col-md-3">
						<select name="pensiun_reminder" class="default-select2 form-control">
							<option value="now">Tahun Ini</option>
							<option value="one">1 Tahun Yang Akan Datang</option>
							<option value="two">2 Tahun Yang Akan Datang</option>
						</select>
					</div>
					<div class="col-md-4">
						<button type="submit" name="report" value="report" class="btn btn-success"><i class="fa fa-search"></i> &nbsp;Get Report</button>&nbsp;
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- end profile-section -->
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
						$tampilPeg	=mysql_query("SELECT * FROM tb_pegawai WHERE status_mut='' ORDER BY tgl_pensiun");
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
