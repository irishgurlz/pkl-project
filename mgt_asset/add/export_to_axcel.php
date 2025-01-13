<?php
// Include the database connection file
include '../koneksi.php';

// Define the filename for the Excel file
$filename = "detail_employe_" . date("Y-m-d") . ".xls";

// Define the SQL query to retrieve the data
$sql = "SELECT d.*, k.kategori,
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
        INNER JOIN type_kategori ON d.id_type_kategori = type_kategori.id_type_kategori";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Define the header for the Excel file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

// Start the Excel file
echo "Nomor IT\t";
echo "Employe Name\t";
echo "Employe NIK\t";
echo "Employe Org\t";
echo "Lokasi\t";
echo "Kategori\t";
echo "Tipe\t";
echo "Processor\t";
echo "Storage Capacity\t";
echo "Memory Capacity\t";
echo "VGA Capacity\t";
echo "Nomor Aset\t";
echo "Serial Number\t";
echo "Storage Type\t";
echo "Memory Type\t";
echo "VGA Type\t";
echo "Operation System\t";
echo "Office\t";
echo "OS License\t";
echo "OS License\t";
echo "Aplikasi Lainnya\t";
echo "Keterangan Tambahan\t";
echo "\n";

// Loop through the data and write it to the Excel file
while ($row = mysqli_fetch_assoc($result)) {
    echo $row["nomor_it"] . "\t";
    echo $row["employe_name"] . "\t";
    echo $row["employe_nik"] . "\t";
    echo $row["c_org"] . "\t";
    echo $row["lokasi"] . "\t";
    echo $row["kategori"] . "\t";
    echo $row["id_type_kategori"] . "\t";
    echo $row["processor"] . "\t";
    echo $row["storage_capacity"] . "\t";
    echo $row["memory_capacity"] . "\t";
    echo $row["vga_capacity"] . "\t";
    echo $row["nomor_aset"] . "\t";
    echo $row["serial_number"] . "\t";
    echo $row["storage_type"] . "\t";
    echo $row["memory_type"] . "\t";
    echo $row["vga_type"] . "\t";
    echo $row["operation_system"] . "\t";
    echo $row["office"] . "\t";
    echo $row["os_licence"] . "\t";
    echo $row["os"] . "\t";
    echo $row["aplikasi_lainnya"] . "\t";
    echo $row["keterangan"] . "\t";
    echo "\n";
}

// Close the database connection
mysqli_close($conn);
?>