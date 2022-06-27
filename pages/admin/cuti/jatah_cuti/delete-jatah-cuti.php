<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_jatah'])) {
        $id_jatah = $_GET['id_jatah'];

        $query   = mysqli_query($koneksi, "SELECT * FROM tb_jatah_cuti WHERE id_jatah='$id_jatah'");
        $data    = mysqli_fetch_array($query);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_jatah) && $id_jatah != "") {
        $delete    = mysqli_query($koneksi, "DELETE FROM tb_jatah_cuti WHERE id_jatah='$id_jatah'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! delete cuti success ...";
            header("location:index.php?page=form-view-cuti");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>