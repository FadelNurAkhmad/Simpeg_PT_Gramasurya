<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_cuti'])) {
        $id_cuti = $_GET['id_cuti'];

        $query   = mysqli_query($koneksi, "SELECT * FROM tb_cuti_tahunan WHERE id_cuti='$id_cuti'");
        $data    = mysqli_fetch_array($query);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_cuti) && $id_cuti != "") {
        $delete    = mysqli_query($koneksi, "DELETE FROM tb_cuti_tahunan WHERE id_cuti='$id_cuti'");
        $delete1   = mysqli_query($koneksi, "DELETE FROM tb_approval_cuti_tahunan WHERE id_approval_cuti='$id_cuti'");

        if ($delete && $delete1) {
            $_SESSION['pesan'] = "Good! delete cuti success ...";
            header("location:index.php?page=form-view-cuti");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>