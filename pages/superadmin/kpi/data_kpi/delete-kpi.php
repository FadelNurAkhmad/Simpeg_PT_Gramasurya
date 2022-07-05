<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_kategori'])) {
        $id_kategori = $_GET['id_kategori'];

        $query   = mysqli_query($koneksi, "SELECT * FROM tb_kpi WHERE id_kategori='$id_kategori'");
        $data    = mysqli_fetch_array($query);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_kategori) && $id_kategori != "") {
        $delete        = mysqli_query($koneksi, "DELETE FROM tb_kpi WHERE id_kategori='$id_kategori'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! Delete Data KPI success ...";
            header("location:index.php?page=form-view-kpi");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>