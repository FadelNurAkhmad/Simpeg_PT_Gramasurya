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
<h1 class="page-header">Approval <small> <i class="fa fa-angle-right"></i> Approval Tahap 1&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";

// ambil data gabungan tabel pegawai dan tb_cuti_tahunan (Cuti Tahunan)
$tampilCuti    = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_cuti_tahunan
    INNER JOIN pegawai ON tb_cuti_tahunan.id_peg=pegawai.pegawai_id ORDER BY id_cuti DESC"
);

// ambil data gabungan tabel pegawai dan tb_cuti_umum (Izin)
$tampilCutiUmum    = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_cuti_umum
    INNER JOIN pegawai ON tb_cuti_umum.id_peg=pegawai.pegawai_id ORDER BY id_cuti_umum DESC"
);


?>

<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#cuti_tahunan" data-toggle="tab"><span class="visible-xs">Cuti Tahunan</span><span class="hidden-xs"><i class="ion-ios-person fa-lg text-success"></i> Cuti Tahunan</span></a></li>
            <li class=""><a href="#izin" data-toggle="tab"><span class="visible-xs">Izin</span><span class="hidden-xs"><i class="ion-ios-person fa-lg text-warning"></i> Izin</span></a></li>
        </ul>
        <!-- begin tab-content -->
        <div class="tab-content">
            <!-- tab pegawai cuti tahunan -->
            <div class="tab-pane fade active in" id="cuti_tahunan">
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat data approval cuti tahunan tahap 1 ...
                </div>
                <div class="table-responsive">
                    <table id="" class="table table-striped table-bordered nowrap display" width="100%">
                        <thead>
                            <tr>
                                <th width="4%">No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Lama Cuti</th>
                                <th>Jenis Cuti</th>
                                <th>Status Cuti</th>
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
                                    <td><?php
                                        if ($cuti['status'] == 'Process') {
                                            echo '<span class="badge badge-primary">PROCESS</span>&nbsp;<span class="badge bg-warning">1</span>';
                                        } else if ($cuti['status'] == 'Approve') {
                                            echo '<span class="badge badge-success">APPROVED</span>&nbsp;<span class="badge bg-warning">1</span>';
                                        } else if ($cuti['status'] == 'Reject') {
                                            echo '<span class="badge badge-danger">REJECTED</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Approve<?php echo $cuti['id_cuti'] ?>" title="Approve"><i class="fa fa-check"> </i> Approve</a>
                                        <a type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Reject<?php echo $cuti['id_cuti'] ?>" title="Reject"><i class="fa fa-close"> </i> Reject</a>
                                        <a type="button" class="btn btn-success btn-icon btn-sm" data-toggle="modal" data-target="#Detail<?php echo $cuti['id_cuti'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
                                        <!-- <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-cuti&id_cuti=<?= $cuti['id_cuti'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a> -->
                                        <!-- <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $cuti['id_cuti'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a> -->
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
                                                <a href="index.php?page=delete-approval-tahunan&id_cuti=<?= $cuti['id_cuti'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
                                                <h5 class="modal-title"><span class="label label-inverse"> # Approval</span> &nbsp; Anda yakin approve cuti <?php echo $cuti['jenis_cuti'] ?> <u><?php echo $cuti['pegawai_nama'] ?></u> ?</h5>
                                            </div>
                                            <div class="modal-body" align="center">
                                                <p>Mohon periksa kembali data pengajuan cuti terlampir. Pastikan semua informasi telah <span class="label label-primary">SESUAI</span> !</p>
                                                <br>
                                                <a href="index.php?page=status-cuti-tahunan&true=true&id_cuti=<?= $cuti['id_cuti'] ?>" class="btn btn-success">&nbsp; &nbsp;SETUJU&nbsp; &nbsp;</a>
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
                                                <p>Mohon periksa kembali data pengajuan cuti terlampir. Pastikan semua informasi telah <span class="label label-primary">SESUAI</span> !</p>
                                                <br>
                                                <a href="index.php?page=status-cuti-tahunan&false=false&id_cuti=<?= $cuti['id_cuti'] ?>" class="btn btn-danger">&nbsp; &nbsp;YA&nbsp; &nbsp;</a>
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
                                                                echo '<span class="badge badge-primary">PROCESS</span>&nbsp;<span class="badge bg-warning">1</span>';
                                                            } else if ($cuti['status'] == 'Approve') {
                                                                echo '<span class="badge badge-success">APPROVED</span>&nbsp;<span class="badge bg-warning">1</span>';
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
            <!-- end tab pegawai aktif -->
            <!-- tab pegawai non-aktif -->
            <div class="tab-pane fade" id="izin">
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat data approval izin tahap 1 ...
                </div>
                <div class="table-responsive">
                    <table id="" class="table table-striped table-bordered nowrap display" width="100%">
                        <thead>
                            <tr>
                                <th width="4%">No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Lama Cuti</th>
                                <th>Jenis Cuti</th>
                                <th>Status</th>
                                <th class="text-center" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            while ($izin    = mysqli_fetch_array($tampilCutiUmum)) {
                                $no++
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $izin == 0 ? '-' : $izin['pegawai_nip']; ?></td>
                                    <td><?php echo $izin['pegawai_nama'] ?></td>
                                    <td><?php echo $izin['tanggal_cuti'] ?></td>
                                    <td>
                                        <?php echo $izin['tanggal_mulai'] ?>
                                        <b>s/d</b>
                                        <?php echo $izin['tanggal_selesai'] ?>
                                    </td>
                                    <td><?php echo $izin['lama_cuti'] ?> Hari</td>
                                    <td><?php echo $izin['jenis_cuti'] ?></td>
                                    <td><?php
                                        if ($izin['status'] == 'Process') {
                                            echo '<span class="badge badge-primary">PROCESS</span>&nbsp;<span class="badge bg-warning">1</span>';
                                        } else if ($izin['status'] == 'Approve') {
                                            echo '<span class="badge badge-success">APPROVED</span>&nbsp;<span class="badge bg-warning">1</span>';
                                        } else if ($izin['status'] == 'Reject') {
                                            echo '<span class="badge badge-danger">REJECTED</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Approve<?php echo $izin['id_cuti_umum'] ?>" title="Approve"><i class="fa fa-check"> </i> Approve</a>
                                        <a type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Reject<?php echo $izin['id_cuti_umum'] ?>" title="Reject"><i class="fa fa-close"> </i> Reject</a>
                                        <a type="button" class="btn btn-success btn-icon btn-sm" data-toggle="modal" data-target="#Detail<?php echo $izin['id_cuti_umum'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
                                        <!-- <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-cuti-umum&id_cuti_umum=<?= $izin['id_cuti_umum'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a> -->
                                        <!-- <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del1<?php echo $izin['id_cuti_umum'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a> -->
                                    </td>
                                </tr>
                                <!-- #modal-dialog-delete -->
                                <div id="Del1<?php echo $izin['id_cuti_umum'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin akan menghapus data <u><?php echo $izin['pegawai_nama'] ?></u> dari Database ?</h5>
                                            </div>
                                            <div class="modal-body" align="center">
                                                <a href="index.php?page=delete-approval-izin&id_cuti_umum=<?= $izin['id_cuti_umum'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #modal-dialog-approve -->
                                <div id="Approve<?php echo $izin['id_cuti_umum'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><span class="label label-inverse"> # Approval</span> &nbsp; Anda yakin approve izin <?php echo $izin['jenis_cuti'] ?> <u><?php echo $izin['pegawai_nama'] ?></u> ?</h5>
                                            </div>
                                            <div class="modal-body" align="center">
                                                <p>Mohon periksa kembali data pengajuan izin terlampir. Pastikan semua informasi telah <span class="label label-primary">SESUAI</span> !</p>
                                                <br>
                                                <a href="index.php?page=status-cuti-umum&true=true&id_cuti_umum=<?= $izin['id_cuti_umum'] ?>" class="btn btn-success">&nbsp; &nbsp;SETUJU&nbsp; &nbsp;</a>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #modal-dialog-reject -->
                                <div id="Reject<?php echo $izin['id_cuti_umum'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><span class="label label-inverse"> # Reject</span> &nbsp; Anda yakin reject izin <u><?php echo $izin['pegawai_nama'] ?></u> ?</h5>
                                            </div>
                                            <div class="modal-body" align="center">
                                                <p>Mohon periksa kembali data pengajuan izin terlampir. Pastikan semua informasi telah <span class="label label-primary">SESUAI</span> !</p>
                                                <br>
                                                <a href="index.php?page=status-cuti-umum&false=false&id_cuti_umum=<?= $izin['id_cuti_umum'] ?>" class="btn btn-danger">&nbsp; &nbsp;YA&nbsp; &nbsp;</a>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="Detail<?php echo $izin['id_cuti_umum'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">
                                                    <i class="ion-ios-gear text-danger"></i>
                                                    Detail Pengajuan Cuti Umum ID_<?php echo $izin['id_cuti_umum'] ?>
                                                </h4>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="modal-body">
                                                    <div class="form-group col-sm-12">
                                                        <label class="col-md-3 control-label">NIP</label>
                                                        <div class="col-md-9">
                                                            : <?php echo $izin == 0 ? '-' : $izin['pegawai_nip']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-12">
                                                        <label class="col-md-3 control-label">Nama</label>
                                                        <div class="col-md-9">
                                                            : <?php echo $izin['pegawai_nama'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-12">
                                                        <label class="col-md-3 control-label">Jenis Cuti</label>
                                                        <div class="col-md-9">
                                                            : <?php echo $izin['jenis_cuti'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-12">
                                                        <label class="col-md-3 control-label">Keperluan</label>
                                                        <div class="col-md-9">
                                                            : <?php echo $izin['keperluan'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-12">
                                                        <label class="col-md-3 control-label">Tgl Pengajuan</label>
                                                        <div class="col-md-9">
                                                            : <?php echo $izin['tanggal_cuti'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-12">
                                                        <label class="col-md-3 control-label">Tgl Pelaksanaan</label>
                                                        <div class="col-md-9">
                                                            :
                                                            <?php echo $izin['tanggal_mulai'] ?>
                                                            <b>s/d</b>
                                                            <?php echo $izin['tanggal_selesai'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-12">
                                                        <label class="col-md-3 control-label">Lama Cuti</label>
                                                        <div class="col-md-9">
                                                            : <?php echo $izin['lama_cuti'] ?> Hari
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-12">
                                                        <label class="col-md-3 control-label">Status</label>
                                                        <div class="col-md-9">
                                                            :
                                                            <?php
                                                            if ($izin['status'] == 'Process') {
                                                                echo '<span class="badge badge-primary">PROCESS</span>&nbsp;<span class="badge bg-warning">1</span>';
                                                            } else if ($izin['status'] == 'Approve') {
                                                                echo '<span class="badge badge-success">APPROVED</span>&nbsp;<span class="badge bg-warning">1</span>';
                                                            } else if ($izin['status'] == 'Reject') {
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
            <!-- end tab pegawai non aktif -->

        </div>
        <!-- end tab-content -->
    </div>
    <!-- end col-12 -->
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

    $(document).ready(function() {
        $('table.display').DataTable();
    });
</script>