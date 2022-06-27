<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['jdw_kerja_m_id'])) {
        $jdw_kerja_m_id = $_GET['jdw_kerja_m_id'];

        $query   = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id='$jdw_kerja_m_id'");
        $data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $nama    = $data['jdw_kerja_m_name'];

        $cekjdw = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jdw_kerja_pegawai WHERE jdw_kerja_m_id='$jdw_kerja_m_id'"));
    } else {
        die("Error. No ID Selected! ");
    }
    if ($cekjdw > 0) {
        $_SESSION['pesan'] = "Oops! Jadwal kerja sedang dipakai di jadwal pegawai ...";
        header("location:index.php?page=form-view-hari-jam-kerja");
    } else if (!empty($jdw_kerja_m_id) && $jdw_kerja_m_id != "") {
        $delete    = mysqli_query($koneksi, "DELETE FROM jdw_kerja_m WHERE jdw_kerja_m_id='$jdw_kerja_m_id'");
        $deld    = mysqli_query($koneksi, "DELETE FROM jdw_kerja_d WHERE jdw_kerja_m_id='$jdw_kerja_m_id'");


        if ($delete) {
            $_SESSION['pesan'] = "Good! Delete jadwal kerja \"$nama\" success ...";
            header("location:index.php?page=form-view-hari-jam-kerja");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>