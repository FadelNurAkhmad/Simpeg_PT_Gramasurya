<?php
// $filename    = "Daftar Pegawai";

// include "../../config/koneksi.php";
// include "../../assets/plugins/PHPExcel-1.8.1/Classes/PHPExcel.php";
// include "../../assets/plugins/PHPExcel-1.8.1/Classes/PHPExcel/Writer/Excel2007.php";

// $excel    = new PHPExcel;

// $excel->getProperties()->setCreator("Raja Putra Media");
// $excel->getProperties()->setLastModifiedBy("Raja Putra Media");
// $excel->getProperties()->setTitle("Raja Putra Media Report");
// $excel->removeSheetByIndex(0);

// $sheet = $excel->createSheet();
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

// $expPeg    = mysqli_query($koneksi, "SELECT * FROM tb_pegawai ORDER BY id_peg");
// $i    = 4; //Dimulai dengan baris ke dua
// $no    = 1;
// while ($peg    = mysqli_fetch_array($expPeg, MYSQLI_ASSOC)) {
//     $expUni    = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
//     $uni    = mysqli_fetch_array($expUni, MYSQLI_ASSOC);
//     $sheet->setCellValue("A" . $i, $no);
//     $sheet->setCellValue("B" . $i, $peg['id_peg']);
//     $sheet->setCellValue("C" . $i, $peg['nip']);
//     $sheet->setCellValue("D" . $i, $peg['nama']);
//     $sheet->setCellValue("E" . $i, $peg['tempat_lhr']);
//     $sheet->setCellValue("F" . $i, $peg['tgl_lhr']);
//     $sheet->setCellValue("G" . $i, $peg['agama']);
//     $sheet->setCellValue("H" . $i, $peg['jk']);
//     $sheet->setCellValue("I" . $i, $peg['gol_darah']);
//     $sheet->setCellValue("J" . $i, $peg['status_nikah']);
//     $sheet->setCellValue("K" . $i, $peg['status_kepeg']);
//     $sheet->setCellValue("L" . $i, $peg['alamat']);
//     $sheet->setCellValue("M" . $i, $peg['telp']);
//     $sheet->setCellValue("N" . $i, $peg['email']);
//     $sheet->setCellValue("O" . $i, $peg['urut_pangkat']);
//     $sheet->setCellValue("P" . $i, $peg['pangkat']);
//     $sheet->setCellValue("Q" . $i, $peg['jabatan']);
//     $sheet->setCellValue("R" . $i, $peg['sekolah']);
//     $sheet->setCellValue("S" . $i, $uni['nama']);
//     $sheet->setCellValue("T" . $i, $peg['tgl_pensiun']);
//     $no++;
//     $i++;
// }

// $writer    = new PHPExcel_Writer_Excel2007($excel);
// $file    = "../../assets/excel/$filename.xlsx";
// $writer->save("$file");
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
    <li>
        <div class="row ">
            <div class="col-12 col-md-4">
                <h1 class="page-header">Data <small>Attlog&nbsp;</small></h1>
            </div>
            <div class="col-6 col-md-8">
                <label class="col-md-1 control-label">Periode</label>
                <div class="col-md-3">
                    <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="periode_awal" placeholder="Dari" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="periode_akhir" placeholder="Sampai" class="form-control" />
                    </div>
                </div>
                <div class="col-sm-4 m-b-10">
                    <a type="button" class="btn btn-primary btn-sm m-r-5" data-toggle="modal" data-target="#jab"><i class="fa fa-floppy-o"></i> Submit&nbsp;</a>
                    <a href="#" class="btn btn-sm btn-success" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a>
                </div>
            </div>
        </div>
    </li>
    <!-- <li><a href="index.php?page=form-master-data-gaji" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Tambah Data Gaji</a></li> -->
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<!-- end page-header -->

<?php
include "../../config/koneksi.php";
$tampilPeg    = mysqli_query($koneksi, "SELECT * FROM tb_pegawai ORDER BY id_peg DESC");
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
                <h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilPeg); ?></span> rows for "Rekap Absen"</h4>
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
                            <th>Mesin</th>
                            <th>Nama Karyawan</th>
                            <th>Waktu</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        // while ($peg    = mysql_fetch_array($tampilPeg)) {
                        $no++
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td>GA</td>
                            <td>Parjo Raharjo</td>
                            <td>21/09/2022 - 18:09</td>
                            <td class="text-center">
                                <a type="button" class="btn btn-info btn-icon btn-sm" href="#" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
                                <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $dataPre['id_presensi'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
                            </td>
                        </tr>
                        <!-- #modal-dialog -->
                        <div id="Del<?php echo $peg['id_peg'] ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete <u><?php echo $peg['nama'] ?></u> from Database?</h5>
                                    </div>
                                    <div class="modal-body" align="center">
                                        <a href="index.php?page=delete-data-pegawai&id_peg=<?= $peg['id_peg'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        // }
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