<?php 
// Koneksi ke database
$host = 'localhost'; 
$dbname = 'db_php'; 
$username = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cek apakah form sudah disubmit 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!empty($_POST['nama']) && !empty($_POST['alamat']) && !empty($_POST['nohp']) && !empty($_POST['email']) && !empty($_POST['jenis_kelamin']) && !empty($_FILES['foto']['tmp_name'])) {
            // Ambil data dari form
            $nama = htmlspecialchars($_POST['nama']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $nohp = htmlspecialchars($_POST['nohp']);
            $email = htmlspecialchars($_POST['email']);
            //validasi jenis kelamin
            $jenis_kelamin = $_POST['jenis_kelamin'];
            if ($jenis_kelamin !== 'Laki-laki' && $jenis_kelamin !== 'Perempuan') {
                die('Jenis kelamin tidak valid.');
            }
            // Ambil data foto
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
            // memasukkan data ke dalam tabel tb_users
            $sql = "INSERT INTO tb_users (nama, alamat, nohp, email, jenis_kelamin, foto) 
                    VALUES (:nama, :alamat, :nohp, :email, :jenis_kelamin, :foto)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':nohp', $nohp);
			$stmt->bindParam(':foto', $foto, PDO::PARAM_LOB); 
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
            
            if ($stmt->execute()) {
                // setelah data berhasil disimpan
                header("Location: index.php?status=success");
                exit();
            } else {
                echo "Gagal menyimpan data.";
            }
        } else {
            echo "Semua kolom wajib diisi!";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
