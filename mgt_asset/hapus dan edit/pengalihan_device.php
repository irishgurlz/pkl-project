<?php
include '../koneksi.php';

if (isset($_POST['update'])) {
    $employe_nik = $_POST['id'];
    $employe_nik_new = $_POST['employe_nik_new'];
    $employe_name = $_POST['employe_name'];
    $c_org = $_POST['c_org'];
    $lokasi = $_POST['lokasi'];
    $id_kategori = $_POST['id_kategori'];
    $id_kategori = $_POST['id_kategori'];
    $id_type_kategori = $_POST['id_type_kategori'];
    $processor = $_POST['processor'];
    $storage_capacity = $_POST['storage_capacity'];
    $memory_capacity = $_POST['memory_capacity'];
    $vga_capacity = $_POST['vga_capacity'];
    $nomor_it = $_POST['nomor_it'];
    $nomor_aset = $_POST['nomor_aset'];
    $serial_number = $_POST['serial_number'];
    $storage_type = $_POST['storage_type'];
    $memory_type = $_POST['memory_type'];
    $vga_type = $_POST['vga_type'];
    $keterangan = $_POST['keterangan'];
    $operation_system = $_POST['operation_system'];
    $office = $_POST['office'];
    $os_licence = $_POST['os_licence'];
    $os = $_POST['os'];
    $aplikasi_lainnya = $_POST['aplikasi_lainnya'];
    // $status_pengalihan = $_POST['status_pengalihan'];

    // Check if the submitted NIK is already in the database
    $check_nik_query = "SELECT * FROM master_employee WHERE employe_nik = '$employe_nik_new'";
    $check_nik_result = mysqli_query($conn, $check_nik_query);
    $nik_exists = mysqli_num_rows($check_nik_result);
    $new_status_query = "SELECT MAX(status_pengalihan) AS max_status FROM detail_employe WHERE nomor_aset = '$nomor_aset'";
    $new_status = mysqli_query($conn, $new_status_query);
    
    // Pastikan query berhasil dan status_pengalihan ditemukan
    if ($new_status && mysqli_num_rows($new_status) > 0) {
        $row = mysqli_fetch_assoc($new_status);
        $status_baru = (int)$row['max_status'] + 1;  // Mengubah status_pengalihan menjadi integer dan menambahkannya
        // Lanjutkan dengan logika Anda
    } else {
        echo "Status tidak ditemukan atau terjadi kesalahan pada query.";
    }

    if ($nik_exists > 0) {
        // NIK exists, proceed with the insert query
        $query = "INSERT INTO detail_employe (
            employe_nik,
            employe_name,
            c_org,
            lokasi,
            id_kategori,
            id_type_kategori,
            processor,
            storage_capacity,
            memory_capacity,
            vga_capacity,
            nomor_it,
            nomor_aset,
            serial_number,
            storage_type,
            memory_type,
            vga_type,
            keterangan,
            operation_system,
            office,
            os_licence,
            os,
            aplikasi_lainnya,
            status_pengalihan
        ) VALUES (
            '$employe_nik_new',
            '$employe_name',
            '$c_org',
            '$lokasi',
            '$id_kategori',
            '$id_type_kategori',
            '$processor',
            '$storage_capacity',
            '$memory_capacity',
            '$vga_capacity',
            '$nomor_it',
            '$nomor_aset',
            '$serial_number',
            '$storage_type',
            '$memory_type',
            '$vga_type',
            '$keterangan',
            '$operation_system',
            '$office',
            '$os_licence',
            '$os',
            '$aplikasi_lainnya',
            '$status_baru'
        )";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo
            "
              <script>
                 window.location.href='../add/detail_employe.php';
              </script>
            ";
        } else {
            echo
            "
            <script>
               alert('Data Gagal Ditambahkan');
               window.location.href='edit_detail_employe.php?id=$employe_nik';
            </script>
          ";
        }
    } else {
        // NIK not found, display notification
        echo
        "
        <script>
           alert('NIK tidak terdaftar');
           window.location.href='edit_detail_employe.php?id=$employe_nik';
        </script>
      ";
    }
}
?>

<?php
$employe_nik = $_GET['id'];

if (isset($employe_nik) && !empty($employe_nik)) {
    $result = mysqli_query($conn, "SELECT * FROM detail_employe WHERE employe_nik = '$employe_nik' ORDER BY status_pengalihan DESC LIMIT 1");

    while($user_data = mysqli_fetch_array($result)){
        $employe_nik = $user_data['employe_nik'];
        $employe_name = $user_data['employe_name'];
        $c_org = $user_data['c_org'];
        $lokasi = $user_data['lokasi'];
        $id_kategori = $user_data['id_kategori'];
        $id_type_kategori = $user_data['id_type_kategori'];
        $processor = $user_data['processor'];
        $storage_capacity = $user_data['storage_capacity'];
        $memory_capacity = $user_data['memory_capacity'];
        $vga_capacity = $user_data['vga_capacity'];
        $nomor_it = $user_data['nomor_it'];
        $nomor_aset = $user_data['nomor_aset'];
        $serial_number = $user_data['serial_number'];
        $storage_type = $user_data['storage_type'];
        $memory_type = $user_data['memory_type'];
        $vga_type = $user_data['vga_type'];
        $keterangan = $user_data['keterangan'];
        $operation_system = $user_data['operation_system'];
        $office = $user_data['office'];
        $os_licence = $user_data['os_licence'];
        $os = $user_data['os'];
        $aplikasi_lainnya = $user_data['aplikasi_lainnya'];
    }
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

    <title>PENGALIHAN DEVICE</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="../stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>
<script>
        function fetchUserData() {
            var employe_nik = document.getElementById('employe_nik').value;
            if (employe_nik.length >= 4) { // Minimum length to start querying
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'get_user.php?employe_nik=' + employe_nik, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        if (data) {
                            var employe_name = data.employe_name;
                            var c_org = data.c_org;
                            document.getElementById('employe_name').value = employe_name;
                            document.getElementById('c_org').value = c_org;
                        } else {
                            console.log('Data tidak diterima dari server');
                        }
                    } else {
                        console.log('Gagal mengirim data ke server');
                    }
                };
                xhr.send();
            } else {
                // Clear fields if NIK is too short
                document.getElementById('employe_name').value = '';
                document.getElementById('c_org').value = '';
            }
        }
    </script>

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
                <h1 class="h3 mb-2 text-gray-800 m-3"><a href="../add/detail_employe.php" style="font-size:20px;"> < kembali </a></h1>
                <h1 class="h3 m-3 text-gray-800" align="center">PENGALIHAN DEVICE</h1>
                <!-- Content Row -->
                <div class="row">

<!-- First Column -->
<div class="col-lg-4">
  <div class="card shadow m-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-gray text-center">Pengguna</h6>
    </div>
    <div class="card-body">
      <form action="pengalihan_device.php" method="POST">
        <div class="form-group">
          <label for="Nik" class="font-weight-bold text-gray">NIK</label>
          <input type="text" name="employe_nik_new" id="employe_nik" value="<?php echo $employe_nik;?>" placeholder="Masukan NIK" class="form-control form-control-user mb-2" onkeyup="fetchUserData()">
        </div>
        <div class="form-group">
          <label for="name" class="font-weight-bold text-gray">Nama</label>
          <input type="text" name="employe_name" id="employe_name" value="<?php echo $employe_name;?>" placeholder="Nama" class="form-control form-control-user mb-2" readonly>
        </div>
        <div class="form-group">
          <label for="id_org" class="font-weight-bold text-gray">Organisasi</label>
          <input type="text" style="width:100%;" name="c_org" id="c_org" value="<?php echo $c_org;?>" placeholder="Organisasi" class="form-control form-control-user mb-2" readonly>
        </div>
        <div class="form-group">
          <label for="lokasi" class="font-weight-bold text-gray">Lokasi</label>
          <input type="text" name="lokasi" id="lokasi" value="<?php echo $lokasi;?>" placeholder="Masukan Lokasi" class="form-control form-control-user mb-2">
        </div>
    </div>
  </div>
</div>

<!-- Second Column -->
<div class="col-lg-8">
    

<!-- Background Gradient Utilities -->
<div class="card shadow m-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-gray" align="center">Perangkat</h6>
    </div>

    <div class="card-body">       
        <table border="0px" width="100%">
            <tr>
                <td class="m-0 font-weight-bold text-gray" for="id_kategori">Kategori</td>
                <td style="color:white;">ppp</td>
                <td class="m-0 font-weight-bold text-gray">Nomor IT</td>
            </tr>

            <!-- KATEGORI -->
            <tr>
                <td>
                    <?php
                        include '../koneksi.php';

                        $sql = "SELECT * FROM kategori WHERE id_kategori IN (1, 7, 8)";
                        $result = mysqli_query($conn, $sql);
                        
                        $selected_kategori = '';
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['id_kategori'] == $id_kategori) {
                                $selected_kategori = $row['kategori'];
                                break;
                            }
                        }
                    ?>
                    <input type="text" style="width:100%;" name="id_kategori" id="id_kategori" 
                        class="form-control" value="<?php echo $selected_kategori; ?>" readonly>
                        <input type="hidden" name="id_kategori" value="<?php echo $id_kategori;?>">
                </td>
                <td></td>
                <!-- NOMOR IT -->
                <td><input type="text" name="nomor_it" value="<?php echo $nomor_it;?>" placeholder="Nomor IT" class="form-control form-control-user mb-2" readonly></td>
            </tr>
            
            <tr>
                <td class="m-0 font-weight-bold text-gray" for="nama_type">Tipe</td>
                <td></td>
                <td class="m-0 font-weight-bold text-gray">Nomor Asset</td>
            </tr>
            <tr>
                <td>
                <!-- TIPE -->
                <?php
                    include '../koneksi.php';

                    $sql = "SELECT * FROM type_kategori WHERE id_type_kategori = '$id_type_kategori'";
                    $result = mysqli_query($conn, $sql);

                    $selected_kategori = '';
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['id_type_kategori'] == $id_type_kategori) {
                            $selected_kategori = $row['nama_type']; 
                            break;
                        }
                    }
                ?>
                <input type="text" style="width:100%;" name="id_type_kategori" id="id_type_kategori" 
                    class="form-control" value="<?php echo $selected_kategori; ?>" readonly>
                    <input type="hidden" name="id_type_kategori" value="<?php echo $id_type_kategori;?>">
                    </td>
                    <td></td>
                <!-- NOMOR ASSET -->
                    <td>
                        <input type="text" name="nomor_aset" value="<?php echo $nomor_aset;?>" placeholder="Nomor Aset" class="form-control form-control-user mb-2" readonly>
                    </td>
                </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">Processor</td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">Serial Number</td>
    </tr>
    <tr>
        <td>
            <!-- PROCESSOR -->
            <?php
                include '../koneksi.php';

                $sql = "SELECT * FROM type_kategori";
                $result = mysqli_query($conn, $sql);

                $selected_processor = '';
                
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['id_type_kategori'] == $processor) {
                        $selected_processor = $row['nama_type'];
                        break;
                    }
                }
            ?>
            <input type="text" style="width:100%;" name="processor" class="form-control form-control-user mb-2" value="<?php echo $selected_processor; ?>" readonly>
            <input type="hidden" name="processor" value="<?php echo $processor;?>">

        </td>
        <td></td>
        <td>
        <input type="text" name="serial_number" value="<?php echo $serial_number;?>" placeholder="Serial Number" class="form-control form-control-user mb-2" readonly>
        <input type="hidden" name="serial_number" value="<?php echo $serial_number;?>">

        </td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">Storage Capacity</td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">Storage Type</td>
    </tr>
    <tr>
        <td><input type="text" name="storage_capacity" value="<?php echo $storage_capacity;?>" placeholder="Storage Capacity                                           GB" class="form-control form-control-user mb-2" readonly></td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $sql = "SELECT * FROM type_kategori";
            $result = mysqli_query($conn, $sql);
            $selected_storage = '';
                
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id_type_kategori'] == $storage_type) {
                    $selected_storage = $row['nama_type'];
                    break;
                }
            }
            ?>
            <input type="text" style="width:100%;" name="storage_type" class="form-control form-control-user mb-2" value="<?php echo $selected_storage; ?>" readonly>
            <input type="hidden" name="storage_type" value="<?php echo $storage_type;?>">

    
</td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">Memory Capacity</td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">Memory Type</td>
    </tr>
    <tr>
        <td><input type="text" name="memory_capacity" value="<?php echo $memory_capacity;?>" placeholder="Memory Capacity                                          MB" class="form-control form-control-user mb-2" readonly>
        </td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $sql = "SELECT * FROM type_kategori";
            $result = mysqli_query($conn, $sql);
            $selected_memory = '';
                
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id_type_kategori'] == $memory_type) {
                    $selected_memory = $row['nama_type'];
                    break;
                }
            }
            ?>
            <input type="text" style="width:100%;" name="memory_type" class="form-control form-control-user mb-2" value="<?php echo $selected_memory; ?>" readonly>
            <input type="hidden" name="memory_type" value="<?php echo $memory_type;?>">
        </td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">VGA Capacity</td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">VGA Type</td>
    </tr>
    <tr>
        <td><input type="text" name="vga_capacity" value="<?php echo $vga_capacity;?>" placeholder="VGA Capacity                                                MB" class="form-control form-control-user mb-2" readonly>
        </td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $sql = "SELECT * FROM type_kategori";
            $result = mysqli_query($conn, $sql);
            $selected_vga = '';
                
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id_type_kategori'] == $vga_type) {
                    $selected_vga = $row['nama_type'];
                    break;
                }
            }
            ?>
            <input type="text" style="width:100%;" name="vga_type" class="form-control form-control-user mb-2" value="<?php echo $selected_vga; ?>" readonly>
            <input type="hidden" name="vga_type" value="<?php echo $vga_type;?>">

        </td>
    </tr>
    </table>
    </div>
</div>
</div>

<!-- First Column -->
<div class="col-lg-4">

    <!-- Custom Text Color Utilities -->
    <div class="card shadow m-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray" align="center">Keterangan Tambahan</h6>
        </div>
        <div class="card-body">
            <textarea class="col-lg-12" name="keterangan" value="<?php echo $keterangan;?>" placeholder="Keterangan Tambahan" style="height:150px;"><?php echo $keterangan;?></textarea>
        </div>
    </div>

</div>

<!-- Second Column -->
<div class="col-lg-8">
    

<!-- Background Gradient Utilities -->
<div class="card shadow m-4">
<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray" align="center">Aplikasi</h6>
    </div>
    <div class="card-body">
    <table border="0px" width="100%">
    <tr>
        <td class="m-0 font-weight-bold text-gray">Operation System</td>
        <td style="color:white;">ppp</td>
        <td class="m-0 font-weight-bold text-gray">OS Licence</td>
    </tr>
    <tr>
        <td>
        <?php
            include '../koneksi.php';

            $sql = "SELECT * FROM type_kategori";
            $result = mysqli_query($conn, $sql);
            $selected_os = '';
                
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id_type_kategori'] == $operation_system) {
                    $selected_os = $row['nama_type'];
                    break;
                }
            }
            ?>
            <input type="text" style="width:100%;" name="operation_system" class="form-control form-control-user mb-2" value="<?php echo $selected_os; ?>" readonly>
            <input type="hidden" name="operation_system" value="<?php echo $operation_system;?>">
        </td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $sql = "SELECT * FROM type_kategori";
            $result = mysqli_query($conn, $sql);
            $selected_os_licence = '';
                
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id_type_kategori'] == $os_licence) {
                    $selected_os_licence = $row['nama_type'];
                    break;
                }
            }
            ?>
            <input type="text" style="width:100%;" name="os_license" class="form-control form-control-user mb-2" value="<?php echo $selected_os_licence; ?>" readonly>
            <input type="hidden" name="os_licence" value="<?php echo $os_licence;?>">
        </td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">Office</td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">OS Licence</td>
    </tr>
    <tr>
        <td>
        <?php
            include '../koneksi.php';

            $sql = "SELECT * FROM type_kategori";
            $result = mysqli_query($conn, $sql);
            $selected_office = '';
                
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id_type_kategori'] == $office) {
                    $selected_office = $row['nama_type'];
                    break;
                }
            }
            ?>
            <input type="text" style="width:100%;" name="office" class="form-control form-control-user mb-2" value="<?php echo $selected_office; ?>" readonly>
            <input type="hidden" name="office" value="<?php echo $office;?>">
        </td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $sql = "SELECT * FROM type_kategori";
            $result = mysqli_query($conn, $sql);
            $selected_os_office = '';
                
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id_type_kategori'] == $os) {
                    $selected_os_office = $row['nama_type'];
                    break;
                }
            }
            ?>
            <input type="text" style="width:100%;" name="os" class="form-control form-control-user mb-2" value="<?php echo $selected_os_office; ?>" readonly>
            <input type="hidden" name="os" value="<?php echo $os;?>">
        </td>
        </td>
    </tr>
    <tr>
    <td class="m-0 font-weight-bold text-gray">Aplikasi Lainnya</td>
        <td><label></label></td>
    </tr>
    <tr>
        <td colspan=3>
        <input type="text" name="aplikasi_lainnya" value="<?php echo $aplikasi_lainnya;?>" placeholder="aplikasi_lainnya" class="form-control form-control-user mb-2" readonly>
        </td>
    </tr>
    </table>
    </div>
</div>
</div>
</div>
<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
<center><input type="submit" name="update" class="button btn-primary col-lg-11"></center>
    </form>
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