<div class="row">
    <?php
    if (isset($_GET['pegawai_id'])) {
        $pegawai_id = $_GET['pegawai_id'];
    }

    if ($_POST['save'] == "save") {

        $jdw_kerja_m_id            = $_POST['jdw_kerja_m_id'];


        include "../../config/koneksi.php";

        $cekJdwPeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jdw_kerja_pegawai WHERE pegawai_id = $pegawai_id"));

        $tampilJdw = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id = $jdw_kerja_m_id");
        $jdw = mysqli_fetch_array($tampilJdw, MYSQLI_ASSOC);
        $jdw_kerja_m_mulai = $jdw['jdw_kerja_m_mulai'];

        if (empty($_POST['jdw_kerja_m_id'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-data-jadwal-kerja-pegawai&pegawai_id=$pegawai_id");
        } else if ($cekJdwPeg <= 0) {
            $insert = "INSERT INTO jdw_kerja_pegawai (pegawai_id, jdw_kerja_m_id, jdw_kerja_m_mulai) VALUES ('$pegawai_id', '$jdw_kerja_m_id', '$jdw_kerja_m_mulai')";
            $query = mysqli_query($koneksi, $insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data jadwal kerja pegawai success ...";
                header("location:index.php?page=form-view-data-jadwal-kerja-pegawai");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        } else {
            $update = "UPDATE jdw_kerja_pegawai SET jdw_kerja_m_id='$jdw_kerja_m_id', jdw_kerja_m_mulai='$jdw_kerja_m_mulai' WHERE pegawai_id='$pegawai_id'";
            $query = mysqli_query($koneksi, $update);

            if ($query) {
                $_SESSION['pesan'] = "Good! Update jadwal kerja pegawai success ...";
                header("location:index.php?page=form-view-data-jadwal-kerja-pegawai");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>