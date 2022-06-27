<div class="row">
    <?php
    if ($_POST['save'] == "save") {
        $pegawai_id          = $_POST['pegawai_id'];
        $jdw_kerja_m_id            = $_POST['jdw_kerja_m_id'];


        include "../../config/koneksi.php";

        $tampilJdw = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id = $jdw_kerja_m_id");
        $jdw = mysqli_fetch_array($tampilJdw, MYSQLI_ASSOC);
        $jdw_kerja_m_mulai = $jdw['jdw_kerja_m_mulai'];

        if (empty($_POST['pegawai_id']) || empty($_POST['jdw_kerja_m_id'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-data-presensi");
        } else {
            $insert = "INSERT INTO jdw_kerja_pegawai (pegawai_id, jdw_kerja_m_id, jdw_kerja_m_mulai) VALUES ('$pegawai_id', '$jdw_kerja_m_id', '$jdw_kerja_m_mulai')";
            $query = mysqli_query($koneksi, $insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data jadwal kerja pegawai success ...";
                header("location:index.php?page=form-view-data-presensi");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>