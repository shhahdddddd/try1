<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
try {
    $host = 'localhost';
    $db = 'freelance';
    $user = 'root';
    $pass = '';
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if tables exist and create them if they don't
try {
    // Check if career table exists
    $pdo->query("SELECT 1 FROM career LIMIT 1");
} catch(PDOException $e) {
    $pdo->exec("CREATE TABLE career (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        position VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        age INT(11) NOT NULL,
        email VARCHAR(255) NOT NULL,
    )");
}

// Process form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Debugging: Check if data is received
        if (empty($_POST)) {
            die("<script>alert('No data received!'); window.location.href=document.referrer;</script>");
        }

        if (isset($_POST['position'])) {
            // Career form submission
            $position = $_POST['position'];
            $name = $_POST['name'];
            $age = intval($_POST['age']); // Ensure age is an integer
            $email = $_POST['email'];

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("<script>alert('Invalid email format!'); window.location.href=document.referrer;</script>");
            }

            $stmt = $pdo->prepare("INSERT INTO career (position, name, age, email) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute([$position, $name, $age, $email]);

            if ($result) {
                echo "<script>alert('Application submitted successfully!'); window.location.href=document.referrer;</script>";
            } else {
                $errorInfo = $stmt->errorInfo();
                die("<script>alert('Error: " . addslashes($errorInfo[2]) . "'); window.location.href=document.referrer;</script>");
            }
            exit;
        }

    } catch(PDOException $e) {
        echo "<script>alert('Database error: " . addslashes($e->getMessage()) . "'); window.location.href=document.referrer;</script>";
        exit;
    }
}

// Redirect if accessed without a POST request
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('Location: index.html');
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
exit;
?>
