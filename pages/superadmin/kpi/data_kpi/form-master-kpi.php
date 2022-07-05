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
<h1 class="page-header">KPI <small>Form Master KPI <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
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
$id_data_kpi   = kdauto("tb_kpi", "");
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
                </div>
                <h4 class="panel-title">Form KPI Pegawai</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=master-kpi" class="form-horizontal" method="POST">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Pegawai</label>
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
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Tanggal Buat</label>
                                <div class="col-md-6">
                                    <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                                        <input type="text" name="tanggal_kpi" id="tanggal_kpi" class="form-control" />
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Divisi</label>
                                <div class="col-md-6">
                                    <?php
                                    $data = mysqli_query($koneksi, "SELECT * FROM tb_divisi_kpi ORDER BY divisi ASC");
                                    echo '<select name="divisi" class="default-select2 form-control">';
                                    echo '<option value="">...</option>';
                                    while ($row = mysqli_fetch_array($data)) {
                                        echo '<option value="' . $row['divisi'] . '">' . $row['divisi'] . '</option>';
                                    }
                                    echo '</select>';
                                    ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Periode</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="bulan" id="bulan">
                                        <?php
                                        $arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                        foreach ($arr as $key) {
                                            echo "<option value='$key'>$key";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="tahun" id="tahun" class="form-control">
                                        <?php
                                        for ($i = 2020; $i < 2031; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <br>

                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="hidden" id="id_kategori" name="id_kategori" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th width="20%">Sasaran Kerja</th>
                                        <th width="12%">Satuan KPI</th>
                                        <th>Target KPI</th>
                                        <th>Bobot</th>
                                        <th>Score</th>
                                        <th>Nilai</th>
                                        <th width="15%">Dokumen</th>
                                        <th width="15%">Kendala</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-kpi-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-sm btn-primary m-b-10" id="btn-tambah"><i class="fa fa-plus-circle"></i> &nbsp;TAMBAH</button>
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <label class="col-md-5 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-kpi"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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

<script>
    $(function() {
        var count = 0;

        if (count == 0) {
            $('.btnSave').hide();
        }
        $('#btn-tambah').on('click', function() {
            count += 1;
            $('#tbl-kpi-body').append(`
            <tr>
                        <td>` + count + `</td>
                        <td>
                            <input type="text" name="sasaran_kerja[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="satuan_kpi[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" id="target_kpi" name="target_kpi[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" id="bobot" name="bobot[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" id="score" name="score[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" id="nilai" name="nilai[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="dokumen[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="kendala[]" class="form-control">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-icon btn-sm removeItem"><i class="fa fa-trash-o fa-lg"></i></button>
                        </td>
                    </tr>
                `);

            if (count > 0) {
                $('.btnSave').show();
            }

            $('.removeItem').on('click', function() {
                $(this).closest("tr").remove();
                count -= 1;
                if (count == 0) {
                    $('.btnSave').hide();
                }
            })
        })
    })
</script>

<!-- <script type="text/javascript">
    $(document).ready(function() {

        $("#tbl-kpi-body").keyup(function() {
            var target_kpi = parseInt($("#target_kpi").val());
            var bobot = parseInt($("#bobot").val());
            var score = parseInt($("#score").val());

            var nilai = parseInt(score / target_kpi) * bobot;
            $("#nilai").val(nilai);
        });

    });
</script> -->