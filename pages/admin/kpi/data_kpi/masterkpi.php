<div class="row">
    <?php
    if (isset($_GET['id_data_kpi'])) {
        $id_data_kpi = $_GET['id_data_kpi'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";
    $query    = mysqli_query($koneksi, "SELECT * FROM tb_kpi WHERE id_data_kpi='$id_data_kpi'");
    $data    = mysqli_fetch_array($query);


    if ($_POST['edit2'] == "edit2") {
        $sasaran_kerja  = $_POST['sasaran_kerja'];
        $satuan_kpi     = $_POST['satuan_kpi'];
        $target_kpi     = $_POST['target_kpi'];
        $bobot          = $_POST['bobot'];
        $score          = $_POST['score'];
        $nilai          = $_POST['nilai'];
        $dokumen        = $_POST['dokumen'];
        $kendala        = $_POST['kendala'];

        if (empty($_POST['sasaran_kerja'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-kpi&id_kategori=$data[id_kategori]");
        } else {
            $update = mysqli_query($koneksi, "UPDATE tb_kpi SET sasaran_kerja='$sasaran_kerja', satuan_kpi='$satuan_kpi', target_kpi='$target_kpi', bobot='$bobot', score='$score', nilai='$nilai', dokumen='$dokumen', kendala='$kendala' WHERE id_data_kpi='$id_data_kpi'");
            if ($update) {
                $_SESSION['pesan'] = "Good! Edit data kpi success ...";
                header("location:index.php?page=form-edit-kpi&id_kategori=$data[id_kategori]");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>