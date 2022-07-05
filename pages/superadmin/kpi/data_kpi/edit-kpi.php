<div class="row">
    <?php
    if (isset($_GET['id_kategori'])) {
        $id_kategori = $_GET['id_kategori'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";
    $query    = mysqli_query($koneksi, "SELECT * FROM tb_kpi WHERE id_kategori='$id_kategori'");
    $hasil    = mysqli_fetch_array($query);

    if ($_POST['edit'] == "edit") {
        $divisi    = $_POST['divisi'];
        $tanggal_kpi    = $_POST['tanggal_kpi'];
        $bulan    = $_POST['bulan'];
        $tahun    = $_POST['tahun'];

        if (empty($_POST['divisi'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-kpi&id_kategori=$id_kategori");
        } else {
            $update = mysqli_query($koneksi, "UPDATE tb_kpi SET divisi='$divisi', tanggal_kpi='$tanggal_kpi', bulan='$bulan', tahun='$tahun' WHERE id_kategori='$id_kategori'");
            if ($update) {
                $_SESSION['pesan'] = "Good! Edit Unit Kerja success ...";
                header("location:index.php?page=form-view-kpi");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>