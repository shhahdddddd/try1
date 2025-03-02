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

// Check if career table exists and create it if it doesn't
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
        applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
}

// Check if contact_form_submissions table exists and create it if it doesn't
try {
    // Check if contact_form_submissions table exists
    $pdo->query("SELECT 1 FROM contact_form_submissions LIMIT 1");
} catch(PDOException $e) {
    $pdo->exec("CREATE TABLE contact_form_submissions (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        eventdate DATE NOT NULL,
        eventtype VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
}

// Process form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
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

            // Insert into career table
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

        if (isset($_POST['name']) && isset($_POST['email'])) {
            // Contact form submission
            $contact_name = $_POST['name'];
            $contact_email = $_POST['email'];
            $contact_phone = $_POST['phone'];
            $contact_eventdate = $_POST['eventdate'];
            $contact_eventtype = $_POST['eventtype'];
            $contact_message = $_POST['message'];

            // Validate email format
            if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
                die("<script>alert('Invalid email format!'); window.location.href=document.referrer;</script>");
            }

            // Insert into contact_form_submissions table
            $stmt = $pdo->prepare("INSERT INTO contact_form_submissions (name, email, phone, event_date, event_type, message) VALUES (?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([$contact_name, $contact_email, $contact_phone, $contact_eventdate, $contact_eventtype, $contact_message]);

            if ($result) {
                echo "<script>alert('Message submitted successfully!'); window.location.href='thank_you.php';</script>";
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

?>
