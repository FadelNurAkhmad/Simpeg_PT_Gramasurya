<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_gaji_konfig'])) {
        $id_gaji_konfig = $_GET['id_gaji_konfig'];

        $query   = mysqli_query($koneksi, "SELECT * FROM tb_gaji_konfigurasi WHERE id_gaji_konfig='$id_gaji_konfig'");
        $data    = mysqli_fetch_array($query);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_gaji_konfig) && $id_gaji_konfig != "") {
        $delete    = mysqli_query($koneksi, "DELETE FROM tb_gaji_konfigurasi WHERE id_gaji_konfig='$id_gaji_konfig'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! delete success ...";
            header("location:index.php?page=form-view-data-gaji-konfigurasi");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>