<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['pegawai_id'])) {
        $pegawai_id = $_GET['pegawai_id'];

        $query   = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_pegawai WHERE pegawai_id='$pegawai_id'");
        $data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($pegawai_id) && $pegawai_id != "") {
        $delete    = mysqli_query($koneksi, "DELETE FROM jdw_kerja_pegawai WHERE pegawai_id='$pegawai_id'");

        if ($delete) {
            $_SESSION['pesan'] = "Good! Delete jadwal kerja pegawai success ...";
            header("location:index.php?page=form-view-data-jadwal-kerja-pegawai");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>