<?php

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

if (isset($_POST['submit'])) {
    $err        = "";
    $ekstensi   = "";
    $success    = "";

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


    $file_name = $_FILES['filexls']['name'];
    $file_data = $_FILES['filexls']['tmp_name'];

    if (empty($file_name)) {
        $_SESSION['pesan'] = "Oops! Please fill all column ...";
        header("location:index.php?page=form-view-data-pegawai");
    } else {
        $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = array("xls", "xlsx");
    if (!in_array($ekstensi, $ekstensi_allowed)) {
        $_SESSION['pesan'] = "Oops! File extensions not available. Only xls and xlsx ...";
        header("location:index.php?page=form-view-data-pegawai");
    } else {
        $reader = PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
        $spreadsheet = $reader->load($file_data);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $jumlahData = 0;
        for ($i = 1; $i < count($sheetData); $i++) {
            $id_peg       = kdauto("pegawai", "");
            $id_pegD       = kdauto("pegawai_d", "");
            $pembagian1_id = kdauto("pembagian1", "");
            $pembagian2_id = kdauto("pembagian2", "");
            $id_jab = kdauto("tb_jabatan", "");

            $pegawai_id = $sheetData[$i]['0'];
            $pegawai_pin = $sheetData[$i]['1'];
            $pegawai_nip = $sheetData[$i]['2'];
            $pegawai_nama = $sheetData[$i]['3'];
            $pegawai_alias = $sheetData[$i]['4'];
            $gender = $sheetData[$i]['5'];
            $gender = str_replace(array("L", "P"), array("1", "2"), $gender);

            $stat_nikah = $sheetData[$i]['6'];
            $stat_nikah = str_replace(array("Menikah", "Belum", ""), array("1", "2", ""), $stat_nikah);

            $pegawai_status = $sheetData[$i]['7'];
            $pegawai_status = str_replace(array("Aktif", "Non"), array("1", "2"), $pegawai_status);

            $tempat_lahir = $sheetData[$i]['8'];

            $tgl_lahir_format = new DateTime($sheetData[$i]['9']);
            $tgl_lahir = $tgl_lahir_format->format("Y-m-d");

            $gol_darah = $sheetData[$i]['10'];
            $gol_darah = str_replace(array("A", "B", "O", "AB"), array("1", "2", "3", "4"), $gol_darah);

            $alamat = $sheetData[$i]['11'];

            $tgl_mulai_kerja_format = new DateTime($sheetData[$i]['12']);
            $tgl_mulai_kerja = $tgl_mulai_kerja_format->format("Y-m-d");

            $unit = $sheetData[$i]['13'];
            $jabatan = $sheetData[$i]['14'];
            $no_telp = $sheetData[$i]['15'];
            $ket = $sheetData[$i]['16'];

            $cekJab = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_nama = '$jabatan'"));
            $cekUnit = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pembagian2 WHERE pembagian2_nama = '$unit'"));
            $cekPeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_pin = '$pegawai_pin'"));


            // cek jabatan ada atau tidak pada tabel pembagian1
            if ($cekJab <= 0 && !empty($jabatan)) {
                $pembagian1 = mysqli_query($koneksi, "INSERT INTO pembagian1 (pembagian1_id, pembagian1_nama) VALUES ('$pembagian1_id', '$jabatan')");
            }

            // cek unit ada atau tidak pada tabel pembagian2
            if ($cekUnit <= 0 && !empty($unit)) {
                $pembagian2 = mysqli_query($koneksi, "INSERT INTO pembagian2 (pembagian2_id, pembagian2_nama) VALUES ('$pembagian2_id', '$unit')");
            }

            // cek data pegawai sudah ada atau tidak pada tabel pegawai
            if ($cekPeg <= 0) {



                $query = mysqli_query($koneksi, "INSERT INTO pegawai (pegawai_id, pegawai_pin, pegawai_nip, pegawai_nama, pegawai_alias, pegawai_telp, pegawai_status, tgl_mulai_kerja, gender) 
                                                    VALUES ('$id_peg', '$pegawai_pin', '$pegawai_nip', '$pegawai_nama', '$pegawai_alias', '$no_telp', '$pegawai_status', '$tgl_mulai_kerja', '$gender')");



                $ambilPegawai = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id DESC");
                $peg = mysqli_fetch_array($ambilPegawai, MYSQLI_ASSOC);

                $insert = mysqli_query($koneksi, "INSERT INTO tb_pegawai (pegawai_id, ket) VALUES ('$peg[pegawai_id]', '$ket')");

                $query2 = mysqli_query($koneksi, "INSERT INTO pegawai_d (pegawai_id, gol_darah, stat_nikah, alamat)
                                VALUES ('$peg[pegawai_id]', '$gol_darah', '$stat_nikah', '$alamat')");

                $query3 = mysqli_query($koneksi, "INSERT INTO tb_jabatan (id_jab, id_peg, unit, jabatan) VALUES ('$id_jab', '$peg[pegawai_id]', '$unit', '$jabatan')");
            }
        }

        if ($query && $query2 && $query3) {
            $_SESSION['pesan'] = "Good! Import data sukses ... ";
            header("location:index.php?page=form-view-data-pegawai");
        } else {
            $_SESSION['pesan'] = "Oops! Terdapat duplikat data, mohon cek kembali data yang diimport ... ";
            header("location:index.php?page=form-view-data-pegawai");
        }
    }
}
