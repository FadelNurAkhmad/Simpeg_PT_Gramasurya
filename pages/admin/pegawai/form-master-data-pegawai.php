<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$_SESSION['pesan'] ="";
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data <small>Pegawai <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
<!-- end page-header -->
<?php
	include "../../config/koneksi.php";
	function kdauto($tabel, $inisial){
		$struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
		$field      = mysqli_field_name($struktur,0);
		$panjang    = mysqli_field_len($struktur,0);
		$qry  = mysqli_query($koneksi, "SELECT max(".$field.") FROM ".$tabel);
		$row  = mysqli_fetch_array($qry, MYSQLI_ASSOC);
		if ($row[0]=="") {
		$angka=0;
		}
		else {
		$angka= substr($row[0], strlen($inisial));
		}
		$angka++;
		$angka      =strval($angka);
		$tmp  ="";
		for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";
		}
		return $inisial.$tmp.$angka;
		}
	$id_peg	=kdauto("tb_pegawai","");
?>
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
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Form master data pegawai</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=master-data-pegawai&id_peg=<?=$id_peg?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="col-md-3 control-label">NIP</label>
						<div class="col-md-6">
							<input type="text" name="nip" maxlength="24" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tempat, Tanggal Lahir</label>
						<div class="col-md-3">
							<input type="text" name="tempat_lhr" maxlength="64" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_lhr" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Pegawai</label>
						<div class="col-md-6">
							<input type="text" name="nama" maxlength="64" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Agama</label>
						<div class="col-md-6">
							<select name="agama" class="default-select2 form-control">
								<option value="">...</option>    
								<option value="Islam">Islam</option>
								<option value="Protestan">Protestan</option>
								<option value="Katolik">Katolik</option>
								<option value="Hindu">Hindu</option>
								<option value="Budha">Budha</option>
								<option value="Kong Hu Cu">Kong Hu Cu</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Kelamin</label>
						<div class="col-md-6">
							<select name="jk" class="default-select2 form-control">
								<option value="">...</option>    
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Golongan Darah</label>
						<div class="col-md-6">
							<select name="gol_darah" class="default-select2 form-control">
								<option value="">...</option>    
								<option value="A">A</option>
								<option value="AB">AB</option>
								<option value="B">B</option>
								<option value="O">O</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status Pernikahan</label>
						<div class="col-md-6">
							<select name="status_nikah" class="default-select2 form-control">
								<option value="">...</option>    
								<option value="Nikah">Nikah</option>
								<option value="Belum Nikah">Belum Nikah</option>
								<option value="Cerai">Cerai</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status Kepegawaian</label>
						<div class="col-md-6">
							<select name="status_kepeg" class="default-select2 form-control">
								<option value="">...</option>    
								<option value="PNS">PNS</option>
								<option value="PTT">PTT</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Kenaikan Pangkat</label>
						<div class="col-md-6">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_naikpangkat" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Kenaikan Gaji</label>
						<div class="col-md-6">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_naikgaji" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<textarea name="alamat" maxlength="255" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">No. Telp</label>
						<div class="col-md-6">
							<input type="text" name="telp" maxlength="12" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-md-6">
							<input type="text" name="email" maxlength="64" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Unit Kerja</label>
						<div class="col-md-6">
							<?php
								$unit = mysqli_query($koneksi, "SELECT * FROM tb_unit ORDER BY nama");        
								echo '<select name="id_unit" class="default-select2 form-control">';    
								echo '<option value="">...</option>';    
									while ($rowunit = mysqli_fetch_array($unit, MYSQLI_ASSOC)) {    
									echo '<option value="'.$rowunit['id_unit'].'">'.$rowunit['nama'].'</option>';    
									}    
								echo '</select>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right">Foto</label>
						<div class="col-sm-6">
							<input type="file" name="foto" maxlength="255" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-data-pegawai"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>