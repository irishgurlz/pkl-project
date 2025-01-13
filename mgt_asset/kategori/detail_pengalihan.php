<?php
include '../koneksi.php';

$cari = "";
if(isset($_POST['cari'])){
    $cari = $_POST['search'];

    $sql = "SELECT de1.nomor_aset, 
               de1.employe_name AS employe_name_before, 
               de2.employe_name AS employe_name_now, 
               de1.status_pengalihan,
               de1.*, k.kategori,
               t1.nama_type AS processor, 
               t2.nama_type AS storage_type, 
               t3.nama_type AS memory_type, 
               t4.nama_type AS vga_type, 
               t5.nama_type AS operation_system, 
               t6.nama_type AS office, 
               t7.nama_type AS os_licence,
               t8.nama_type AS id_type_kategori,
               t9.nama_type AS os
        FROM detail_employe de1
        INNER JOIN detail_employe de2 ON de1.nomor_aset = de2.nomor_aset
        INNER JOIN kategori k ON de1.id_kategori = k.id_kategori
        LEFT JOIN type_kategori t1 ON de1.processor = t1.id_type_kategori
        LEFT JOIN type_kategori t2 ON de1.storage_type = t2.id_type_kategori
        LEFT JOIN type_kategori t3 ON de1.memory_type = t3.id_type_kategori
        LEFT JOIN type_kategori t4 ON de1.vga_type = t4.id_type_kategori
        LEFT JOIN type_kategori t5 ON de1.operation_system = t5.id_type_kategori
        LEFT JOIN type_kategori t6 ON de1.office = t6.id_type_kategori
        LEFT JOIN type_kategori t7 ON de1.os_licence = t7.id_type_kategori
        LEFT JOIN type_kategori t8 ON de1.id_type_kategori = t8.id_type_kategori
        LEFT JOIN type_kategori t9 ON de1.os = t9.id_type_kategori
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
        AND de1.id_detail_employe LIKE '%$cari%'
        GROUP BY de1.nomor_aset";
    $lev = mysqli_query($conn, $sql);
} else {
    // Query tanpa kata kunci pencarian
    $sql = "SELECT de1.nomor_aset, 
               de1.employe_name AS employe_name_before, 
               de2.employe_name AS employe_name_now, 
               de1.status_pengalihan,
               de1.*, k.kategori,
               t1.nama_type AS processor, 
               t2.nama_type AS storage_type, 
               t3.nama_type AS memory_type, 
               t4.nama_type AS vga_type, 
               t5.nama_type AS operation_system, 
               t6.nama_type AS office, 
               t7.nama_type AS os_licence,
               t8.nama_type AS id_type_kategori,
               t9.nama_type AS os
        FROM detail_employe de1
        INNER JOIN detail_employe de2 ON de1.nomor_aset = de2.nomor_aset
        INNER JOIN kategori k ON de1.id_kategori = k.id_kategori
        LEFT JOIN type_kategori t1 ON de1.processor = t1.id_type_kategori
        LEFT JOIN type_kategori t2 ON de1.storage_type = t2.id_type_kategori
        LEFT JOIN type_kategori t3 ON de1.memory_type = t3.id_type_kategori
        LEFT JOIN type_kategori t4 ON de1.vga_type = t4.id_type_kategori
        LEFT JOIN type_kategori t5 ON de1.operation_system = t5.id_type_kategori
        LEFT JOIN type_kategori t6 ON de1.office = t6.id_type_kategori
        LEFT JOIN type_kategori t7 ON de1.os_licence = t7.id_type_kategori
        LEFT JOIN type_kategori t8 ON de1.id_type_kategori = t8.id_type_kategori
        LEFT JOIN type_kategori t9 ON de1.os = t9.id_type_kategori
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
    $lev = mysqli_query($conn, $sql);
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
                                    <th>NOMOR IT</th>
                                    <!-- <th>EMPLOYE NIK</th> -->
                                    <th>EMPLOYE NAME BEFORE</th>
                                    <th>EMPLOYE NAME NOW</th>
                                    <th>EMPLOYE ORG</th>
                                    <th>LOKASI</th>
                                    <th>KATEGORI</th>
                                    <th>TIPE</th>
                                    <th>PROCESSOR</th>
                                    <th>STORAGE CAPACITY</th>
                                    <th>MEMORY CAPACITY</th>
                                    <th>VGA CAPACITY</th>
                                    <th>NOMOR ASET</th>
                                    <th>SERIAL NUMBER</th>
                                    <th>STORAGE TYPE</th>
                                    <th>MEMORY TYPE</th>
                                    <th>VGA TYPE</th>
                                    <th>OPERATION SYSTEM</th>
                                    <th>OFFICE</th>
                                    <th>OS LICENSE</th>
                                    <th>OS</th>
                                    <th>APLIKASI LAINNYA</th>
                                    <th>KETERANGAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php foreach ($lev as $rows) : ?>
                                            <td><?= $rows["nomor_aset"]; ?></td>
                                            <td><?= $rows["employe_name_before"]; ?></td>
                                            <td><?= $rows["employe_name_now"]; ?></td>
                                            <td><?= $rows["c_org"]; ?></td>
                                            <td><?= $rows["lokasi"]; ?></td>
                                            <td><?= $rows["kategori"]; ?></td>
                                            <td><?= $rows["id_type_kategori"]; ?></td>
                                            <td><?= $rows["processor"]; ?></td>
                                            <td><?= $rows["storage_capacity"]; ?></td>
                                            <td><?= $rows["memory_capacity"]; ?></td>
                                            <td><?= $rows["vga_capacity"]; ?></td>
                                            <td><?= $rows["nomor_aset"]; ?></td>
                                            <td><?= $rows["serial_number"]; ?></td>
                                            <td><?= $rows["storage_type"]; ?></td>
                                            <td><?= $rows["memory_type"]; ?></td>
                                            <td><?= $rows["vga_type"]; ?></td>
                                            <td><?= $rows["operation_system"]; ?></td>
                                            <td><?= $rows["office"]; ?></td>
                                            <td><?= $rows["os_licence"]; ?></td>
                                            <td><?= $rows["os"]; ?></td>
                                            <td><?= $rows["aplikasi_lainnya"]; ?></td>
                                            <td><?= $rows["keterangan"]; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
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
