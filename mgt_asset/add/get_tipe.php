<?php
include '../koneksi.php'; // Pastikan path ke koneksi benar

header('Content-Type: application/json');

if (isset($_GET['kategori_id'])) {
    $kategori_id = $_GET['kategori_id'];

    // Debugging: Tampilkan kategori_id
    error_log("Kategori ID: $kategori_id");

    $sql = "SELECT id_type_kategori, nama_type FROM type_kategori INNER JOIN kategori ON type_kategori.id_kategori = kategori.id_kategori WHERE kategori.id_kategori = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $kategori_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $tipe = array();
    while ($row = $result->fetch_assoc()) {
        $tipe[] = $row;
    }

    // Debugging: Tampilkan data yang dikirim
    error_log("Data: " . json_encode($tipe));
    echo json_encode($tipe);
} else {
    echo json_encode([]);
}
?>
