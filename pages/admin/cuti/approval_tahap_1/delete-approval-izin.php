<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_cuti_umum'])) {
        $id_cuti_umum = $_GET['id_cuti_umum'];

        $query1   = mysqli_query($koneksi, "SELECT * FROM tb_cuti_umum WHERE id_cuti_umum='$id_cuti_umum'");
        $data1    = mysqli_fetch_array($query1);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_cuti_umum) && $id_cuti_umum != "") {
        $delete1    = mysqli_query($koneksi, "DELETE FROM tb_cuti_umum WHERE id_cuti_umum='$id_cuti_umum'");
        if ($delete1) {
            $_SESSION['pesan'] = "Good! delete izin success ...";
            header("location:index.php?page=form-view-approval-tahap1");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>