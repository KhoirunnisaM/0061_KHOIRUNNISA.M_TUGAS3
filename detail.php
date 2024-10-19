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
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil detail user berdasarkan ID
    $sql = "SELECT * FROM tb_users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
    
    if (isset($_GET['show_image'])) {
        header("Content-type: image/jpeg");
        echo $row['foto']; 
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            position: relative;
        }
        .card {
            width: 40rem; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); 
            border-radius: 12px; 
            overflow: hidden; 
        }
        .card-title {
            text-align : center;
        }
        img {
            width: 100%;
            height: 300px; 
            object-fit: cover; 
        }
        h1 {
            position: absolute; 
            top: -20px; 
            left: 50%; 
            transform: translateX(-50%);
            font-size: 2rem; 
            color: #333; 
        }
        .btn {
            width: 100%; 
        }
    </style>
</head>

<body>
<div class="container mt-4">
<h1>Detail User</h1>
    <div class="card" style="width: 20rem;">
        <img src="detail.php?id=<?php echo $row['id']; ?>&show_image=1" class="card-img-top" alt="Foto User">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['nama']; ?></h5>
            <p class="card-text"><strong>Jenis Kelamin:</strong> <?php echo $row['jenis_kelamin']; ?></p>
            <p class="card-text"><strong>No HP:</strong> <?php echo $row['nohp']; ?></p>
            <p class="card-text"><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p class="card-text"><strong>Alamat:</strong> <?php echo $row['alamat']; ?></p>
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
