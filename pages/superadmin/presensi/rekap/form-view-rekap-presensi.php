<?php

include "../../config/koneksi.php";
function timeScan($attribute)
{
    $datetime = new DateTime($attribute);
    $jam = $datetime->format('H:i:s');
    return $jam;
}

// mengambil data presensi mesin untuk scanlog
$tampilPres    = mysqli_query($koneksi, "SELECT * FROM att_log ORDER BY scan_date DESC LIMIT 100");

// mengambil data pegawai untuk rekapharian
$tampilPeg2    = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id ASC");

// mengambil data pegawai untuk rekapperiode
$tampilPeg3    = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id ASC");

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
<div class="row ">
    <div class="col-12 col-md-4">
        <h1 class="page-header">Presensi <small><i class="fa fa-angle-right"></i> Rekap Presensi&nbsp;</small></h1>
    </div>
    <div class="col-6 col-md-8">
        <form action="index.php?page=form-view-rekap-presensi" method="POST" enctype="multipart/form-data">
            <div class="form-group col-md-3">
                <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="periode_awal" placeholder="Dari" class="form-control" />
                </div>
            </div>
            <div class="form-group col-md-3">
                <div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="periode_akhir" placeholder="Sampai" class="form-control" />
                </div>
            </div>
            <div class="form-group col-sm-4 m-b-10">
                <button type="submit" name="cari" value="cari" class="btn btn-primary"><i class="ion-ios-search-strong"></i> &nbsp;Cari</button>&nbsp;
                <!-- <a href="#" class="btn btn-sm btn-success" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a> -->
            </div>
        </form>
    </div>
</div>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#scanlog" data-toggle="tab"><span class="visible-xs">Data Scanlog</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Data Scanlog</span></a></li>
            <li class=""><a href="#rekapharian" data-toggle="tab"><span class="visible-xs">Rekap Harian</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Rekap Harian</span></a></li>
            <li class=""><a href="#rekapperiode" data-toggle="tab"><span class="visible-xs">Rekap Periode</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Rekap Periode</span></a></li>
        </ul>
        <!-- begin tab-content -->
        <div class="tab-content">
            <!-- tab scanlog -->
            <div class="tab-pane fade active in" id="scanlog">
                <?php

                ?>
                <li style="text-align:right ;"><a href="index.php?page=export-scanlog&periodeawal=<?= (isset($_POST['periode_awal'])) ? $_POST['periode_awal'] : null ?>&periodeakhir=<?= (isset($_POST['periode_akhir'])) ? $_POST['periode_akhir'] : null ?>" class="btn btn-sm btn-success m-b-10" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a></li>

                <div class="alert alert-success fade in">

                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat rekap presensi ...
                </div>
                <div class="table-responsive">
                    <table id="" class="table table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th>Tanggal Scan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>PIN</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>SN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_POST['periode_awal']) && !empty($_POST['periode_akhir'])) {
                                $tampilCari = mysqli_query($koneksi, "SELECT * FROM att_log WHERE DATE(scan_date) >= '$_POST[periode_awal]' AND DATE(scan_date) <= '$_POST[periode_akhir]'");
                                $no = 0;
                                while ($cari = mysqli_fetch_array($tampilCari, MYSQLI_ASSOC)) {
                                    $no++;
                            ?>
                                    <tr>
                                        <td><?php echo $cari['scan_date'] ?></td>
                                        <?php
                                        $myvalue = $cari['scan_date'];
                                        $datetime = new DateTime($myvalue);

                                        $date = $datetime->format('Y-m-d');
                                        $time = $datetime->format('H:i:s');
                                        ?>
                                        <td><?= $date ?></td>
                                        <td><?= $time ?></td>
                                        <?php
                                        $tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$cari[pin]'");
                                        $peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
                                        ?>
                                        <td><?= $cari['pin'] ?></td>
                                        <td><?= $peg['pegawai_nip'] ?></td>
                                        <td><?= $peg['pegawai_nama'] ?></td>
                                        <td><?php
                                            $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
                                            $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
                                            if (isset($jab)) {
                                                echo $jab['pembagian1_nama'];
                                            } else {
                                                echo "";
                                            }
                                            ?>
                                        </td>
                                        <td><?= $cari['sn'] ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            <?php
                            if (empty($_POST['periode_awal']) && empty($_POST['periode_akhir'])) {
                                $no = 0;
                                while ($pres    = mysqli_fetch_array($tampilPres, MYSQLI_ASSOC)) {
                                    $no++;
                            ?>
                                    <tr>
                                        <td><?php echo $pres['scan_date'] ?></td>
                                        <?php
                                        $myvalue = $pres['scan_date'];
                                        $datetime = new DateTime($myvalue);

                                        $tanggal = $datetime->format('Y-m-d');
                                        $jam = $datetime->format('H:i:s');
                                        ?>
                                        <td><?= $tanggal ?></td>
                                        <td><?= $jam ?></td>
                                        <?php
                                        $tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$pres[pin]'");
                                        $peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
                                        ?>
                                        <td><?= $pres['pin'] ?></td>
                                        <td><?= $peg['pegawai_nip'] ?></td>
                                        <td><?= $peg['pegawai_nama'] ?></td>
                                        <td><?php
                                            $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
                                            $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
                                            if (isset($jab)) {
                                                echo $jab['pembagian1_nama'];
                                            } else {
                                                echo "";
                                            }
                                            ?>
                                        </td>
                                        <td><?= $pres['sn'] ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end tab scanlog -->
            <!-- tab rekap harian -->
            <div class="tab-pane fade" id="rekapharian">
                <li style="text-align:right ;"><a href="<?php echo $file1; ?>" class="btn btn-sm btn-success m-b-10" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a></li>
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat rekap presensi ...
                </div>

                <div class="table-responsive">
                    <table id="" class="table table-bordered nowrap display" width="100%">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jadwal Kerja</th>
                                <th>Shift</th>
                                <th>PIN</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Jam Masuk</th>
                                <th>Scan Masuk</th>
                                <th>Terlambat</th>
                                <th>Scan Istirahat 1</th>
                                <th>Scan Istirahat 2</th>
                                <th>Jam Pulang</th>
                                <th>Scan Pulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_POST['periode_awal']) && !empty($_POST['periode_akhir'])) {
                                while ($peg    = mysqli_fetch_array($tampilPeg2, MYSQLI_ASSOC)) {
                                    $tampilCari = mysqli_query($koneksi, "SELECT * FROM shift_result WHERE tgl_shift >= '$_POST[periode_awal]' AND tgl_shift <= '$_POST[periode_akhir]' AND pegawai_id = '$peg[pegawai_id]'");

                                    while ($cari = mysqli_fetch_array($tampilCari, MYSQLI_ASSOC)) {

                                        $jdwM    = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id='$cari[jdw_kerja_m_id]'");
                                        $jdw    = mysqli_fetch_array($jdwM, MYSQLI_ASSOC);

                                        $tampilJk    = mysqli_query($koneksi, "SELECT * FROM jam_kerja WHERE jk_id='$cari[jk_id]'");
                                        $jk    = mysqli_fetch_array($tampilJk, MYSQLI_ASSOC);

                                        $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
                                        $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
                            ?>
                                        <tr <?= (isset($jk)) ? "class=''" : "class='danger'" ?>>
                                            <td><?= $cari['tgl_shift'] ?></td>
                                            <td><?= (isset($jdw)) ? $jdw['jdw_kerja_m_name'] : "" ?></td>
                                            <td><?= (isset($jk)) ? $jk['jk_name'] : "Libur" ?></td>
                                            <td><?= $peg['pegawai_pin'] ?></td>
                                            <td><?= $peg['pegawai_nip'] ?></td>
                                            <td><?= $peg['pegawai_nama'] ?></td>
                                            <td><?= (isset($jab)) ? $jab['pembagian1_nama'] : "" ?></td>
                                            <td><?= (isset($jk)) ? $jk['jk_bcin'] : "00:00:00" ?></td>
                                            <td><?= timeScan($cari['scan_in']) ?></td>
                                            <td><?= $cari['late_minute'] ?> menit</td>
                                            <td><?= timeScan($cari['break_in']) ?></td>
                                            <td><?= timeScan($cari['break_out']) ?></td>
                                            <td><?= (isset($jk)) ? $jk['jk_ecout'] : "00:00:00" ?></td>
                                            <td><?= timeScan($cari['scan_out']) ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <?php
                            if (empty($_POST['periode_awal']) && empty($_POST['periode_akhir'])) {
                                while ($peg    = mysqli_fetch_array($tampilPeg2, MYSQLI_ASSOC)) {
                                    $tampilPres2 = mysqli_query($koneksi, "SELECT * FROM shift_result WHERE pegawai_id = '$peg[pegawai_id]' ORDER BY tgl_shift DESC LIMIT 100");
                                    while ($pres2 = mysqli_fetch_array($tampilPres2, MYSQLI_ASSOC)) {

                                        $jdwM    = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id='$pres2[jdw_kerja_m_id]'");
                                        $jdw    = mysqli_fetch_array($jdwM, MYSQLI_ASSOC);

                                        $tampilJk    = mysqli_query($koneksi, "SELECT * FROM jam_kerja WHERE jk_id='$pres2[jk_id]'");
                                        $jk    = mysqli_fetch_array($tampilJk, MYSQLI_ASSOC);

                                        $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
                                        $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
                            ?>
                                        <tr <?= ($pres2['libur_rutin'] == "0") ? "class=''" : "class='danger'" ?>>
                                            <td><?= $pres2['tgl_shift'] ?></td>
                                            <td><?= (isset($jdw)) ? $jdw['jdw_kerja_m_name'] : "" ?></td>
                                            <td><?= (isset($jk)) ? $jk['jk_name'] : "Libur" ?></td>
                                            <td><?= $peg['pegawai_pin'] ?></td>
                                            <td><?= $peg['pegawai_nip'] ?></td>
                                            <td><?= $peg['pegawai_nama'] ?></td>
                                            <td><?= (isset($jab)) ? $jab['pembagian1_nama'] : "" ?></td>
                                            <td><?= (isset($jk)) ? $jk['jk_bcin'] : "00:00:00" ?></td>
                                            <td><?= timeScan($pres2['scan_in']) ?></td>
                                            <td><?= $pres2['late_minute'] ?> menit</td>
                                            <td><?= timeScan($pres2['break_in']) ?></td>
                                            <td><?= timeScan($pres2['break_out']) ?></td>
                                            <td><?= (isset($jk)) ? $jk['jk_ecout'] : "00:00:00" ?></td>
                                            <td><?= timeScan($pres2['scan_out']) ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end tab rekap harian -->
            <!-- tab rekap periode -->
            <div class="tab-pane fade" id="rekapperiode">
                <li style="text-align:right ;"><a href="<?php echo $file2; ?>" class="btn btn-sm btn-success m-b-10" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a></li>
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat rekap presensi ...
                </div>

                <div class="table-responsive">
                    <table id="" class="table table-striped table-bordered nowrap display" width="100%">
                        <thead>
                            <tr>
                                <th>PIN</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Periode</th>
                                <th>Hadir</th>
                                <th>Izin</th>
                                <th>Terlambat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_POST['periode_awal']) && !empty($_POST['periode_akhir'])) {

                                $begin = new DateTime($_POST['periode_awal']);
                                $end = new DateTime($_POST['periode_akhir']);
                                $end->modify("+1 day");
                                $interval = $begin->diff($end);

                                if (($interval->m) > '0') {
                                    while ($peg3    = mysqli_fetch_array($tampilPeg3, MYSQLI_ASSOC)) {
                                        $tampilCari = mysqli_query($koneksi, "SELECT SUM(jk_count_as) AS hadir, SUM(late) AS terlambat FROM shift_result WHERE tgl_shift >= '$_POST[periode_awal]' AND tgl_shift <= '$_POST[periode_akhir]' AND pegawai_id = '$peg3[pegawai_id]'");
                                        $cari = mysqli_fetch_array($tampilCari, MYSQLI_ASSOC);

                                        $jabatan    = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg3[pembagian1_id]'");
                                        $jab    = mysqli_fetch_array($jabatan, MYSQLI_ASSOC);
                            ?>
                                        <tr>
                                            <td><?= $peg3['pegawai_pin'] ?></td>
                                            <td><?= $peg3['pegawai_nip'] ?></td>
                                            <td><?= $peg3['pegawai_nama'] ?></td>
                                            <td><?= (isset($jab)) ? $jab['pembagian1_nama'] : "" ?></td>
                                            <td><?= $begin->format("F") ?> / <?= $begin->format("Y") ?></td>
                                            <td><?= $cari["hadir"] ?></td>
                                            <td></td>
                                            <td><?= $cari["terlambat"] ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end tab periode -->
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