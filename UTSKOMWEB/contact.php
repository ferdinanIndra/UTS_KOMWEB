<?php
// Pastikan error reporting aktif
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php'; // Koneksi ke database

$success = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['konfirm'])) {
    try {
        // Basic validation
        if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
            throw new Exception("All fields are required!");
        }

        // Validate email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format!");
        }

        // Sanitize inputs
        $name = htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8');
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

        // Insert query to save data into 'user_contact' table
        $query = "INSERT INTO user_contact (nama, email, subject, message) VALUES (?, ?, ?, ?)";

        // Prepare statement with error checking
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        // Bind parameters with error checking
        if (!$stmt->bind_param("ssss", $name, $email, $subject, $message)) {
            throw new Exception("Binding parameters failed: " . $stmt->error);
        }

        // Execute with error checking
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $success = "Message sent successfully!";
        $stmt->close();

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferdinan - Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        body {
            background-color: #f8f9fa;
            color: #212529;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 1000px;
        }
        .contact-card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }
        .contact-header {
            background-color: #4a3b7f;
            color: #ffffff;
            padding: 2rem;
        }
        .contact-body {
            padding: 2rem;
        }
        h1 {
            font-weight: 700;
            margin-bottom: 0;
        }
        .custom-input {
            border: none;
            border-bottom: 2px solid #e9ecef;
            border-radius: 0;
            padding: 0.75rem 0;
            transition: all 0.3s ease;
        }
        .custom-input:focus {
            box-shadow: none;
            border-color: #4a3b7f;
        }
        .custom-button {
            background-color: #4a3b7f;
            border: none;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .custom-button:hover {
            background-color: #3a2e63;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(74, 59, 127, 0.4);
        }
        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .contact-icon {
            width: 40px;
            height: 40px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }
        .contact-icon svg {
            width: 20px;
            height: 20px;
            fill: #4a3b7f;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="home.php">Ferdinan Portofolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="about.php"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="skills.php">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="project.php">Project</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>


    <div class="container my-5">
        <div class="contact-card">
            <div class="contact-header">
                <h1 class="text-center">Get in Touch</h1>
            </div>
            <div class="contact-body">
                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h2 class="h4 mb-4">Contact Information</h2>
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                            </div>
                            <span>+62 83893671206</span>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                            </div>
                            <span>ferdinan547002@gmail.com</span>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            </div>
                            <span>Tangerang Selatan, Indonesia</span>
                        </div>
                        <p class="mt-4">I'm always excited to connect with fellow developers, potential clients, or anyone interested in web development. Feel free to reach out!</p>
                    </div>
                    <div class="col-md-6">
                        <h2 class="h4 mb-4">Send a Message</h2>
                        <form action="contact.php" method="POST">
    <div class="mb-3">
        <input type="text" class="form-control custom-input" name="nama" placeholder="Your Name" required>
    </div>
    <div class="mb-3">
        <input type="email" class="form-control custom-input" name="email" placeholder="Your Email" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control custom-input" name="subject" placeholder="Subject" required>
    </div>
    <div class="mb-3">
        <textarea class="form-control custom-input" name="message" rows="4" placeholder="Your Message" required></textarea>
    </div>
    <button type="submit" name="konfirm" class="btn custom-button text-white">Send Message</button>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <footer>
    <div class="container">
        <ul class="reserved-colors">
        <p>&copy; 2024 Ferdinan | All Rights Reserved </p> 
        </ul>
    </div>
</footer>
</body>
</html>