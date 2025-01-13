<?php
include '../koneksi.php';

if (isset($_POST['update'])){
    $id_pengguna = $_POST['id'];
    $nik = $_POST['nik'];
    $name = $_POST['name'];
    $c_org = $_POST['c_org'];
    $level = $_POST['id_level'];

    // Update data pada tabel master_employee
    $result = mysqli_query($conn, "UPDATE master_employee SET employe_nik='$nik', employe_name='$name',c_org='$c_org', id_level='$level' WHERE employe_nik=$nik");

    // Update data pada tabel detail_employe
    $result_detail = mysqli_query($conn, "UPDATE detail_employe SET employe_name='$name', c_org='$c_org' WHERE employe_nik=$nik");

    if($result && $result_detail){
        echo
        "
          <script>
             window.location.href='../employe/data_employe.php';
          </script>
        ";

        
    } else {
        echo
        "
        <script>
           alert('Data Gagal Ditambahkan');
           window.location.href='edit_employe.php';
        </script>
      ";
    }
}
?>
<?php
$employe_nik = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM master_employee WHERE employe_nik=$employe_nik");

while($user_data = mysqli_fetch_array($result)){
    $nik = $user_data['employe_nik'];
    $name = $user_data['employe_name'];
    $org = $user_data['c_org'];
    $nama_level = $user_data['id_level'];
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

    <title>EDIT EMPLOYE</title>

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
      background-color: rgb(71, 104, 138);
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
                    <h1 class="h3 mb-4 text-gray-800"><a href="../employe/data_employe.php" style="font-size:20px;"> < kembali </a></h1>
                    <h1 class="h3 mb-4 text-gray-800">EDIT ORGANIZATION</h1>

                    <form action="edit_employe.php" method="POST">
                    <div class="row">

                        <div class="col-lg-6">
                        <div class="form-group">
                            <label>EMPLOYE NIK</label>
                            <input type="text" name="nik" value="<?php echo $nik;?>" class="form-control form-control-user" readonly>
                            </div>
                            <div class="form-group">
                            <label>EMPLOYE NAME</label>
                            <input type="text" name="name" value="<?php echo $name;?>" class="form-control form-control-user">
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
                                        $sql = "SELECT id_org, c_org FROM organisasi";
                                        $result = mysqli_query($conn, $sql);

                                        while($row = mysqli_fetch_assoc($result)){
                                            $option_value = $row['c_org'];
                                            $option_text = $row['c_org'];
                                            $option_selected = ($option_value == $org) ?'selected' : '';
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
                                            $option_selected = ($option_value == $nama_level) ?'selected' : '';
                                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                                <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                            <input type="submit" name="update" class="button btn-primary">
                        
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