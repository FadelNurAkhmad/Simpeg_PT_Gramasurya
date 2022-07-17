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
    <li><a href="index.php?page=form-master-data-jadwal-kerja-pegawai" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Tambah Jadwal Kerja Pegawai</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Presensi <small><i class="fa fa-angle-right"></i> Jadwal Kerja Pegawai&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";

$tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id ASC");

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
                <h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilPeg); ?></span> rows for "Data Presensi"</h4>
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
                            <th>Nama Pegawai</th>
                            <th>Jadwal Kerja</th>
                            <th>Tgl. Mulai Jadwal</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        while ($peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC)) {
                            $no++;
                            $tampilDataPre    = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_pegawai WHERE pegawai_id='$peg[pegawai_id]'");
                            $dataPre    = mysqli_fetch_array($tampilDataPre, MYSQLI_ASSOC);

                            $check = mysqli_num_rows($tampilDataPre);

                            if ($check > 0) {
                                $tampilJdw = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id='$dataPre[jdw_kerja_m_id]'");
                                $jdw = mysqli_fetch_array($tampilJdw, MYSQLI_ASSOC);
                            } else {
                                unset($jdw);
                            }

                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $peg['pegawai_nip'] ?></td>
                                <td><?php echo $peg['pegawai_nama'] ?></td>
                                <td><?php echo (isset($jdw['jdw_kerja_m_id'])) ? "$jdw[jdw_kerja_m_name]" : "" ?></td>
                                <td><?php echo (isset($dataPre['jdw_kerja_m_mulai'])) ? "$dataPre[jdw_kerja_m_mulai]" : "" ?></td>

                                <td class="text-center">
                                    <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-data-jadwal-kerja-pegawai&pegawai_id=<?= $peg['pegawai_id'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
                                    <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $peg['pegawai_id'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            <!-- #modal-dialog -->
                            <div id="Del<?php echo $peg['pegawai_id'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete <u><?php echo $peg['pegawai_nama'] ?></u> from Database?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=delete-data-jadwal-kerja-pegawai&pegawai_id=<?= $peg['pegawai_id'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
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