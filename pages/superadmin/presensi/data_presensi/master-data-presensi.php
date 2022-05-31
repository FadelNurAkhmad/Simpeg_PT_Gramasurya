<div class="row">
    <?php
    if (isset($_GET['id_presensi'])) {
        $id_presensi = $_GET['id_presensi'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $id_peg          = $_POST['id_peg'];
        $nama            = $_POST['nama'];
        $tanggal         = $_POST['tanggal'];
        $bulan           = $_POST['bulan'];
        $tahun           = $_POST['tahun'];
        $hadir           = $_POST['hadir'];
        $sakit           = $_POST['sakit'];
        $ijin            = $_POST['ijin'];
        $tanpa_keterangan   = $_POST['tanpa_keterangan'];

        include "../../config/koneksi.php";

        if (empty($_POST['id_peg']) || empty($_POST['tanggal']) || empty($_POST['bulan']) || empty($_POST['tahun'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-data-presensi");
        } else {
            $insert = "INSERT INTO tb_presensi (id_presensi, id_peg, tanggal, bulan, tahun, hadir, sakit, ijin, tanpa_keterangan) VALUES ('$id_presensi', '$id_peg', '$tanggal', '$bulan', '$tahun', '$hadir', '$sakit', '$ijin', '$tanpa_keterangan')";
            $query = mysqli_query($koneksi, $insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data presensi success ...";
                header("location:index.php?page=form-view-data-presensi");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>