<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['pembagian2_id'])) {
        $pembagian2_id = $_GET['pembagian2_id'];

        $query   = mysqli_query($koneksi, "SELECT * FROM pembagian2 WHERE pembagian2_id='$pembagian2_id'");
        $data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($pembagian2_id) && $pembagian2_id != "") {
        $delete    = mysqli_query($koneksi, "DELETE FROM pembagian2 WHERE pembagian2_id='$pembagian2_id'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! delete nama unit success ...";
            header("location:index.php?page=form-master-data-jabatan");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>