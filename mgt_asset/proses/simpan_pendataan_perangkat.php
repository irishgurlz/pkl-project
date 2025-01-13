<?php
require '../koneksi.php';

if(isset($_POST['tambah'])){
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

    // Check if the submitted NIK is already in the database
    $check_nik_query = "SELECT * FROM master_employee WHERE employe_nik = '$employe_nik'";
    $check_nik_result = mysqli_query($conn, $check_nik_query);
    $nik_exists = mysqli_num_rows($check_nik_result);

    // Check if the submitted nomor IT is already in the database
    $check_nomor_it_query = "SELECT * FROM detail_employe WHERE nomor_it = '$nomor_it'";
    $check_nomor_it_result = mysqli_query($conn, $check_nomor_it_query);
    $nomor_it_exists = mysqli_num_rows($check_nomor_it_result);

    if($nik_exists > 0){
        // NIK already exists, proceed with the insert query
        if($nomor_it_exists > 0){
            // Nomor IT already exists, display notification
            echo
            "
            <script>
               alert('Nomor IT sudah terdaftar');
               window.location.href='../add/tambah_pendataan_perangkat.php';
            </script>
          ";
        } else {
            $query = "INSERT INTO detail_employe ( employe_nik, employe_name, c_org, lokasi, id_kategori, id_type_kategori, processor, storage_capacity, memory_capacity, vga_capacity, nomor_it, nomor_aset, serial_number, storage_type, memory_type, vga_type, keterangan, operation_system, office, os_licence, os, aplikasi_lainnya ) 
                      VALUES ('$employe_nik','$employe_name','$c_org','$lokasi','$id_kategori','$id_type_kategori','$processor','$storage_capacity','$memory_capacity','$vga_capacity','$nomor_it','$nomor_aset','$serial_number','$storage_type','$memory_type','$vga_type','$keterangan','$operation_system','$office','$os_licence','$os','$aplikasi_lainnya')";
            $proses = mysqli_query($conn, $query);

            if($proses){
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
                   window.location.href='../add/tambah_pendataan_perangkat.php';
                </script>
              ";
            }
        }
    } else {
        // NIK not found, display notification
        echo
        "
        <script>
           alert('NIK tidak terdaftar');
           window.location.href='../add/tambah_pendataan_perangkat.php';
        </script>
      ";
    }
}
?>