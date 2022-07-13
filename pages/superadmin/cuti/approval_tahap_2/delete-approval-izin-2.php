<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_approval_umum'])) {
        $id_approval_umum = $_GET['id_approval_umum'];

        $query1   = mysqli_query($koneksi, "SELECT * FROM tb_approval_cuti_umum WHERE id_approval_umum='$id_approval_umum'");
        $data1    = mysqli_fetch_array($query1);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_approval_umum) && $id_approval_umum != "") {
        $delete1    = mysqli_query($koneksi, "DELETE FROM tb_approval_cuti_umum WHERE id_approval_umum='$id_approval_umum'");
        if ($delete1) {
            $_SESSION['pesan'] = "Good! delete izin success ...";
            header("location:index.php?page=form-view-approval-tahap2");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>