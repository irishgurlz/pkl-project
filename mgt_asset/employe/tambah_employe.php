<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EMPLOYE</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="../stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
    .button {
      color: white;
      padding: 12px;
      margin: 10px 0;
      border: none;
      width: 100%;
      border-radius: 3px;
      cursor: pointer;
      font-size: 17px;
    }
</style>

<body id="page-top">
    <?php include("sidebar.php") ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <h1 class="h3 mb-4 text-gray-800"><a href="data_employe.php" style="font-size:20px;"> < kembali </a></h1>
                    <h1 class="h3 mb-4 text-gray-800">TAMBAH EMPLOYE</h1>

                    <form action="../proses/simpan_employe.php" method="POST">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                            <label>EMPLOYE NIK</label>
                            <input type="text" name="nik" placeholder="Masukan NIK" class="form-control form-control-user">
                            </div>
                            <div class="form-group">
                            <label>EMPLOYE NAME</label>
                            <input type="text" name="name" placeholder="Masukan Nama" class="form-control form-control-user">
                            </div>
                            <div class="form-group">
                            <label>EMPLOYE ORG</label>
                            <?php
                            include '../koneksi.php';

                            $sql = "SELECT * FROM organisasi";
                            $level = mysqli_query($conn, $sql);
                            ?>
                                <select style="width:100%;" name="c_org" class="form-control form-control-user">
                                <?php
                                        $sql = "SELECT c_org FROM organisasi";
                                        $result = mysqli_query($conn, $sql);

                                        while($row = mysqli_fetch_assoc($result)){
                                            $option_value = $row['c_org'];
                                            $option_text = $row['c_org'];
                                            $option_selected = ($option_value == $organisasi) ?'selected' : '';
                                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group">
                            <label>EMPLOYE LEVEL</label>
                            <?php
                            include '../koneksi.php';

                            $sql = "SELECT * FROM level";
                            $level = mysqli_query($conn, $sql);
                            ?>
                                <select style="width:100%;" name="id_level" class="form-control form-control-user">
                                <?php
                                        $sql = "SELECT id_level, nama_level FROM level";
                                        $result = mysqli_query($conn, $sql);

                                        while($row = mysqli_fetch_assoc($result)){
                                            $option_value = $row['id_level'];
                                            $option_text = $row['nama_level'];
                                            $option_selected = ($option_value == $level) ?'selected' : '';
                                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        
                            <input type="submit" name="tambah" class="button btn-primary">
                        
                    </form>

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

</body>

</html>