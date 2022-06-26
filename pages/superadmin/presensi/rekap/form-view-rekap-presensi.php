<?php
$filename    = "Daftar Pegawai";

include "../../config/koneksi.php";
// require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $spreadsheet = new Spreadsheet();

// $sheet = $spreadsheet->getActiveSheet();
// $sheet->setTitle('Daftar Pegawai');
// $sheet->setCellValue("A1", "DAFTAR PEGAWAI");
// $sheet->setCellValue("A3", "No. Urut");
// $sheet->setCellValue("B3", "ID");
// $sheet->setCellValue("C3", "NIP");
// $sheet->setCellValue("D3", "Nama");
// $sheet->setCellValue("E3", "Tempat Lahir");
// $sheet->setCellValue("F3", "Tgl. Lahir");
// $sheet->setCellValue("G3", "Agama");
// $sheet->setCellValue("H3", "Jenis Kelamin");
// $sheet->setCellValue("I3", "Gol Darah");
// $sheet->setCellValue("J3", "Status Nikah");
// $sheet->setCellValue("K3", "Status");
// $sheet->setCellValue("L3", "Alamat");
// $sheet->setCellValue("M3", "Telp");
// $sheet->setCellValue("N3", "Email");
// $sheet->setCellValue("O3", "Gol/Ruang");
// $sheet->setCellValue("P3", "Pangkat");
// $sheet->setCellValue("Q3", "Jabatan");
// $sheet->setCellValue("R3", "Pendidikan");
// $sheet->setCellValue("S3", "Unit Kerja");
// $sheet->setCellValue("T3", "Tgl. Pensiun");

// $expPeg	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai ORDER BY id_peg");
// $i	= 4; //Dimulai dengan baris ke dua
// $no	= 1;
// while ($peg	= mysqli_fetch_array($expPeg)) {
// 	$expUni	= mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
// 	$uni	= mysqli_fetch_array($expUni);
// 	$sheet->setCellValue("A" . $i, $no);
// 	$sheet->setCellValue("B" . $i, $peg['id_peg']);
// 	$sheet->setCellValue("C" . $i, $peg['nip']);
// 	$sheet->setCellValue("D" . $i, $peg['nama']);
// 	$sheet->setCellValue("E" . $i, $peg['tempat_lhr']);
// 	$sheet->setCellValue("F" . $i, $peg['tgl_lhr']);
// 	$sheet->setCellValue("G" . $i, $peg['agama']);
// 	$sheet->setCellValue("H" . $i, $peg['jk']);
// 	$sheet->setCellValue("I" . $i, $peg['gol_darah']);
// 	$sheet->setCellValue("J" . $i, $peg['status_nikah']);
// 	$sheet->setCellValue("K" . $i, $peg['status_kepeg']);
// 	$sheet->setCellValue("L" . $i, $peg['alamat']);
// 	$sheet->setCellValue("M" . $i, $peg['telp']);
// 	$sheet->setCellValue("N" . $i, $peg['email']);
// 	$sheet->setCellValue("O" . $i, $peg['urut_pangkat']);
// 	$sheet->setCellValue("P" . $i, $peg['pangkat']);
// 	$sheet->setCellValue("Q" . $i, $peg['jabatan']);
// 	$sheet->setCellValue("R" . $i, $peg['sekolah']);
// 	$sheet->setCellValue("S" . $i, $uni['nama']);
// 	$sheet->setCellValue("T" . $i, $peg['tgl_pensiun']);
// 	$no++;
// 	$i++;
// }

// $writer = new Xlsx($spreadsheet);
// $file	= "../../assets/excel/$filename.xlsx";
// $writer->save("$file");
?>
<?php
include "../../config/koneksi.php";
$tampilPres    = mysqli_query($koneksi, "SELECT * FROM att_log ORDER BY scan_date DESC LIMIT 1000");

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
        <h1 class="page-header">Rekap <small>Presensi&nbsp;</small></h1>
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
                <a href="#" class="btn btn-sm btn-success" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a>
            </div>
        </form>
    </div>
</div>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#scanlog" data-toggle="tab"><span class="visible-xs">Data Scanlog</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Data Scanlog</span></a></li>
            <li class=""><a href="#rekapharian" data-toggle="tab"><span class="visible-xs">Rekap Harian</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Rekap Harian</span></a></li>
            <li class=""><a href="#rekapperiode" data-toggle="tab"><span class="visible-xs">Rekap Periode</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Rekap Periode</span></a></li>
        </ul>
        <div class="tab-content">

            <!-- tab presensi -->
            <div class="tab-pane fade active in" id="scanlog">
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat rekap presensi ...
                </div>

                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
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
                            if (!empty($_POST['periode_awal']) && !empty($_POST['periode_awal'])) {
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
                                        <td><?= $cari['pin'] ?></td>
                                        <?php
                                        $tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$cari[pin]'");
                                        $peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
                                        ?>
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
                            if (empty($_POST['periode_awal']) && empty($_POST['periode_awal'])) {
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
                                        <td><?= $pres['pin'] ?></td>
                                        <?php
                                        $tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin='$pres[pin]'");
                                        $peg = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
                                        ?>
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


        </div>
    </div>
</div>
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