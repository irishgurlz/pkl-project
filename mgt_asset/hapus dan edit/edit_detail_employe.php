<?php
include '../koneksi.php';

if (isset($_POST['update'])){
    $employe_nik = $_POST['employe_nik'];
    $employe_name = $_POST['employe_name'];
    $c_org = $_POST['c_org'];
    $lokasi = $_POST['lokasi'];
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

    $check_nik_query = "SELECT * FROM master_employee WHERE employe_nik = '$employe_nik'";
    $check_nik_result = mysqli_query($conn, $check_nik_query);
    $nik_exists = mysqli_num_rows($check_nik_result);

    if($nik_exists > 0){
        $query = "UPDATE detail_employe SET 
            id_kategori = '$id_kategori',
            id_type_kategori = '$id_type_kategori',
            processor = '$processor',
            storage_capacity = '$storage_capacity',
            memory_capacity = '$memory_capacity',
            vga_capacity = '$vga_capacity',
            nomor_it = '$nomor_it',
            nomor_aset = '$nomor_aset',
            serial_number = '$serial_number',
            storage_type = '$storage_type',
            memory_type = '$memory_type',
            vga_type = '$vga_type',
            keterangan = '$keterangan',
            operation_system = '$operation_system',
            office = '$office',
            os_licence = '$os_licence',
            os = '$os',
            aplikasi_lainnya = '$aplikasi_lainnya'
            WHERE employe_nik = '$employe_nik'";
        $result = mysqli_query($conn, $query);

        if($result){
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
    $result = mysqli_query($conn, "SELECT * FROM detail_employe WHERE employe_nik=$employe_nik");

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

    <title>EDIT DETAIL EMPLOYE</title>

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
                <h1 class="h3 m-3 text-gray-800" align="center">EDIT PENDATAAN PERANGKAT</h1>
                <!-- Content Row -->
                <div class="row">

<!-- First Column -->
<div class="col-lg-4">
  <div class="card shadow m-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-gray text-center">Pengguna</h6>
    </div>
    <div class="card-body">
      <form action="edit_detail_employe.php" method="POST">
        <div class="form-group">
          <label for="Nik" class="font-weight-bold text-gray">NIK</label>
          <input type="text" name="employe_nik" id="employe_nik" value="<?php echo $employe_nik;?>" placeholder="Masukan NIK" class="form-control form-control-user mb-2" readonly>
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
          <input type="text" name="lokasi" id="lokasi" value="<?php echo $lokasi;?>" placeholder="Masukan Lokasi" class="form-control form-control-user mb-2" readonly>
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
<tr>
    <td>
        <?php
            include '../koneksi.php';

            $sql = "SELECT * FROM kategori WHERE id_kategori IN (1, 7, 8)";
            $result = mysqli_query($conn, $sql);
        ?>
        <select style="width:100%;" name="id_kategori" id="id_kategori" class="form-control">
            <option disabled selected>Pilih Kategori</option>
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = $row['id_kategori'] == $id_kategori ? 'selected' : '';
                    echo "<option value='{$row['id_kategori']}' $selected>{$row['kategori']}</option>";
                }
            ?>
        </select>
    </td>
    <td></td>
    <td><input type="text" name="nomor_it" value="<?php echo $nomor_it;?>" placeholder="Nomor IT" class="form-control form-control-user mb-2" readonly></td>
</tr>
<tr>
    <td class="m-0 font-weight-bold text-gray" for="nama_type">Tipe</td>
    <td></td>
    <td class="m-0 font-weight-bold text-gray">Nomor Asset</td>
</tr>
<tr>
    <td>
        <?php
            include '../koneksi.php';

            $sql = "SELECT * FROM type_kategori WHERE id_kategori = '$id_kategori'";
            $result = mysqli_query($conn, $sql);
        ?>
        <select style="width:100%;" name="id_type_kategori" id="nama_type" class="form-control">
            <option disabled selected>Pilih Tipe</option>
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = $row['id_type_kategori'] == $id_type_kategori ? 'selected' : '';
                    echo "<option value='{$row['id_type_kategori']}' $selected>{$row['nama_type']}</option>";
                }
            ?>
        </select>

                <script>
document.getElementById('id_kategori').addEventListener('change', function() {
    var kategoriId = this.value;
    var tipeSelect = document.getElementById('nama_type');

    tipeSelect.innerHTML = '<<option disabled selected>Pilih Tipe</option>;';

    if (kategoriId) {
        fetch('../add/get_tipe.php?kategori_id=' + kategoriId)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched Data:', data); // Debugging
                if (Array.isArray(data)) {
                    data.forEach(tipe => {
                        var option = document.createElement('option');
                        option.value = tipe.id_type_kategori;
                        option.textContent = tipe.nama_type;
                        tipeSelect.appendChild(option);
                    });
                } else {
                    console.error('Data tidak valid:', data);
                }
            })
            .catch(error => console.error('Error:', error));
    }
});
</script>

        </td>
        <td></td>
        <td>
            <input type="text" name="nomor_aset" value="<?php echo $nomor_aset;?>" placeholder="Nomor Aset" class="form-control form-control-user mb-2">
        </td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">Processor</td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">Serial Number</td>
    </tr>
    <tr>
        <td>
        <?php
            include '../koneksi.php';

            $kategori = 6;
            $sql = "SELECT * FROM type_kategori";
            $level = mysqli_query($conn, $sql);
            ?>
                <select style="width:100%;" name="processor" class="form-control form-control-user mb-2">
                <?php
                        $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $option_value = $row['id_type_kategori'];
                            $option_text = $row['nama_type'];
                            $option_selected = ($option_value == $id_type_kategori) ?'selected' : '';
                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                        }
                        ?>
                </select>

        </td>
        <td></td>
        <td>
        <input type="text" name="serial_number" value="<?php echo $serial_number;?>" placeholder="Serial Number" class="form-control form-control-user mb-2">
        </td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">Storage Capacity</td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">Storage Type</td>
    </tr>
    <tr>
        <td><input type="text" name="storage_capacity" value="<?php echo $storage_capacity;?>" placeholder="Storage Capacity                                           GB" class="form-control form-control-user mb-2"></td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $kategori = 9;
            $sql = "SELECT * FROM type_kategori";
            $level = mysqli_query($conn, $sql);
            ?>
                <select style="width:100%;" name="storage_type" class="form-control form-control-user mb-2">
                <?php
                        $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $option_value = $row['id_type_kategori'];
                            $option_text = $row['nama_type'];
                            $option_selected = ($option_value == $storage_type) ?'selected' : '';
                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                        }
                        ?>
                </select>
</td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">Memory Capacity</td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">Memory Type</td>
    </tr>
    <tr>
        <td><input type="text" name="memory_capacity" value="<?php echo $memory_capacity;?>" placeholder="Memory Capacity                                          MB" class="form-control form-control-user mb-2">
        </td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $kategori = 10;
            $sql = "SELECT * FROM type_kategori";
            $level = mysqli_query($conn, $sql);
            ?>
                <select style="width:100%;" name="memory_type" class="form-control form-control-user mb-2">
                <?php
                        $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $option_value = $row['id_type_kategori'];
                            $option_text = $row['nama_type'];
                            $option_selected = ($option_value == $memory_type) ?'selected' : '';
                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                        }
                        ?>
                </select>

        </td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">VGA Capacity</td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">VGA Type</td>
    </tr>
    <tr>
        <td><input type="text" name="vga_capacity" value="<?php echo $vga_capacity;?>" placeholder="VGA Capacity                                                MB" class="form-control form-control-user mb-2">
        </td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $kategori = 11;
            $sql = "SELECT * FROM type_kategori";
            $level = mysqli_query($conn, $sql);
            ?>
                <select style="width:100%;" name="vga_type" class="form-control form-control-user mb-2">
                <?php
                        $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $option_value = $row['id_type_kategori'];
                            $option_text = $row['nama_type'];
                            $option_selected = ($option_value == $vga_type) ?'selected' : '';
                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                        }
                        ?>
                </select>

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

            $kategori = 12;
            $sql = "SELECT * FROM type_kategori";
            $level = mysqli_query($conn, $sql);
            ?>
                <select style="width:100%;" name="operation_system" class="form-control form-control-user mb-2">
                <?php
                        $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $option_value = $row['id_type_kategori'];
                            $option_text = $row['nama_type'];
                            $option_selected = ($option_value == $operation_system) ?'selected' : '';
                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                        }
                        ?>
                </select>
        </td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $kategori = 14;
            $sql = "SELECT * FROM type_kategori";
            $level = mysqli_query($conn, $sql);
            ?>
                <select style="width:100%;" name="os_licence" class="form-control form-control-user mb-2">
                <?php
                        $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $option_value = $row['id_type_kategori'];
                            $option_text = $row['nama_type'];
                            $option_selected = ($option_value == $os_licence) ?'selected' : '';
                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                        }
                        ?>
                </select>

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

            $kategori = 13;
            $sql = "SELECT * FROM type_kategori";
            $level = mysqli_query($conn, $sql);
            ?>
                <select style="width:100%;" name="office" class="form-control form-control-user mb-2">
                <?php
                        $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $option_value = $row['id_type_kategori'];
                            $option_text = $row['nama_type'];
                            $option_selected = ($option_value == $office) ?'selected' : '';
                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                        }
                        ?>
                </select>


        </td>
        <td></td>
        <td>
        <?php
            include '../koneksi.php';

            $kategori = 14;
            $sql = "SELECT * FROM type_kategori";
            $level = mysqli_query($conn, $sql);
            ?>
                <select style="width:100%;" name="os" class="form-control form-control-user mb-2">
                <?php
                        $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $option_value = $row['id_type_kategori'];
                            $option_text = $row['nama_type'];
                            $option_selected = ($option_value == $os) ?'selected' : '';
                            echo "<option value='{$option_value}' $option_selected>{$option_text}</option>";
                        }
                        ?>
                </select>

        </td>
    </tr>
    <tr>
    <td class="m-0 font-weight-bold text-gray">Aplikasi Lainnya</td>
        <td><label></label></td>
    </tr>
    <tr>
        <td colspan=3>
        <input type="text" name="aplikasi_lainnya" value="<?php echo $aplikasi_lainnya;?>" placeholder="aplikasi_lainnya" class="form-control form-control-user mb-2">
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