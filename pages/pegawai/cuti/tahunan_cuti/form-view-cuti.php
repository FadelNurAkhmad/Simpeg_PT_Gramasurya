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
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Form Pengajuan Cuti <small><i class="fa fa-angle-right"></i> List Data Cuti Tahunan&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";
$id_peg     = $_SESSION['id_peg'];
$query   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$id_peg'");
$data    = mysqli_fetch_array($query);

$tampilCuti    = mysqli_query($koneksi, "SELECT * FROM tb_cuti_tahunan WHERE id_peg='$id_peg' ORDER BY tanggal_cuti");

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
                </div>
                <h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilCuti); ?></span> rows for "Data Cuti Tahunan"</h4>
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
                            <th>Jenis Cuti</th>
                            <th>Keperluan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Lama Cuti</th>
                            <th class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        while ($cuti    = mysqli_fetch_array($tampilCuti)) {
                            $no++
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $cuti['jenis_cuti'] ?></td>
                                <td><?php echo $cuti['keperluan'] ?></td>
                                <td><?php echo $cuti['tanggal_cuti'] ?></td>
                                <td>
                                    <?php echo $cuti['tanggal_mulai'] ?>
                                    <b>s/d</b>
                                    <?php echo $cuti['tanggal_selesai'] ?>
                                </td>
                                <td><?php echo $cuti['lama_cuti'] ?> Hari</td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-success btn-icon btn-sm" data-toggle="modal" data-target="#Detail<?php echo $cuti['id_cuti'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
                                    <a type="button" class="btn btn-default btn-icon btn-sm" href="javascript:;" title="processed" disabled=""><i class="fa fa-pencil fa-lg"></i></a>
                                    <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $cuti['id_cuti'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            <!-- #modal-dialog-delete -->
                            <div id="Del<?php echo $cuti['id_cuti'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin akan menghapus data cuti dari Database ?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=delete-cuti&id_cuti=<?= $cuti['id_cuti'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="Detail<?php echo $cuti['id_cuti'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">
                                                <i class="ion-ios-gear text-danger"></i>
                                                Detail Pengajuan Cuti Tahunan ID_<?php echo $cuti['id_cuti'] ?>
                                            </h4>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="modal-body">
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Tgl Pengajuan</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['tanggal_cuti'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Tgl Pelaksanaan</label>
                                                    <div class="col-md-9">
                                                        :
                                                        <?php echo $cuti['tanggal_mulai'] ?>
                                                        <b>s/d</b>
                                                        <?php echo $cuti['tanggal_selesai'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Lama Cuti</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['lama_cuti'] ?> Hari
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Jenis Cuti</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['jenis_cuti'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Keperluan</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['keperluan'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-9">
                                                        :
                                                        <?php
                                                        $status = mysqli_query($koneksi, "SELECT status FROM tb_approval_cuti_tahunan WHERE id_approval_cuti='$cuti[id_cuti]'");
                                                        $stat    = mysqli_fetch_array($status);

                                                        if ($stat['status'] == 'Process') {
                                                            echo '<span class="badge badge-primary">PROCESS</span>';
                                                        } else if ($stat['status'] == 'Approve') {
                                                            echo '<span class="badge badge-success">APPROVED</span>';
                                                        } else if ($stat['status'] == 'Reject') {
                                                            echo '<span class="badge badge-danger">REJECTED</span>';
                                                        }
                                                        ?>
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