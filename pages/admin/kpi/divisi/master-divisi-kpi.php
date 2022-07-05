<div class="row">
    <?php
    if (isset($_GET['id_divisi_kpi'])) {
        $id_divisi_kpi = $_GET['id_divisi_kpi'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $divisi    = $_POST['divisi'];

        include "../../config/koneksi.php";
        $ceknm    = mysqli_num_rows(mysqli_query($koneksi, "SELECT divisi FROM tb_divisi_kpi WHERE divisi='$_POST[divisi]'"));

        if (empty($_POST['divisi'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-divisi-kpi");
        } else if ($ceknm > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat data ...";
            header("location:index.php?page=form-master-divisi-kpi");
        } else {
            $insert = "INSERT INTO tb_divisi_kpi (id_divisi_kpi, divisi) VALUES ('$id_divisi_kpi', '$divisi')";
            $query = mysqli_query($koneksi, $insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert divisi success ...";
                header("location:index.php?page=form-view-divisi-kpi");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>