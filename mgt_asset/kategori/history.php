<?php
include '../koneksi.php';

$cari = "";
if(isset($_POST['cari'])){
    $cari = $_POST['search'];

    $sql = "SELECT de1.nomor_aset, 
                   de1.employe_name AS employe_name_before, 
                   de2.employe_name AS employe_name_now, 
                   de1.status_pengalihan
            FROM detail_employe de1
            INNER JOIN detail_employe de2 ON de1.nomor_aset = de2.nomor_aset
            WHERE de1.status_pengalihan = (
                SELECT MAX(status_pengalihan) - 1
                FROM detail_employe
                WHERE nomor_aset = de1.nomor_aset
            )
            AND de2.status_pengalihan = (
                SELECT MAX(status_pengalihan)
                FROM detail_employe
                WHERE nomor_aset = de2.nomor_aset
            )
            GROUP BY de1.nomor_aset";
    $level = mysqli_query($conn, $sql);
} else {
    // Query when no search term is provided
    $sql = "SELECT de1.nomor_aset, 
                   de1.employe_name AS employe_name_before, 
                   de2.employe_name AS employe_name_now, 
                   de1.status_pengalihan
            FROM detail_employe de1
            INNER JOIN detail_employe de2 ON de1.nomor_aset = de2.nomor_aset
            WHERE de1.status_pengalihan = (
                SELECT MAX(status_pengalihan) - 1
                FROM detail_employe
                WHERE nomor_aset = de1.nomor_aset
            )
            AND de2.status_pengalihan = (
                SELECT MAX(status_pengalihan)
                FROM detail_employe
                WHERE nomor_aset = de2.nomor_aset
            )
            GROUP BY de1.nomor_aset";
    $level = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>EMPLOYE</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <?php include("sidebar.php") ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <form class="form-inline">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </form>
                <ul class="navbar-nav ml-auto"></ul>
            </nav>

            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">DETAIL EMPLOYE</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><a href="tambah_employe.php">+ Tambah Employe</a></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="">KATEGORI</th>
                                        <th>EMPLOYE NAME BEFORE</th>
                                        <th>EMPLOYE NAME NOW</th>
                                        <th>DETAIL</th>
                                        <th class="" style="width:10%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($level as $row) : ?>
                                        <tr>
                                            <td><?= $row["nomor_aset"]; ?></td>
                                            <td><?= $row["employe_name_before"]; ?></td>
                                            <td><?= $row["employe_name_now"]; ?></td>
                                            <td>
                                                <a href="detail_pengalihan.php?id=<?=$row['nomor_aset'];?>">
                                                    <button class="btn btn-primary"><i class="fa fa-edit"></i> Detail</button>
                                                </a>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <a href="../hapus dan edit/edit_employe.php?id=<?=$row['nomor_aset'];?>" style="margin-right:2%">
                                                    <button class='btn btn-warning d-flex justify-content-center'>
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </a>
                                                <a href="../hapus dan edit/hapus_employe.php?id=<?=$row['nomor_aset'];?>" onclick="return confirm('yakin untuk menghapus?');">
                                                    <button class='btn btn-danger d-flex justify-content-center'>
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; DIRGANTARA INDONESIA 2024</span>
                </div>
            </div>
        </footer>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../js/demo/datatables-demo.js"></script>
</body>
</html>
