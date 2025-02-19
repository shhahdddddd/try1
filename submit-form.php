<?php
// DB connection (adjust the connection details)
$host = 'localhost';
$db = 'freelance';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $eventdate = $_POST['eventdate'];
    $eventtype = $_POST['eventtype'];
    $message = $_POST['message'];
    $stmt = $pdo->prepare("INSERT INTO contact_form_submissions (name, email, phone, event_date, event_type, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $eventdate, $eventtype, $message]);
    echo "Form submitted successfully!";
}
?>
