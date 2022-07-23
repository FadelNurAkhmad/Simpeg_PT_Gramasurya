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
    <li><a href="index.php?page=form-master-jatah-cuti" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Input Jatah Cuti</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Cuti <small> <i class="fa fa-angle-right"></i> Jatah Cuti Tahunan&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";

$tampilCuti    = mysqli_query(
    $koneksi,
    "SELECT tb_jatah_cuti.id_jatah, tb_jatah_cuti.id_peg, tb_jatah_cuti.jatah_c_mulai, tb_jatah_cuti.jatah_c_akhir, tb_jatah_cuti.jatah_c_jml, tb_jatah_cuti.jatah_c_ambil, tb_jatah_cuti.jatah_c_sisa, pegawai.pegawai_nip, pegawai.pegawai_nama
    FROM tb_jatah_cuti
    INNER JOIN pegawai ON tb_jatah_cuti.id_peg=pegawai.pegawai_id ORDER BY id_jatah DESC"
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
                </div>
                <h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilCuti); ?></span> rows for "Jatah Cuti Tahunan"</h4>
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
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Jatah Cuti</th>
                            <th>Diambil</th>
                            <th>Sisa Cuti</th>
                            <th class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        while ($jatah    = mysqli_fetch_array($tampilCuti)) {
                            $no++
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $jatah == 0 ? '-' : $jatah['pegawai_nip']; ?></td>
                                <td><?php echo $jatah['pegawai_nama'] ?></td>
                                <td><?php echo $jatah['jatah_c_mulai'] ?></td>
                                <td><?php echo $jatah['jatah_c_akhir'] ?></td>
                                <td><?php echo $jatah['jatah_c_jml'] ?></td>
                                <td><?php echo $jatah['jatah_c_ambil'] ?></td>
                                <td><?php echo $jatah['jatah_c_sisa'] ?></td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-jatah-cuti&id_jatah=<?= $jatah['id_jatah'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
                                    <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $jatah['id_jatah'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            <!-- #modal-dialog-delete -->
                            <div id="Del<?php echo $jatah['id_jatah'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin akan menghapus data <u><?php echo $jatah['pegawai_nama'] ?></u> dari Database ?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=delete-jatah-cuti&id_jatah=<?= $jatah['id_jatah'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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