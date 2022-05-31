<?php	
	include "../../config/koneksi.php";
	$query	=mysqli_query($koneksi, "SELECT * FROM tb_setup_sekda WHERE id_setup_sekda='1'");
	$data	=mysqli_fetch_array($query, MYSQLI_ASSOC);	
?>
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
	<li><a href="index.php?page=form-setup-sekda&id_setup_sekda=<?=$data['id_setup_sekda']?>" title="setup" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-gear"></i> &nbsp;Setup</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Setup <small>Sekretariat Daerah &nbsp;</small></h1>
<!-- end page-header -->
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="tab-content">
			<!-- begin table -->
			<div class="table-responsive">
				<table class="table table-profile">
					<thead>
						<tr>
							<th><h5><span class="label label-inverse pull-right"> # SEKDA </span></h5></th>
							<th>
								<h4>Sekretariat Daerah</h4>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="highlight">
							<td class="field">Kabupaten / Kota</td>
							<td><?=$data['kab']?></td>
						</tr>
						<tr class="divider">
							<td colspan="2"></td>
						</tr>
						<tr>
							<td class="field">Alamat</td>
							<td><i class="fa fa-map-marker fa-lg m-r-5"></i> <?=$data['alamat']?></td>
						</tr>
						<tr>
							<td class="field">Sekretasis Daerah</td>
							<td><?php
								$sekda	=mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$data[sekda]'");
								$sek	=mysqli_fetch_array($sekda, MYSQLI_ASSOC);
								echo $sek['nama']
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- end table -->
		</div>
	</div>
</div>
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>