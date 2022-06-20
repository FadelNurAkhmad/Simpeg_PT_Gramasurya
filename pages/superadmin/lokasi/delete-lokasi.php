<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_lokasi'])) {
        $id_lokasi = $_GET['id_lokasi'];

        $query   = mysqli_query($koneksi, "SELECT * FROM tb_lokasi WHERE id_lokasi='$id_lokasi'");
        $data    = mysqli_fetch_array($query);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_lokasi) && $id_lokasi != "") {
        $delete    = mysqli_query($koneksi, "DELETE FROM tb_lokasi WHERE id_lokasi='$id_lokasi'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! delete lokasi success ...";
            header("location:index.php?page=form-view-lokasi");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>