<?php
include '../koneksi.php';

if (isset($_POST['update'])){
    $id_type_kategori = $_POST['id'];
    $kategori = $_POST['id_kategori'];
    $nama_type = $_POST['nama_type'];


    $result = mysqli_query($conn, "UPDATE type_kategori SET id_kategori='$kategori',nama_type='$nama_type' WHERE id_type_kategori=$id_type_kategori");

    if($result){
        echo
        "
          <script>
             window.location.href='../kategori/data_type_kategori.php';
          </script>
        ";

        
    } else {
        echo
        "
        <script>
           alert('Data Gagal Ditambahkan');
           window.location.href='edit_type_kategori.php';
        </script>
      ";
    }
}
?>
<?php
$id_type_kategori = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM type_kategori INNER JOIN kategori ON type_kategori.id_kategori = kategori.id_kategori WHERE id_type_kategori=$id_type_kategori");

while($user_data = mysqli_fetch_array($result)){
    $nama_type = $user_data['nama_type'];
    $kategori = $user_data['id_kategori'];
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

    <title>EDIT TYPE KATEGORI</title>

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
                    <h1 class="h3 mb-4 text-gray-800"><a href="../kategori/data_type_kategori.php" style="font-size:20px;"> < kembali </a></h1>
                    <h1 class="h3 mb-4 text-gray-800">EDIT TYPE KATEGORI</h1>

                    <form action="edit_type_kategori.php" method="POST">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                            <label>KATEGORI</label>
                            <?php
                            include '../koneksi.php';

                            $sql = "SELECT * FROM kategori";
                            $level = mysqli_query($conn, $sql);
                            ?>
                                <select style="width:100%;" name="id_kategori" class="form-control form-control-user" disabled>
                                <?php
                                        $sql = "SELECT id_kategori, kategori FROM kategori";
                                        $result = mysqli_query($conn, $sql);

                                        while($row = mysqli_fetch_assoc($result)){
                                            $option_value = $row['id_kategori'];
                                            $option_text = $row['kategori'];
                                            $option_selected = ($option_value == $kategori) ?'selected' : '';
                                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                                        }
                                        ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>NAMA TYPE</label>
                                <input type="text" class="form-control form-control-user" name="nama_type" value="<?php echo $nama_type;?>">
                                </div>
                                <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                                <input type="hidden" name="id_kategori" value="<?php echo $kategori;?>">
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