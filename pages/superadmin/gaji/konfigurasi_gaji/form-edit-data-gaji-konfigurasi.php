<?php
if (isset($_GET['id_gaji_konfig'])) {
    $id_gaji_konfig = $_GET['id_gaji_konfig'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM tb_gaji_konfigurasi WHERE id_gaji_konfig='$id_gaji_konfig'");
    $gaji    = mysqli_fetch_array($query);

    $tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$gaji[id_peg]'");
    $peg    = mysqli_fetch_array($tampilPeg);

    $tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$gaji[id_peg]'");
    $jab    = mysqli_fetch_array($tampilJab);
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
<h1 class="page-header">Form <small>Edit Gaji &nbsp;<i class="fa fa-angle-right"></i>&nbsp; <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?> &nbsp;&nbsp;<i class="fa fa-lock"></i> Jabatan : <?= $jab == 0 ? '-' : $jab['jabatan']; ?></small></h1>
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
                <h4 class="panel-title">Form Edit Jumlah Gaji Diterima</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-data-gaji-konfigurasi&id_gaji_konfig=<?= $id_gaji_konfig ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Periode<span aria-required="true" class="text-warning"> * </span></label>
                                <div class="col-md-3">
                                    <select name="bulan" id="bulan" class="default-select2 form-control">
                                        <option value="Januari" <?php echo ($gaji['bulan'] == 'Januari') ? "selected" : ""; ?>>Januari
                                        <option value="Februari" <?php echo ($gaji['bulan'] == 'Februari') ? "selected" : ""; ?>>Februari
                                        <option value="Maret" <?php echo ($gaji['bulan'] == 'Maret') ? "selected" : ""; ?>>Maret
                                        <option value="April" <?php echo ($gaji['bulan'] == 'April') ? "selected" : ""; ?>>April
                                        <option value="Mei" <?php echo ($gaji['bulan'] == 'Mei') ? "selected" : ""; ?>>Mei
                                        <option value="Juni" <?php echo ($gaji['bulan'] == 'Juni') ? "selected" : ""; ?>>Juni
                                        <option value="Juli" <?php echo ($gaji['bulan'] == 'Juli') ? "selected" : ""; ?>>Juli
                                        <option value="Agustus" <?php echo ($gaji['bulan'] == 'Agustus') ? "selected" : ""; ?>>Agustus
                                        <option value="September" <?php echo ($gaji['bulan'] == 'September') ? "selected" : ""; ?>>September
                                        <option value="Oktober" <?php echo ($gaji['bulan'] == 'Oktober') ? "selected" : ""; ?>>Oktober
                                        <option value="November" <?php echo ($gaji['bulan'] == 'November') ? "selected" : ""; ?>>November
                                        <option value="Desember" <?php echo ($gaji['bulan'] == 'Desember') ? "selected" : ""; ?>>Desember
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="tahun" id="tahun" class="default-select2 form-control">
                                        <option value="2020" <?php echo ($gaji['tahun'] == '2020') ? "selected" : ""; ?>>2020
                                        <option value="2021" <?php echo ($gaji['tahun'] == '2021') ? "selected" : ""; ?>>2021
                                        <option value="2022" <?php echo ($gaji['tahun'] == '2022') ? "selected" : ""; ?>>2022
                                        <option value="2023" <?php echo ($gaji['tahun'] == '2023') ? "selected" : ""; ?>>2023
                                        <option value="2024" <?php echo ($gaji['tahun'] == '2024') ? "selected" : ""; ?>>2024
                                        <option value="2025" <?php echo ($gaji['tahun'] == '2025') ? "selected" : ""; ?>>2025
                                        <option value="2026" <?php echo ($gaji['tahun'] == '2026') ? "selected" : ""; ?>>2026
                                        <option value="2027" <?php echo ($gaji['tahun'] == '2027') ? "selected" : ""; ?>>2027
                                        <option value="2028" <?php echo ($gaji['tahun'] == '2028') ? "selected" : ""; ?>>2028
                                        <option value="2029" <?php echo ($gaji['tahun'] == '2029') ? "selected" : ""; ?>>2029
                                        <option value="2030" <?php echo ($gaji['tahun'] == '2030') ? "selected" : ""; ?>>2030
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Tanggal<span aria-required="true" class="text-warning"> * </span></label>
                                <div class="col-md-6">
                                    <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                                        <input type="text" name="tanggal_gaji_konfig" id="tanggal_gaji_konfig" value="<?= $gaji['tanggal_gaji_konfig'] ?>" class="form-control" />
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Jumlah Gaji Diterima</label>
                                <div class="col-md-6">
                                    <div class="form-inline">
                                        Rp. <input type="number" name="gaji_diterima" id="gaji_diterima" value="<?= $gaji['gaji_diterima'] ?>" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <br>
                    <div id="tunj_tetap">
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Tunjangan Tetap</label>
                                <div class="col-md-6">
                                    <div class="form-inline">
                                        Rp.
                                        <input class="form-control" type="number" name="tunjangan_tetap" id="tunjangan_tetap" value="<?= $gaji['tunjangan_tetap'] ?>" data-parsley-required="true" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Struktural</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="struktural" id="struktural" value="<?= $gaji['struktural'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Pendidikan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="pendidikan" id="pendidikan" value="<?= $gaji['pendidikan'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Keahlian</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="keahlian" id="keahlian" value="<?= $gaji['keahlian'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Penyesuaian</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="penyesuaian" id="penyesuaian" value="<?= $gaji['penyesuaian'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <br>
                    <div id="tunj_variabel">
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Tunjangan Variabel</label>
                                <div class="col-md-6">
                                    <div class="form-inline">
                                        Rp. <input class="form-control" type="number" name="tunjangan_variabel" id="tunjangan_variabel" value="<?= $gaji['tunjangan_variabel'] ?>" data-parsley-required="true" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Presensi</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="presensi" id="presensi" value="<?= $gaji['presensi'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Uang Makan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="uang_makan" id="uang_makan" value="<?= $gaji['uang_makan'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Kehadiran</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="kehadiran" id="kehadiran" value="<?= $gaji['kehadiran'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Kedisiplinan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="kedisiplinan" id="kedisiplinan" value="<?= $gaji['kedisiplinan'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Istri/Suami</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="istri_suami" id="istri_suami" value="<?= $gaji['istri_suami'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Anak</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="anak" id="anak" value="<?= $gaji['anak'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <h4 class="text-start">Potongan Variabel</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="potongan_variabel">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Presensi</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="presensi_pot" id="presensi_pot" value="<?= $gaji['presensi_pot'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Uang Makan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="uang_makan_pot" id="uang_makan_pot" value="<?= $gaji['uang_makan_pot'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Kehadiran</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="kehadiran_pot" id="kehadiran_pot" value="<?= $gaji['kehadiran_pot'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Kedisiplinan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="kedisiplinan_pot" id="kedisiplinan_pot" value="<?= $gaji['kedisiplinan_pot'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Jumlah</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="jumlah_pot_var" id="jumlah_pot_var" value="<?= $gaji['jumlah_pot_var'] ?>" data-parsley-required="true" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <h4 class="text-start">Potongan Wajib</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="potongan_wajib">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">BPJS</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="bpjs" id="bpjs" value="<?= $gaji['bpjs'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Koperasi</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="koperasi" id="koperasi" value="<?= $gaji['koperasi'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Dapen Muh</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="dapen_muh" id="dapen_muh" value="<?= $gaji['dapen_muh'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Lainnya</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="lainya" id="lainya" value="<?= $gaji['lainya'] ?>" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Jumlah</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="number" name="jumlah_pot_wajib" id="jumlah_pot_wajib" value="<?= $gaji['jumlah_pot_wajib'] ?>" data-parsley-required="true" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Gaji Pokok</label>
                                <div class="col-md-6">
                                    <div class="form-inline">
                                        Rp.
                                        <input class="form-control" type="number" name="gaji_pokok" id="gaji_pokok" value="<?= $gaji['gaji_pokok'] ?>" data-parsley-required="true" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Edit</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-data-gaji-konfigurasi"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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


<script type="text/javascript">
    $(document).ready(function() {

        $("#tunj_tetap").keyup(function() {
            var struktural = parseInt($("#struktural").val());
            var pendidikan = parseInt($("#pendidikan").val());
            var keahlian = parseInt($("#keahlian").val());
            var penyesuaian = parseInt($("#penyesuaian").val());

            var total_tunj_tetap = parseInt(struktural + pendidikan + keahlian + penyesuaian);
            $("#tunjangan_tetap").val(total_tunj_tetap);
        });

        $("#tunj_variabel").keyup(function() {
            var presensi = parseInt($("#presensi").val());
            var uang_makan = parseInt($("#uang_makan").val());
            var kehadiran = parseInt($("#kehadiran").val());
            var kedisiplinan = parseInt($("#kedisiplinan").val());
            var istri_suami = parseInt($("#istri_suami").val());
            var anak = parseInt($("#anak").val());

            var total_tunj_var = parseInt(presensi + uang_makan + kehadiran + kedisiplinan + istri_suami + anak);
            $("#tunjangan_variabel").val(total_tunj_var);
        });

        $("#potongan_wajib").keyup(function() {
            var bpjs = parseInt($("#bpjs").val());
            var koperasi = parseInt($("#koperasi").val());
            var dapen_muh = parseInt($("#dapen_muh").val());
            var lainya = parseInt($("#lainya").val());

            var total_wajib = parseInt(bpjs + koperasi + dapen_muh + lainya);
            $("#jumlah_pot_wajib").val(total_wajib);
        });

        $("#potongan_variabel").keyup(function() {
            var presensi_pot = parseInt($("#presensi_pot").val());
            var uang_makan_pot = parseInt($("#uang_makan_pot").val());
            var kehadiran_pot = parseInt($("#kehadiran_pot").val());
            var kedisiplinan_pot = parseInt($("#kedisiplinan_pot").val());

            var total_var = parseInt(presensi_pot + uang_makan_pot + kehadiran_pot + kedisiplinan_pot);
            $("#jumlah_pot_var").val(total_var);
        });

        function hitung() {
            var gaji_pokok = parseInt($("#gaji_pokok").val());
            var tunjangan_tetap = parseInt($("#tunjangan_tetap").val());
            var tunjangan_variabel = parseInt($("#tunjangan_variabel").val());
            var jumlah_pot_var = parseInt($("#jumlah_pot_var").val());
            var jumlah_pot_wajib = parseInt($("#jumlah_pot_wajib").val());

            var gd = parseInt((gaji_pokok + tunjangan_tetap + tunjangan_variabel) - (jumlah_pot_var + jumlah_pot_wajib));
            $("#gaji_diterima").val(gd);

        };

        $("#jumlah_pot_wajib").on("keyup keypress blur change focus", function() {
            hitung();
        });
        $("#jumlah_pot_var").on("keyup keypress blur change focus", function() {
            hitung();
        });
        $("#tunjangan_variabel").on("keyup keypress blur change focus", function() {
            hitung();
        });
        $("#tunjangan_tetap").on("keyup keypress blur change focus", function() {
            hitung();
        });
        $("#gaji_pokok").on("keyup keypress blur change focus", function() {
            hitung();
        });

    });
</script>