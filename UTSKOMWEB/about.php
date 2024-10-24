<?php // Query untuk mengambil data dari tabel user_about
include 'koneksi.php'; 
// Query untuk mengambil data dari tabel user_about
$sql = "SELECT deskripsi, profil_image FROM user_about WHERE id = 1";
$result = $conn->query($sql);

// Memeriksa apakah ada hasil
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Mengambil data hasil query
    $deskripsi = $row['deskripsi'];
    $profil_image = $row['profil_image'];
} else {
    // Jika tidak ada data, berikan nilai default
    $deskripsi = 'Deskripsi tidak ditemukan.';
    $profil_image = 'default_image.jpg';
}

$conn->close(); // Menutup koneksi


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferdinan - About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>

    <main>
        <section id="About" class="about">
            <div class="container">
                <h2>About <span class="highlight">Me</span></h2>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="profile-image">
                            <img src="<?php echo $profil_image; ?>" alt="Your Image" class="round-image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <p><?php echo $deskripsi; ?></p>
                        <a href="skills.php" class="btn btn-primary">My Skills</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
    <div class="container">
        <ul class="reserved-colors">
        <p>&copy; 2024 Ferdinan | All Rights Reserved </p> 
        </ul>
    </div>
</footer>
</body>
</html>