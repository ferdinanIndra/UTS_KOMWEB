<?php
// Hubungkan dengan file koneksi
include 'koneksi.php';

// Query untuk mengambil data dari tabel user_about
$sql = "SELECT nama, deskripsi, profil_image, link_github, link_instagram, link_facebook FROM user_info WHERE id = 1";
$result = $conn->query($sql);

// Memeriksa apakah ada hasil
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Mengambil data hasil query
} else {
    // Jika tidak ada data, berikan nilai default
    $row = [
        'nama' => 'Unknown',
        'deskripsi' => 'No description available.',
        'profil_image' => 'default_image.jpg',
        'link_github' => '#',
        'link_instagram' => '#',
        'link_facebook' => '#'
    ];
}

$conn->close(); // Menutup koneksi
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferdinan - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>

<main>
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Menampilkan data dari database -->
                    <h1>Hi, It's <span class="highlight"><?php echo $row['nama']; ?></span></h1>
                    <h2>I'm <span class="highlight">Student at Pembangunan Jaya University</span></h2>
                    <p><?php echo $row['deskripsi']; ?></p>

                    <div class="social-icons">
                        <a href="<?php echo $row['link_github']; ?>" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="<?php echo $row['link_instagram']; ?>" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="<?php echo $row['link_facebook']; ?>" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>

                    <div class="cta-buttons">
                        <a href="about.php" class="btn btn-primary">More About Me</a>
                        <a href="contact.php" class="btn btn-outline-primary">Contact</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="profile-image">
                        <img src="<?php echo $row['profil_image']; ?>" alt="Profile Image" class="round-image" width="400">
                    </div>
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
