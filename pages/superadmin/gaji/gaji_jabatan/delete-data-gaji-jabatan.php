<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_jabatan'])) {
        $id_jabatan = $_GET['id_jabatan'];

        $query   = mysqli_query($koneksi, "SELECT * FROM tb_gaji_jabatan WHERE id_jabatan='$id_jabatan'");
        $data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_jabatan) && $id_jabatan != "") {
        $delete    = mysqli_query($koneksi, "DELETE FROM tb_gaji_jabatan WHERE id_jabatan='$id_jabatan'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! delete success ...";
            header("location:index.php?page=form-view-data-gaji-jabatan");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>