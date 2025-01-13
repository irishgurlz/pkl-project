<?php
include '../koneksi.php';

$cari = "";
if(isset($_POST['cari'])){
    $cari = $_POST['search'];

    // Updated query based on your requirements
    $sql = "SELECT d.* , k.kategori,
            t1.nama_type AS processor, 
            t2.nama_type AS storage_type, 
            t3.nama_type AS memory_type, 
            t4.nama_type AS vga_type, 
            t5.nama_type AS operation_system, 
            t6.nama_type AS office, 
            t7.nama_type AS os_licence,
            t8.nama_type AS id_type_kategori,
            t9.nama_type AS os
            FROM detail_employe d
            INNER JOIN kategori k ON d.id_kategori = k.id_kategori 
            LEFT JOIN type_kategori t1 ON d.processor = t1.id_type_kategori
            LEFT JOIN type_kategori t2 ON d.storage_type = t2.id_type_kategori
            LEFT JOIN type_kategori t3 ON d.memory_type = t3.id_type_kategori
            LEFT JOIN type_kategori t4 ON d.vga_type = t4.id_type_kategori
            LEFT JOIN type_kategori t5 ON d.operation_system = t5.id_type_kategori
            LEFT JOIN type_kategori t6 ON d.office = t6.id_type_kategori
            LEFT JOIN type_kategori t7 ON d.os_licence = t7.id_type_kategori
            LEFT JOIN type_kategori t8 ON d.id_type_kategori = t8.id_type_kategori
            LEFT JOIN type_kategori t9 ON d.os = t9.id_type_kategori
            INNER JOIN type_kategori ON d.id_type_kategori = type_kategori.id_type_kategori
            WHERE d.status_pengalihan = (
                SELECT MAX(status_pengalihan)
                FROM detail_employe
                WHERE nomor_aset = d.nomor_aset
            )
            GROUP BY d.nomor_aset";
    $level = mysqli_query($conn, $sql);
}else{
    // Updated query for default case (when no search query is provided)
    $sql = "SELECT d.* , k.kategori,
            t1.nama_type AS processor, 
            t2.nama_type AS storage_type, 
            t3.nama_type AS memory_type, 
            t4.nama_type AS vga_type, 
            t5.nama_type AS operation_system, 
            t6.nama_type AS office, 
            t7.nama_type AS os_licence,
            t8.nama_type AS id_type_kategori,
            t9.nama_type AS os
            FROM detail_employe d
            INNER JOIN kategori k ON d.id_kategori = k.id_kategori 
            LEFT JOIN type_kategori t1 ON d.processor = t1.id_type_kategori
            LEFT JOIN type_kategori t2 ON d.storage_type = t2.id_type_kategori
            LEFT JOIN type_kategori t3 ON d.memory_type = t3.id_type_kategori
            LEFT JOIN type_kategori t4 ON d.vga_type = t4.id_type_kategori
            LEFT JOIN type_kategori t5 ON d.operation_system = t5.id_type_kategori
            LEFT JOIN type_kategori t6 ON d.office = t6.id_type_kategori
            LEFT JOIN type_kategori t7 ON d.os_licence = t7.id_type_kategori
            LEFT JOIN type_kategori t8 ON d.id_type_kategori = t8.id_type_kategori
            LEFT JOIN type_kategori t9 ON d.os = t9.id_type_kategori
            INNER JOIN type_kategori ON d.id_type_kategori = type_kategori.id_type_kategori
            WHERE d.status_pengalihan = (
                SELECT MAX(status_pengalihan)
                FROM detail_employe
                WHERE nomor_aset = d.nomor_aset
            )
            GROUP BY d.nomor_aset";
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

    <title>DETAIL EMPLOYE</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <?php include("sidebar.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                       

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">DATA DETAIL EMPLOYE</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><a href="tambah_pendataan_perangkat.php">+ Tambah Detail Employe</a></h6><br>
                            <h6 class="m-0 font-weight-bold text-primary"><a href="export_to_axcel.php">>Export to Excel<</a></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NOMOR IT</th>
                                            <th>EMPLOYE NAME</th>
                                            <th>EMPLOYE NIK</th>
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
                                            <th>OS LICENSE</th>
                                            <th>APLIKASI LAINNYA</th>
                                            <th>KETERANGAN TAMBAHAN</th>
                                            <th>STATUS</th>
                                    
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                    
                                    <tbody>
                                    <?php foreach ($level as $row) : ?> 
                                    <tr>
                                        <td><?= $row["nomor_it"]; ?></td>
                                        <td><?= $row["employe_name"]; ?></td>
                                        <td><?= $row["employe_nik"]; ?></td>
                                        <td><?= $row["c_org"]; ?></td>
                                        <td><?= $row["lokasi"]; ?></td>
                                        <td><?= $row["kategori"]; ?></td>
                                        <td><?= $row["id_type_kategori"]; ?></td>
                                        <td><?= $row["processor"]; ?></td>
                                        <td><?= $row["storage_capacity"]; ?></td>
                                        <td><?= $row["memory_capacity"]; ?></td>
                                        <td><?= $row["vga_capacity"]; ?></td>
                                        <td><?= $row["nomor_aset"]; ?></td>
                                        <td><?= $row["serial_number"]; ?></td>
                                        <td><?= $row["storage_type"]; ?></td>
                                        <td><?= $row["memory_type"]; ?></td>
                                        <td><?= $row["vga_type"]; ?></td>
                                        <td><?= $row["operation_system"]; ?></td>
                                        <td><?= $row["office"]; ?></td>
                                        <td><?= $row["os_licence"]; ?></td>
                                        <td><?= $row["os"]; ?></td>
                                        <td><?= $row["aplikasi_lainnya"]; ?></td>
                                        <td><?= $row["keterangan"]; ?></td>
                                        <td><?= $row["status_pengalihan"]; ?></td>
                                        <td>
                                        <a href="../hapus dan edit/edit_detail_employe.php?id=<?=$row['employe_nik'];?>"><button class='edit'><i class="fa fa-edit"></i> Edit</button></a>
                                        <a href="../hapus dan edit/pengalihan_device.php?id=<?=$row['employe_nik'];?>"><button class='edit'><i class="fa fa-edit"></i> Pengalihan Device</button></a>
                                        <a href="../hapus dan edit/hapus_detail_employe.php?id=<?=$row['employe_nik'];?>" onclick="return confirm ('yakin untuk menghapus?');"><button class='hapus'><i class="fa fa-trash"></i> Hapus</button></a>
                                        </td>                                                      
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; DIRGANTARA INDONESIA 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>
