<?php
if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM tb_kpi WHERE id_kategori='$id_kategori'");
    $kpi    = mysqli_fetch_array($query);

    $tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$kpi[id_peg]'");
    $peg    = mysqli_fetch_array($tampilPeg);
} else {
    die("Error. No ID Selected!");
}
?>
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
<h1 class="page-header">KPI <small>Form Edit KPI <i class="fa fa-angle-right"></i> <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?> &nbsp;&nbsp;<i class="fa fa-lock"></i> NIP : <?= $peg == 0 ? '-' : $peg['pegawai_nip']; ?></small></h1>
<!-- end page-header -->

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
                <h4 class="panel-title">Form Edit KPI Pegawai</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-kpi&id_kategori=<?= $id_kategori ?>" class="form-horizontal" method="POST">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Divisi<span aria-required="true" class="text-danger"> * </span></label>
                                <div class="col-md-6">
                                    <?php
                                    $div = mysqli_query($koneksi, "SELECT * FROM tb_divisi_kpi ORDER BY divisi ASC");
                                    echo '<select name="divisi" class="default-select2 form-control">';
                                    echo '<option value="">...</option>';
                                    while ($row = mysqli_fetch_array($div)) {
                                        echo '<option value="' . $row['divisi'] . '">' . $row['divisi'] . '</option>';
                                    }
                                    echo '</select>';
                                    ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Tanggal Buat<span aria-required="true" class="text-danger"> * </span></label>
                                <div class="col-md-6">
                                    <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                                        <input type="text" name="tanggal_kpi" id="tanggal_kpi" value="<?= $kpi['tanggal_kpi'] ?>" class="form-control" />
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Periode<span aria-required="true" class="text-danger"> * </span></label>
                                <div class="col-md-3">
                                    <select name="bulan" id="bulan" class="default-select2 form-control">
                                        <option value="Januari" <?php echo ($kpi['bulan'] == 'Januari') ? "selected" : ""; ?>>Januari
                                        <option value="Februari" <?php echo ($kpi['bulan'] == 'Februari') ? "selected" : ""; ?>>Februari
                                        <option value="Maret" <?php echo ($kpi['bulan'] == 'Maret') ? "selected" : ""; ?>>Maret
                                        <option value="April" <?php echo ($kpi['bulan'] == 'April') ? "selected" : ""; ?>>April
                                        <option value="Mei" <?php echo ($kpi['bulan'] == 'Mei') ? "selected" : ""; ?>>Mei
                                        <option value="Juni" <?php echo ($kpi['bulan'] == 'Juni') ? "selected" : ""; ?>>Juni
                                        <option value="Juli" <?php echo ($kpi['bulan'] == 'Juli') ? "selected" : ""; ?>>Juli
                                        <option value="Agustus" <?php echo ($kpi['bulan'] == 'Agustus') ? "selected" : ""; ?>>Agustus
                                        <option value="September" <?php echo ($kpi['bulan'] == 'September') ? "selected" : ""; ?>>September
                                        <option value="Oktober" <?php echo ($kpi['bulan'] == 'Oktober') ? "selected" : ""; ?>>Oktober
                                        <option value="November" <?php echo ($kpi['bulan'] == 'November') ? "selected" : ""; ?>>November
                                        <option value="Desember" <?php echo ($kpi['bulan'] == 'Desember') ? "selected" : ""; ?>>Desember
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="tahun" id="tahun" class="default-select2 form-control">
                                        <option value="2020" <?php echo ($kpi['tahun'] == '2020') ? "selected" : ""; ?>>2020
                                        <option value="2021" <?php echo ($kpi['tahun'] == '2021') ? "selected" : ""; ?>>2021
                                        <option value="2022" <?php echo ($kpi['tahun'] == '2022') ? "selected" : ""; ?>>2022
                                        <option value="2023" <?php echo ($kpi['tahun'] == '2023') ? "selected" : ""; ?>>2023
                                        <option value="2024" <?php echo ($kpi['tahun'] == '2024') ? "selected" : ""; ?>>2024
                                        <option value="2025" <?php echo ($kpi['tahun'] == '2025') ? "selected" : ""; ?>>2025
                                        <option value="2026" <?php echo ($kpi['tahun'] == '2026') ? "selected" : ""; ?>>2026
                                        <option value="2027" <?php echo ($kpi['tahun'] == '2027') ? "selected" : ""; ?>>2027
                                        <option value="2028" <?php echo ($kpi['tahun'] == '2028') ? "selected" : ""; ?>>2028
                                        <option value="2029" <?php echo ($kpi['tahun'] == '2029') ? "selected" : ""; ?>>2029
                                        <option value="2030" <?php echo ($kpi['tahun'] == '2030') ? "selected" : ""; ?>>2030
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-kpi"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
                        </div>
                    </div>
                </form>

                <hr>

                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No.</th>
                                <th width="25%">Sasaran Kerja</th>
                                <th width="10%">Satuan KPI</th>
                                <th>Target KPI</th>
                                <th>Bobot</th>
                                <th>Score</th>
                                <th>Nilai</th>
                                <th width="10%">Dokumen</th>
                                <th width="10%">Kendala</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="tbl-kpi-body">
                            <?php
                            $no = 0;
                            $query2   = mysqli_query($koneksi, "SELECT * FROM tb_kpi WHERE id_kategori='$id_kategori'");
                            while ($kpi2 = mysqli_fetch_array($query2)) {
                                $no++
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $kpi2['sasaran_kerja']; ?></td>
                                    <td><?php echo $kpi2['satuan_kpi']; ?></td>
                                    <td><?php echo $kpi2['target_kpi']; ?></td>
                                    <td><?php echo $kpi2['bobot']; ?></td>
                                    <td><?php echo $kpi2['score']; ?></td>
                                    <td><?php echo $kpi2['nilai']; ?></td>
                                    <td><?php echo $kpi2['dokumen']; ?></td>
                                    <td><?php echo $kpi2['kendala']; ?></td>
                                    <td class="tools" align="center">
                                        <a type="button" class="btn btn-info btn-icon btn-sm" data-toggle="modal" data-target="#edit<?php echo $kpi2['id_data_kpi'] ?>" title="edit"><i class="fa-lg fa fa-edit"></i></a>
                                        <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $kpi2['id_data_kpi'] ?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <!-- #modal-dialog-delete -->
                                <div id="Del<?php echo $kpi2['id_data_kpi'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin akan menghapus data KPI <u><?php echo $kpi2['id_data_kpi'] ?></u> dari Database ?</h5>
                                            </div>
                                            <div class="modal-body" align="center">
                                                <a href="index.php?page=delete-kpi&id_data_kpi=<?= $kpi2['id_data_kpi'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Edit -->
                                <div id="edit<?php echo $kpi2['id_data_kpi'] ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">
                                                    <i class="ion-ios-gear text-danger"></i>
                                                    Edit Data KPI
                                                </h4>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="modal-body">
                                                    <form action="index.php?page=masterkpi&id_data_kpi=<?= $kpi2['id_data_kpi'] ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group col-sm-12">
                                                            <label class="col-md-3 control-label">Sasaran Kerja<span aria-required="true" class="text-warning"> * </span></label>
                                                            <div class="col-md-6">
                                                                <textarea type="text" name="sasaran_kerja" maxlength="255" class="form-control"><?= $kpi2['sasaran_kerja'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="col-md-3 control-label">Satuan KPI</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="satuan_kpi" value="<?= $kpi2['satuan_kpi'] ?>" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="col-md-3 control-label">Target KPI</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="target_kpi" value="<?= $kpi2['target_kpi'] ?>" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="col-md-3 control-label">Bobot</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="bobot" value="<?= $kpi2['bobot'] ?>" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="col-md-3 control-label">Score</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="score" value="<?= $kpi2['score'] ?>" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="col-md-3 control-label">Nilai</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="nilai" value="<?= $kpi2['nilai'] ?>" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="col-md-3 control-label">Dokumen</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="dokumen" value="<?= $kpi2['dokumen'] ?>" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="col-md-3 control-label">Kendala</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="kendala" value="<?= $kpi2['kendala'] ?>" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="col-md-3 control-label"></label>
                                                            <div class="col-md-6">
                                                                <button type="submit" name="edit2" value="edit2" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
                                                                <!-- <a href="index.php?page=masterkpi&id_data_kpi=<?= $kpi2['id_data_kpi'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</a>&nbsp; -->
                                                                <a type="button" class="btn btn-default active" data-dismiss="modal" aria-hidden="true"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
                                                            </div>
                                                        </div>
                                                    </form>
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

<!-- <script>
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
                            <input type="text" name="target_kpi[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="bobot[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="score[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="nilai[]" class="form-control">
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
</script> -->

<!-- <script>
    $(document).ready(function() {
        fetch_data();

        function fetch_data() {
            $.ajax({
                url: "ambil-data.php",
                method: "POST",
                dataType: "json",
                success: function(data) {
                    var html = '';
                    for (var count = 0; count < data.length; count++) {
                        html += '<tr>';
                        html += '<td><input type="checkbox" id_data_kpi="' + data[count].id_data_kpi + '" data-sasaran_kerja="' + data[count].sasaran_kerja + '" data-satuan_kpi="' + data[count].satuan_kpi + '" data-target_kpi="' + data[count].target_kpi + '" data-bobot="' + data[count].bobot + '" data-score="' + data[count].score + '" data-nilai="' + data[count].nilai + '" data-dokumen="' + data[count].dokumen + '" data-kendala="' + data[count].kendala + '" class="check_box"  /></td>';
                        html += '<td>' + data[count].sasaran_kerja + '</td>';
                        html += '<td>' + data[count].satuan_kpi + '</td>';
                        html += '<td>' + data[count].target_kpi + '</td>';
                        html += '<td>' + data[count].bobot + '</td>';
                        html += '<td>' + data[count].score + '</td>';
                        html += '<td>' + data[count].nilai + '</td>';
                        html += '<td>' + data[count].dokumen + '</td>';
                        html += '<td>' + data[count].kendala + '</td></tr>';
                    }
                    $('tbody').html(html);
                }
            });
        }

        $('#update_form').on('click', '.check_box', function() {
            var html = '';
            if (this.checked) {
                html = '<td><input type="checkbox" id_data_kpi="' + $(this).attr('id_data_kpi') + '" data-sasaran_kerja="' + $(this).data('sasaran_kerja') + '" data-satuan_kpi="' + $(this).data('satuan_kpi') + '" data-target_kpi="' + $(this).data('target_kpi') + '" data-bobot="' + $(this).data('bobot') + '" data-score="' + $(this).data('score') + '" data-nilai="' + $(this).data('nilai') + '" data-dokumen="' + $(this).data('dokumen') + '" data-kendala="' + $(this).data('kendala') + '" class="check_box" checked /></td>';
                html += '<td><input type="text" name="sasaran_kerja[]" class="form-control" value="' + $(this).data("sasaran_kerja") + '" /></td>';
                html += '<td><input type="text" name="satuan_kpi[]" class="form-control" value="' + $(this).data("satuan_kpi") + '" /></td>';
                html += '<td><input type="text" name="target_kpi[]" class="form-control" value="' + $(this).data("target_kpi") + '" /></td>';
                html += '<td><input type="text" name="bobot[]" class="form-control" value="' + $(this).data("bobot") + '" /></td>';
                html += '<td><input type="text" name="score[]" class="form-control" value="' + $(this).data("score") + '" /></td>';
                html += '<td><input type="text" name="nilai[]" class="form-control" value="' + $(this).data("nilai") + '" /></td>';
                html += '<td><input type="text" name="dokumen[]" class="form-control" value="' + $(this).data("dokumen") + '" /></td>';
                html += '<td><input type="text" name="kendala[]" class="form-control" value="' + $(this).data("kendala") + '" /><input type="hidden" name="hidden_id[]" value="' + $(this).attr('id_data_dokumen') + '" /></td>';
            } else {
                html = '<td><input type="checkbox" id_data_kpi="' + $(this).attr('id_data_kpi') + '" data-sasaran_kerja="' + $(this).data('sasaran_kerja') + '" data-satuan_kpi="' + $(this).data('satuan_kpi') + '" data-target_kpi="' + $(this).data('target_kpi') + '" data-bobot="' + $(this).data('bobot') + '" data-score="' + $(this).data('score') + '" data-nilai="' + $(this).data('nilai') + '" data-dokumen="' + $(this).data('dokumen') + '" data-kendala="' + $(this).data('kendala') + '" class="check_box" checked /></td>';
                html += '<td>' + $(this).data('sasaran_kerja') + '</td>';
                html += '<td>' + $(this).data('satuan_kpi') + '</td>';
                html += '<td>' + $(this).data('target_kpi') + '</td>';
                html += '<td>' + $(this).data('bobot') + '</td>';
                html += '<td>' + $(this).data('score') + '</td>';
                html += '<td>' + $(this).data('nilai') + '</td>';
                html += '<td>' + $(this).data('dokumen') + '</td>';
                html += '<td>' + $(this).data('kendala') + '</td>';
            }
            $(this).closest('tr').html(html);
            $('#nilai_' + $(this).attr('id_data_kpi') + '').val($(this).data('nilai'));
        });

        $('#update_form').on('submit', function(event) {
            event.preventDefault();
            if ($('.check_box:checked').length > 0) {
                $.ajax({
                    url: "multiple_update.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        alert('Data Berhasil Diubah');
                        fetch_data();
                    }
                })
            }
        });
    });
</script> -->