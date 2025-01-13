<?php
include '../koneksi.php';

if (isset($_POST['update'])){
    $id_org = $_POST['id'];
    $c_org = $_POST['c_org'];
    $c_org_parent = $_POST['c_org_parent'];
    $n_org = $_POST['n_org'];
    $e_org = $_POST['e_org'];

    $result = mysqli_query($conn, "UPDATE organisasi SET c_org='$c_org', c_org_parent='$c_org_parent',n_org='$n_org', e_org='$e_org' WHERE id_org=$id_org");

    if($result){
        echo
        "
          <script>
             window.location.href='../organisasi/data_organisasi.php';
          </script>
        ";

        
    } else {
        echo
        "
        <script>
           alert('Data Gagal Ditambahkan');
           window.location.href='edit_organisasi.php';
        </script>
      ";
    }
}
?>
<?php
$id_org = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM organisasi WHERE id_org=$id_org");

while($user_data = mysqli_fetch_array($result)){
    $c_org = $user_data['c_org'];
    $c_org_parent = $user_data['c_org_parent'];
    $n_org = $user_data['n_org'];
    $e_org = $user_data['e_org'];
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

    <title>EDIT ORGANIZATION</title>

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
                    <h1 class="h3 mb-4 text-gray-800"><a href="../organisasi/data_organisasi.php" style="font-size:20px;"> < kembali </a></h1>
                    <h1 class="h3 mb-4 text-gray-800">EDIT ORGANIZATION</h1>

                    <form action="edit_organisasi.php" method="POST">
                    <div class="row">

                        <div class="col-lg-6">
                        		<div class="form-group">
                                DIVISI
                                    <input type="text" class="form-control form-control-user" name="c_org_parent"
                                    value="<?php echo $c_org_parent;?>">
                                </div>
                        		<div class="form-group">
                                DEPARTMENT
                                    <input type="text" class="form-control form-control-user" name="c_org"
                                         value="<?php echo $c_org;?>">
                                </div>
                                
                                <div class="form-group">
                                NAMA DIVISI
                                    <input type="text" class="form-control form-control-user" name="n_org"
                                        value="<?php echo $n_org;?>">
                                </div>
                                <div class="form-group">
                                NAMA DEPARTMENT
                                    <input type="text" class="form-control form-control-user" name="e_org"
                                    value="<?php echo $e_org;?>">
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