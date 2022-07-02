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
    <li><a href="index.php?page=form-master-cuti" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Input Data Cuti</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Cuti <small><i class="fa fa-angle-right"></i> Data Cuti&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";
// $tampilCuti    = mysqli_query($koneksi, "SELECT * FROM tb_data_cuti ORDER BY id_cuti DESC");
$tampilCuti    = mysqli_query(
    $koneksi,
    "SELECT tb_data_cuti.id_cuti, tb_data_cuti.id_peg, tb_data_cuti.tanggal_cuti, tb_data_cuti.tanggal_mulai, tb_data_cuti.tanggal_selesai, tb_data_cuti.lama_cuti, tb_data_cuti.jumlah_cuti, tb_data_cuti.jenis_cuti, tb_data_cuti.keperluan, tb_data_cuti.status, pegawai.pegawai_nip, pegawai.pegawai_nama
    FROM tb_data_cuti
    INNER JOIN pegawai ON tb_data_cuti.id_peg=pegawai.pegawai_id ORDER BY id_cuti DESC"
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
                <h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilCuti); ?></span> rows for "Data Cuti"</h4>
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
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Lama Cuti</th>
                            <th>Jenis Cuti</th>
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
                                <td><?php echo $cuti == 0 ? '-' : $cuti['pegawai_nip']; ?></td>
                                <td><?php echo $cuti['pegawai_nama'] ?></td>
                                <td><?php echo $cuti['tanggal_cuti'] ?></td>
                                <td>
                                    <?php echo $cuti['tanggal_mulai'] ?>
                                    <b>s/d</b>
                                    <?php echo $cuti['tanggal_selesai'] ?>
                                </td>
                                <td><?php echo $cuti['lama_cuti'] ?> Hari</td>
                                <td><?php echo $cuti['jenis_cuti'] ?></td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Approve<?php echo $cuti['id_cuti'] ?>" title="Approve"><i class="fa fa-check"> </i> Approve</a>
                                    <a type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Reject<?php echo $cuti['id_cuti'] ?>" title="Reject"><i class="fa fa-close"> </i> Reject</a>
                                    <a type="button" class="btn btn-success btn-icon btn-sm" data-toggle="modal" data-target="#Detail<?php echo $cuti['id_cuti'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
                                    <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-cuti&id_cuti=<?= $cuti['id_cuti'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
                                    <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $cuti['id_cuti'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            <!-- #modal-dialog-delete -->
                            <div id="Del<?php echo $cuti['id_cuti'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin akan menghapus data <u><?php echo $cuti['pegawai_nama'] ?></u> dari Database ?</h5>
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
                            <!-- #modal-dialog-approve -->
                            <div id="Approve<?php echo $cuti['id_cuti'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Approval</span> &nbsp; Anda yakin approve cuti <u><?php echo $cuti['pegawai_nama'] ?></u> ?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=status-cuti&true=true&id_cuti=<?= $cuti['id_cuti'] ?>" class="btn btn-success">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #modal-dialog-reject -->
                            <div id="Reject<?php echo $cuti['id_cuti'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Reject</span> &nbsp; Anda yakin reject cuti <u><?php echo $cuti['pegawai_nama'] ?></u> ?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=status-cuti&false=false&id_cuti=<?= $cuti['id_cuti'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
                                                Detail Pengajuan Cuti ID_<?php echo $cuti['id_cuti'] ?>
                                            </h4>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="modal-body">
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">NIP</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti == 0 ? '-' : $cuti['pegawai_nip']; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Nama</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['pegawai_nama'] ?>
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
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-9">
                                                        :
                                                        <?php
                                                        if ($cuti['status'] == 'Process') {
                                                            echo '<span class="badge badge-primary">PROCESS</span>';
                                                        } else if ($cuti['status'] == 'Approve') {
                                                            echo '<span class="badge badge-success">APPROVED</span>';
                                                        } else if ($cuti['status'] == 'Reject') {
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