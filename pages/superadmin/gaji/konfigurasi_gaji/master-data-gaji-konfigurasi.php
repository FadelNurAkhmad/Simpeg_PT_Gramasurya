<div class="row">
    <?php
    if (isset($_GET['id_gaji_konfig'])) {
        $id_gaji_konfig = $_GET['id_gaji_konfig'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $id_peg         = $_POST['id_peg'];
        $bulan              = $_POST['bulan'];
        $tahun              = $_POST['tahun'];
        $tanggal_gaji_konfig = $_POST['tanggal_gaji_konfig'];
        $gaji_diterima      = str_replace(",", "", $_POST['gaji_diterima']);
        $gaji_pokok         = str_replace(",", "", $_POST['gaji_pokok']);
        $tunjangan_tetap    = str_replace(",", "", $_POST['tunjangan_tetap']);
        $struktural         = str_replace(",", "", $_POST['struktural']);
        $pendidikan         = str_replace(",", "", $_POST['pendidikan']);
        $keahlian           = str_replace(",", "", $_POST['keahlian']);
        $penyesuaian        = str_replace(",", "", $_POST['penyesuaian']);
        $tunjangan_variabel = str_replace(",", "", $_POST['tunjangan_variabel']);
        $presensi           = str_replace(",", "", $_POST['presensi']);
        $uang_makan         = str_replace(",", "", $_POST['uang_makan']);
        $kehadiran          = str_replace(",", "", $_POST['kehadiran']);
        $kedisiplinan       = str_replace(",", "", $_POST['kedisiplinan']);
        $istri_suami        = str_replace(",", "", $_POST['istri_suami']);
        $anak               = str_replace(",", "", $_POST['anak']);
        $presensi_pot       = str_replace(",", "", $_POST['presensi_pot']);
        $uang_makan_pot     = str_replace(",", "", $_POST['uang_makan_pot']);
        $kehadiran_pot      = str_replace(",", "", $_POST['kehadiran_pot']);
        $kedisiplinan_pot   = str_replace(",", "", $_POST['kedisiplinan_pot']);
        $jumlah_pot_var     = str_replace(",", "", $_POST['jumlah_pot_var']);
        $bpjs               = str_replace(",", "", $_POST['bpjs']);
        $koperasi           = str_replace(",", "", $_POST['koperasi']);
        $dapen_muh          = str_replace(",", "", $_POST['dapen_muh']);
        $lainya             = str_replace(",", "", $_POST['lainya']);
        $jumlah_pot_wajib   = str_replace(",", "", $_POST['jumlah_pot_wajib']);

        include "../../config/koneksi.php";

        if (empty($_POST['id_peg']) || empty($_POST['bulan']) || empty($_POST['tahun']) || empty($_POST['tanggal_gaji_konfig'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-data-gaji-konfigurasi");
        } else if ($_POST['gaji_diterima'] == 0) {
            $_SESSION['pesan'] = "Oops! Jumlah Gaji Diterima belum dihitung ...";
            header("location:index.php?page=form-master-data-gaji-konfigurasi");
        } else {
            $insert = "INSERT INTO tb_gaji_konfigurasi (
                        id_gaji_konfig, 
                        id_peg, 
                        bulan, 
                        tahun,
                        tanggal_gaji_konfig,
                        gaji_diterima,
                        gaji_pokok,
                        tunjangan_tetap,
                        struktural,
                        pendidikan,
                        keahlian,
                        penyesuaian,
                        tunjangan_variabel,
                        presensi,
                        uang_makan,
                        kehadiran,
                        kedisiplinan,
                        istri_suami,
                        anak,
                        presensi_pot,
                        uang_makan_pot,
                        kehadiran_pot,
                        kedisiplinan_pot,
                        jumlah_pot_var,
                        bpjs,
                        koperasi,
                        dapen_muh,
                        lainya,
                        jumlah_pot_wajib)
                    VALUES ('$id_gaji_konfig','$id_peg', 
                            '$bulan', '$tahun', '$tanggal_gaji_konfig',
                            '$gaji_diterima', '$gaji_pokok',
                            '$tunjangan_tetap', '$struktural',
                            '$pendidikan', '$keahlian', 
                            '$penyesuaian', '$tunjangan_variabel',
                            '$presensi', '$uang_makan', '$kehadiran',
                            '$kedisiplinan', '$istri_suami', '$anak',
                            '$presensi_pot', '$uang_makan_pot',
                            '$kehadiran_pot', '$kedisiplinan_pot',
                            '$jumlah_pot_var', '$bpjs', '$koperasi',
                            '$dapen_muh', '$lainya', '$jumlah_pot_wajib')";
            $query = mysqli_query($koneksi, $insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data gaji konfigurasi success ...";
                header("location:index.php?page=form-view-data-gaji-konfigurasi");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>