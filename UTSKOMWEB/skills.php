<?php 
include 'koneksi.php';
// Query untuk mengambil data dari tabel skills
$sql = "SELECT nama_skills, deskripsi FROM user_skills";
$result = $conn->query($sql);

// Inisialisasi array untuk menyimpan data skills
$skills = [];

if ($result && $result->num_rows > 0) {
    // Loop untuk memasukkan data ke dalam array skills
    while ($row = $result->fetch_assoc()) {
        $skills[] = $row;
    }
} else {
    // Jika tidak ada data, berikan nilai kosong ke array skills
    $skills = [];
}

$conn->close(); // Menutup koneksi
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferdinan - Skills</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>

<main>
    <section id="Skill" class="skills">
        <div class="container">
            <h2>My <span class="highlight">Skills</span></h2>
            <div class="row">
                <?php
                if (!empty($skills)) {
                    foreach ($skills as $skill) {
                        echo '<div class="col-md-4">
                                <div class="skill-card">
                                    <h3>' . $skill['nama_skills'] . '</h3>
                                    <p>' . $skill['deskripsi'] . '</p>
                                </div>
                              </div>';
                    }
                } else {
                    echo '<p>No skills found.</p>';
                }
                ?>
                <a href="project.php" class="btn btn-outline-primary">See my Project</a>
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