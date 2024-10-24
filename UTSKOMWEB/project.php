<?php 
include 'koneksi.php'; // Memasukkan file koneksi ke database

// Query untuk mengambil data dari tabel user_project
$query = "SELECT judul, deskripsi, url_image FROM user_project";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>

<?php include 'navbar.php'; ?>

    <!-- Konten Utama -->
    <section id="Projects" class="projects">
    <div class="container">
        <h2>My <span class="highlight">Projects</span></h2>
        
        <!-- Grid Project -->
        <div class="row">

            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Logika khusus untuk tombol "View Project"
                    $viewLink = $row['url_image'];
                    if ($row['judul'] === 'Kegiatan Sosial') {
                        // Gambar ketiga menuju ke link YouTube
                        $viewLink = 'https://youtu.be/4roEa23LVTI?si=jEmOfjt5aaE8VTEX';
                    }

                    // Tampilkan project
                    echo '
                    <div class="col-md-4">
                        <div class="project-card">
                            <div class="project-image">
                                <img src="'.$row['url_image'].'" alt="'.$row['judul'].'" class="gambar-p1">
                            </div>
                            <div class="p-3">
                                <h3>'.$row['judul'].'</h3>
                                <p>'.$row['deskripsi'].'</p>
                                <a href="'.$viewLink.'" class="btn btn-primary" target="_blank">View Project</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No projects found.</p>';
            }
            ?>
            <a href="contact.php" class="btn btn-outline-primary">Get My Contact!</a>

        </div> <!-- Akhir row -->
    </div>
    </section>

   <?php include 'footer.php'; ?>
</body>
</html>
