<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_approval_cuti'])) {
        $id_approval_cuti = $_GET['id_approval_cuti'];

        $query   = mysqli_query($koneksi, "SELECT * FROM tb_approval_cuti_tahunan WHERE id_approval_cuti='$id_approval_cuti'");
        $data    = mysqli_fetch_array($query);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_approval_cuti) && $id_approval_cuti != "") {
        $delete    = mysqli_query($koneksi, "DELETE FROM tb_approval_cuti_tahunan WHERE id_approval_cuti='$id_approval_cuti'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! delete cuti tahunan success ...";
            header("location:index.php?page=form-view-approval-tahap2");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>