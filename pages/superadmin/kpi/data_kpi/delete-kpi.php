<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_data_kpi'])) {
        $id_data_kpi = $_GET['id_data_kpi'];

        $query   = mysqli_query($koneksi, "SELECT * FROM tb_kpi WHERE id_data_kpi='$id_data_kpi'");
        $data    = mysqli_fetch_array($query);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_data_kpi) && $id_data_kpi != "") {
        $delete        = mysqli_query($koneksi, "DELETE FROM tb_kpi WHERE id_data_kpi='$id_data_kpi'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! Delete Data KPI success ...";
            header("location:index.php?page=form-edit-kpi&id_kategori=$data[id_kategori]");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>