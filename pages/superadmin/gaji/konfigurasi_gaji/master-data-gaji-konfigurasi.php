<div class="row">
    <?php
    if (isset($_GET['id_gaji_konfig'])) {
        $id_gaji_konfig = $_GET['id_gaji_konfig'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $pegawai_id         = $_POST['pegawai_id'];
        $bulan              = $_POST['bulan'];
        $tahun              = $_POST['tahun'];
        $tanggal_gaji_konfig = $_POST['tanggal_gaji_konfig'];
        $gaji_diterima      = $_POST['gaji_diterima'];
        $gaji_pokok         = $_POST['gaji_pokok'];
        $tunjangan_tetap    = $_POST['tunjangan_tetap'];
        $struktural         = $_POST['struktural'];
        $pendidikan         = $_POST['pendidikan'];
        $keahlian           = $_POST['keahlian'];
        $penyesuaian        = $_POST['penyesuaian'];
        $tunjangan_variabel = $_POST['tunjangan_variabel'];
        $presensi           = $_POST['presensi'];
        $uang_makan         = $_POST['uang_makan'];
        $kehadiran          = $_POST['kehadiran'];
        $kedisiplinan       = $_POST['kedisiplinan'];
        $istri_suami        = $_POST['istri_suami'];
        $anak               = $_POST['anak'];
        $presensi_pot       = $_POST['presensi_pot'];
        $uang_makan_pot     = $_POST['uang_makan_pot'];
        $kehadiran_pot      = $_POST['kehadiran_pot'];
        $kedisiplinan_pot   = $_POST['kedisiplinan_pot'];
        $jumlah_pot_var     = $_POST['jumlah_pot_var'];
        $bpjs               = $_POST['bpjs'];
        $koperasi           = $_POST['koperasi'];
        $dapen_muh          = $_POST['dapen_muh'];
        $lainya             = $_POST['lainya'];
        $jumlah_pot_wajib   = $_POST['jumlah_pot_wajib'];

        include "../../config/koneksi.php";

        if (empty($_POST['pegawai_id']) || empty($_POST['bulan']) || empty($_POST['tahun']) || empty($_POST['tanggal_gaji_konfig'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-data-gaji-konfigurasi");
        } else {
            $insert = "INSERT INTO tb_gaji_konfigurasi (
                        id_gaji_konfig, 
                        pegawai_id, 
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
                    VALUES ('$id_gaji_konfig','$pegawai_id', 
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