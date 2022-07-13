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
    <li><a href="index.php?page=form-master-lokasi" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Input Data Lokasi</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Lokasi <small>&nbsp;Lokasi tipe 1</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";
// $tampilCuti    = mysqli_query($koneksi, "SELECT * FROM tb_data_cuti ORDER BY id_cuti DESC");
$tampilLokasi    = mysqli_query(
    $koneksi,
    "SELECT tb_lokasi.id_lokasi, tb_lokasi.id_peg, tb_lokasi.nama_lokasi, tb_lokasi.lat, tb_lokasi.lng, tb_lokasi.alamat, pegawai.pegawai_nip, pegawai.pegawai_nama
    FROM tb_lokasi
    INNER JOIN pegawai ON tb_lokasi.id_peg=pegawai.pegawai_id ORDER BY id_lokasi DESC"
);

?>
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
                <h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilLokasi); ?></span> rows for "Data Lokasi"</h4>
            </div>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-info fa-2x pull-left"></i> Gunakan button di sebelah kanan setiap baris tabel untuk menuju instruksi view detail, edit dan hapus data ...
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                        <tr>
                            <th width="4%">No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Nama Lokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        while ($lok    = mysqli_fetch_array($tampilLokasi)) {
                            $no++
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $lok == 0 ? '-' : $lok['pegawai_nip']; ?></td>
                                <td><?php echo $lok['pegawai_nama'] ?></td>
                                <td><?php echo $lok['nama_lokasi'] ?></td>
                                <td><?php echo $lok['lat'] ?></td>
                                <td><?php echo $lok['lng'] ?></td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-warning btn-xs" href="index.php?page=view-lokasi&id_lokasi=<?= $lok['id_lokasi'] ?>" title="View"><i class="fa fa-eye"> </i> View Map</a>
                                    <a type="button" class="btn btn-success btn-icon btn-sm" data-toggle="modal" data-target="#Detail<?php echo $lok['id_lokasi'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
                                    <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-lokasi&id_lokasi=<?= $lok['id_lokasi'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
                                    <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $lok['id_lokasi'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            <!-- #modal-dialog-delete -->
                            <div id="Del<?php echo $lok['id_lokasi'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin akan menghapus data lokasi <u><?php echo $lok['pegawai_nama'] ?></u> dari Database ?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=delete-lokasi&id_lokasi=<?= $lok['id_lokasi'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="Detail<?php echo $lok['id_lokasi'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">
                                                <i class="ion-ios-gear text-danger"></i>
                                                Detail Lokasi ID_<?php echo $lok['id_lokasi'] ?>
                                            </h4>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="modal-body">
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">NIP</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $lok == 0 ? '-' : $lok['pegawai_nip']; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Nama</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $lok['pegawai_nama'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Nama Lokasi</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $lok['nama_lokasi'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Latitude</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $lok['lat'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Longitude</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $lok['lng'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Alamat</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $lok['alamat'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
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