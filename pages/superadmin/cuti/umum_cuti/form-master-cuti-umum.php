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
<h1 class="page-header">Cuti / Izin <small> <i class="fa fa-angle-right"></i> Izin <i class="fa fa-angle-right"></i> Input Izin&nbsp;</small></h1>
<!-- end page-header -->
<?php
function kdauto($tabel, $inisial)
{
    include "../../config/koneksi.php";

    $struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
    $fieldInfo = mysqli_fetch_field_direct($struktur, 0);
    $field      = $fieldInfo->name;
    $panjang    = $fieldInfo->length;
    $qry  = mysqli_query($koneksi, "SELECT max(" . $field . ") FROM " . $tabel);
    $row  = mysqli_fetch_array($qry);
    if ($row[0] == "") {
        $angka = 0;
    } else {
        $angka = substr($row[0], strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp  = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
        $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
}
$id_cuti_umum    = kdauto("tb_cuti_umum", "");
?>
<!-- begin row -->
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
                <h4 class="panel-title">Form Input Izin</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=master-cuti-umum&id_cuti_umum=<?= $id_cuti_umum ?>" class=" form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pegawai<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_nama ASC");
                            echo '<select name="id_peg" class="default-select2 form-control">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data)) {
                                echo '<option value="' . $row['pegawai_id'] . '">' . $row['pegawai_nama'] . '_' . $row['pegawai_nip'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Izin<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <?php
                            $dataJ = mysqli_query($koneksi, "SELECT * FROM tb_jenis_cuti ORDER BY jenis");
                            echo '<select name="jenis_cuti" class="default-select2 form-control">';
                            echo '<option value="">...</option>';
                            while ($rowj = mysqli_fetch_array($dataJ, MYSQLI_ASSOC)) {
                                echo '<option value="' . $rowj['jenis'] . '">' . $rowj['jenis'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Keperluan<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <textarea type="text" name="keperluan" maxlength="255" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Pengajuan Izin<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tanggal_cuti" placeholder="Mulai" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Pelaksanaan<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-3">
                            <div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tanggal_mulai" placeholder="Dari" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tanggal_selesai" placeholder="Sampai" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Lama Izin<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" name="lama_cuti" class="form-control" placeholder="Dalam Hari"></input>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="hidden" id="jumlah_cuti" name="jumlah_cuti" value="1" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="hidden" id="status" name="status" value="Process">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-cuti-umum"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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