<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_php";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil id
$id = $_GET['id'];

// Menghapus data dari tabel berdasarkan ID
$sql = "DELETE FROM tb_users WHERE id = $id";

//Setelah data dihapus akan ke halaman utama
if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); 
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>