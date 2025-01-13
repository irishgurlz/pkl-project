<?php 

include "../koneksi.php";

$id_detail_employe = $_GET['id'];

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
INNER JOIN master_employee ON d.employe_nik = master_employee.employe_nik
INNER JOIN organisasi ON d.c_org = organisasi.c_org
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
INNER JOIN type_kategori ON d.id_type_kategori = type_kategori.id_type_kategori WHERE d.id_detail_employe = '$id_detail_employe'";
$result = mysqli_query($conn, $sql);

while($d = mysqli_fetch_array($result)){
    $nomor_it = $d['nomor_it'];
    $employe_nik = $d['employe_nik'];
    $employe_name = $d['employe_name'];
    $c_org = $d['c_org'];
    $lokasi = $d['lokasi'];
	$kategori = $d['kategori'];
    $id_type_kategori = $d['id_type_kategori'];
    $processor = $d['processor'];
    $storage_capacity = $d['storage_capacity'];
    $memory_capacity = $d['memory_capacity'];
    $vga_capacity = $d['vga_capacity'];
    $nomor_aset = $d['nomor_aset'];
    $serial_number = $d['serial_number'];
    $storage_type = $d['storage_type'];
    $memory_type = $d['memory_type'];
	$vga_type = $d['vga_type'];
    $operation_system = $d['operation_system'];
    $office = $d['office'];
    $os_licence = $d['os_licence'];
    $os = $d['os'];
	$aplikasi_lainnya = $d['aplikasi_lainnya'];
    $keterangan = $d['keterangan'];
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<style>
    th{
        text-align: left;
    }
    .container3 {
        background-color: white;
        border: 3px solid #f1f1f1;
        padding: 20px;
        margin: 15px;
      }
      table{
    width: 100%;
  }
</style>

<body id="page-top" onload="print()">
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

                <!-- Topbar Search -->

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div>

<!-- Page Heading -->

<!-- DataTales Example -->
<div>
    <div>
    </div>
    <div class="container3">
    <center><i><img src="../img/ptdi.png" alt="" class="mb-3" width="70px" height="70px"></i><h1>DATA DETAIL EMPLOYE</h1><hr></center>
        <form action="../proses/simpan_pendataan_perangkat.php" method="POST">
		<table>
			<tr>
				<th colspan="3" style="color: black;">Pengguna</th>
			</tr>
            <tr>
                <td colspan="3"><hr></td>
            </tr>
			<tr>
				<td>NIK</td>
				<td colspan="2">: <?= $employe_nik ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td colspan="2">: <?= $employe_name ?></td>
			</tr>
			<tr>
				<td>Organisasi</td>
				<td colspan="2">: <?= $c_org ?></td>
			</tr>
			<tr>
				<td>Lokasi</td>
				<td colspan="2">: <?= $lokasi ?></td>
			</tr>
            <tr>
                <td colspan="3"><hr></td>
            </tr>
			<tr>
				<th colspan="3" style="color: black;">Perangkat</th>
			</tr>
            <tr>
                <td colspan="3"><hr></td>
            </tr>
			<tr>
				<td>Nomor IT</td>
				<td colspan="2">: <?= $nomor_it?></td>
			</tr>
			<tr>
                <td>Kategori</td>
                <td colspan="2">: <?= $kategori ?></td>
			</tr>
			<tr>
                <td>Tipe</td>
                <td colspan="2">: <?= $id_type_kategori ?></td>
			</tr>
            <tr>
                <td>Processor</td>
                <td colspan="2">: <?= $processor ?></td>
			</tr>
            <tr>
                <td>Storage Capacity</td>
                <td colspan="2">: <?= $storage_capacity ?></td>
			</tr>
            <tr>
                <td>Memory Capacity</td>
                <td colspan="2">: <?= $memory_capacity ?></td>
			</tr>
            <tr>
                <td>VGA Capacity</td>
                <td colspan="2">: <?= $vga_capacity ?></td>
			</tr>
            <tr>
                <td>Nomor Aset</td>
                <td colspan="2">: <?= $nomor_aset ?></td>
			</tr>
            <tr>
                <td>Serial Number</td>
                <td colspan="2">: <?= $serial_number ?></td>
			</tr>
            <tr>
                <td>Storage Type</td>
                <td colspan="2">: <?= $storage_type ?></td>
			</tr>
            <tr>
                <td>Memory Type</td>
                <td colspan="2">: <?= $memory_type ?></td>
			</tr>
            <tr>
                <td>VGA Type</td>
                <td colspan="2">: <?= $vga_type ?></td>
			</tr>
            <tr>
                <td colspan="3"><hr></td>
            </tr>
			<tr>
				<th colspan="3" style="color: black;">Aplikasi</th>
			</tr>
            <tr>
                <td colspan="3"><hr></td>
            </tr>
			<tr>
				<td>Operation System</td>
				<td colspan="2">: <?= $operation_system?></td>
			</tr>
			<tr>
                <td>Office</td>
                <td colspan="2">: <?= $office ?></td>
			</tr>
			<tr>
                <td>OS Licence</td>
                <td colspan="2">: <?= $os_licence ?></td>
			</tr>
            <tr>
                <td>OS Licence</td>
                <td colspan="2">: <?= $os ?></td>
			</tr>
            <tr>
                <td>Keterangan</td>
                <td colspan="2">: <?= $keterangan ?></td>
			</tr>
		</table>
	</form>

    <meta http-equiv="" content="1; URL=http:detail_employe_data.php"/>
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

    <script>
    window.onload = function() {
        window.print();
        setTimeout(function() {
            window.history.back();
        }, 1000); // Mengembalikan setelah 1 detik, adjust waktu jika perlu
    }
</script>


</body>

</html>
