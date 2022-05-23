<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_jabatan'])) {
        $id_jabatan = $_GET['id_jabatan'];

        $query   = mysql_query("SELECT * FROM tb_gaji_jabatan WHERE id_jabatan='$id_jabatan'");
        $data    = mysql_fetch_array($query);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_jabatan) && $id_jabatan != "") {
        $delete    = mysql_query("DELETE FROM tb_gaji_jabatan WHERE id_jabatan='$id_jabatan'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! delete success ...";
            header("location:index.php?page=form-view-data-gaji-jabatan");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysql_close($Open);
    ?>
</div>