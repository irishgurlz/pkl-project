<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TAMBAH PENDATAAN PERANGKAT</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="../stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <script>
        function fetchUserData() {
            var employe_nik = document.getElementById('employe_nik').value;
            if (employe_nik.length >= 4) { // Minimum length to start querying
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'get_user.php?employe_nik=' + employe_nik, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById('employe_name').value = data.employe_name || '';
                        document.getElementById('c_org').value = data.c_org || '';
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
                <h1 class="h3 m-3 text-gray-800" align="center">FORM PENDATAAN PERANGKAT</h1>
                <!-- Content Row -->
                <div class="row">

<!-- First Column -->
<div class="col-lg-4">
  <div class="card shadow m-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-gray text-center">Pengguna</h6>
    </div>
    <div class="card-body">
      <form action="../proses/simpan_pendataan_perangkat.php" method="POST">
        <div class="form-group">
          <label for="Nik" class="font-weight-bold text-gray">NIK</label>
          <input type="text" name="employe_nik" id="employe_nik" placeholder="Masukan NIK" class="form-control form-control-user mb-2" onkeyup="fetchUserData()" required>
        </div>
        <div class="form-group">
          <label for="name" class="font-weight-bold text-gray">Nama</label>
          <input type="text" name="employe_name" id="employe_name" placeholder="Nama" class="form-control form-control-user mb-2" readonly>
        </div>
        <div class="form-group">
          <label for="c_org" class="font-weight-bold text-gray">Organisasi</label>
          <input type="text" style="width:100%;" name="c_org" id="c_org" placeholder="Organisasi" class="form-control form-control-user mb-2" readonly>
        </div>
        <div class="form-group">
          <label for="lokasi" class="font-weight-bold text-gray">Lokasi</label>
          <input type="text" name="lokasi" id="lokasi" placeholder="Masukan Lokasi" class="form-control form-control-user mb-2">
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
        <td></td>
    </tr>
    <tr>
        <td>
                <select style="width:100%;" name="id_kategori" id="id_kategori" class="form-control">
                <option disabled selected>Pilih Kategori</option>;
                    <?php
                    include '../koneksi.php'; // Ganti dengan path yang sesuai ke file koneksi

                    $sql = "SELECT id_kategori, kategori FROM kategori WHERE id_kategori IN (1, 7, 8)";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='{$row['id_kategori']}'>{$row['kategori']}</option>";
                    }
                    ?>
                </select>

        </td>
        <td></td>
        <td><input type="text" name="nomor_it" placeholder="Nomor IT" class="form-control form-control-user mb-2"></td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray" for="nama_type">Tipe</td>
    </tr>
    <tr>
        <td>
                <select style="width:100%;" name="id_type_kategori" id="nama_type" class="form-control">
                <option disabled selected>Pilih Tipe</option>;
                </select>

                <script>
document.getElementById('id_kategori').addEventListener('change', function() {
    var kategoriId = this.value;
    var tipeSelect = document.getElementById('nama_type');

    tipeSelect.innerHTML = '<<option disabled selected>Pilih Tipe</option>;';

    if (kategoriId) {
        fetch('get_tipe.php?kategori_id=' + kategoriId)
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
            <input type="text" name="nomor_aset" placeholder="Nomor Aset" class="form-control form-control-user mb-2">
        </td>
    </tr>
    <tr>
        <td class="m-0 font-weight-bold text-gray">Processor</td>
    </tr>
    <tr>
        <td>
        <?php
        include '../koneksi.php';

        // Define the $kategori variable
        $kategori = 6; // Replace with the desired ID

        $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
        $result = mysqli_query($conn, $sql);

        ?>
        <select style="width:100%;" name="processor" class="form-control form-control-user mb-2">
            <?php
            while($row = mysqli_fetch_assoc($result)){
                $option_value = $row['id_type_kategori'];
                $option_text = $row['nama_type'];
                echo "<option value='{$option_value}' selected>{$option_text}</option>";
            }
            ?>
        </select>

        </td>
        <td></td>
        <td>
        <input type="text" name="serial_number" placeholder="Serial Number" class="form-control form-control-user mb-2">
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">Storage Type</td>
    </tr>
    <tr>
        <td><input type="text" name="storage_capacity" placeholder="Storage Capacity                                           GB" class="form-control form-control-user mb-2"></td>
        <td></td>
        <td>
            <?php
                include '../koneksi.php';

                // Define the $kategori variable
                $kategori = 9; // Replace with the desired ID

                $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                $result = mysqli_query($conn, $sql);

                ?>
                <select style="width:100%;" name="storage_type" class="form-control form-control-user mb-2">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $option_value = $row['id_type_kategori'];
                        $option_text = $row['nama_type'];
                        echo "<option value='{$option_value}' selected>{$option_text}</option>";
                    }
                    ?>
        </select>
</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">Memory Type</td>
    </tr>
    <tr>
        <td><input type="text" name="memory_capacity" placeholder="Memory Capacity                                          MB" class="form-control form-control-user mb-2">
        </td>
        <td></td>
        <td>
        <?php
                include '../koneksi.php';

                // Define the $kategori variable
                $kategori = 10; // Replace with the desired ID

                $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                $result = mysqli_query($conn, $sql);

                ?>
                <select style="width:100%;" name="memory_type" class="form-control form-control-user mb-2">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $option_value = $row['id_type_kategori'];
                        $option_text = $row['nama_type'];
                        echo "<option value='{$option_value}' selected>{$option_text}</option>";
                    }
                    ?>
        </select>

        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td class="m-0 font-weight-bold text-gray">VGA Type</td>
    </tr>
    <tr>
        <td><input type="text" name="vga_capacity" placeholder="VGA Capacity                                                MB" class="form-control form-control-user mb-2">
        </td>
        <td></td>
        <td>
        <?php
                include '../koneksi.php';

                // Define the $kategori variable
                $kategori = 11; // Replace with the desired ID

                $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                $result = mysqli_query($conn, $sql);

                ?>
                <select style="width:100%;" name="vga_type" class="form-control form-control-user mb-2">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $option_value = $row['id_type_kategori'];
                        $option_text = $row['nama_type'];
                        echo "<option value='{$option_value}' selected>{$option_text}</option>";
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
            <textarea class="col-lg-12" name="keterangan" placeholder="Keterangan Tambahan" style="height:150px;"></textarea>
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

                // Define the $kategori variable
                $kategori = 12; // Replace with the desired ID

                $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                $result = mysqli_query($conn, $sql);

                ?>
                <select style="width:100%;" name="operation_system" class="form-control form-control-user mb-2">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $option_value = $row['id_type_kategori'];
                        $option_text = $row['nama_type'];
                        echo "<option value='{$option_value}' selected>{$option_text}</option>";
                    }
                    ?>
        </select>
        </td>
        <td></td>
        <td>
        <?php
                include '../koneksi.php';

                // Define the $kategori variable
                $kategori = 14; // Replace with the desired ID

                $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                $result = mysqli_query($conn, $sql);

                ?>
                <select style="width:100%;" name="os_licence" class="form-control form-control-user mb-2">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $option_value = $row['id_type_kategori'];
                        $option_text = $row['nama_type'];
                        echo "<option value='{$option_value}' selected>{$option_text}</option>";
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

                // Define the $kategori variable
                $kategori = 13; // Replace with the desired ID

                $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                $result = mysqli_query($conn, $sql);

                ?>
                <select style="width:100%;" name="office" class="form-control form-control-user mb-2">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $option_value = $row['id_type_kategori'];
                        $option_text = $row['nama_type'];
                        echo "<option value='{$option_value}' selected>{$option_text}</option>";
                    }
                    ?>
        </select>


        </td>
        <td></td>
        <td>
        <?php
                include '../koneksi.php';

                // Define the $kategori variable
                $kategori = 14; // Replace with the desired ID

                $sql = "SELECT id_type_kategori, nama_type FROM type_kategori WHERE id_kategori = '$kategori'";
                $result = mysqli_query($conn, $sql);

                ?>
                <select style="width:100%;" name="os" class="form-control form-control-user mb-2">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $option_value = $row['id_type_kategori'];
                        $option_text = $row['nama_type'];
                        echo "<option value='{$option_value}' selected>{$option_text}</option>";
                    }
                    ?>
        </select>

        </td>
    </tr>
    <tr>
        <td><label></label></td>
    </tr>
    <tr>
        <td colspan=3>
        <input type="text" name="aplikasi_lainnya" placeholder="aplikasi_lainnya" class="form-control form-control-user mb-2">
        </td>
    </tr>
    </table>
    </div>
</div>
</div>
</div>
<center><input type="submit" name="tambah" class="button btn-primary col-lg-11"></center>
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