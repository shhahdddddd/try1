<?php
// DB connection
$host = 'localhost';
$db = 'freelance';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch contact form submissions
$stmt = $pdo->query("SELECT * FROM contact_form_submissions ORDER BY submission_date DESC");
$contactSubmissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch career applications
$stmtCareer = $pdo->query("SELECT * FROM career ");
$careerApplications = $stmtCareer->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Header */
        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        /* Section */
        section {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="admin.php">View Submissions</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>Contact Form Submissions</h2>
        <?php if (count($contactSubmissions) > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Event Date</th>
                    <th>Event Type</th>
                    <th>Message</th>
                    <th>Submission Date</th>
                </tr>
                <?php foreach ($contactSubmissions as $submission): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($submission['id']); ?></td>
                        <td><?php echo htmlspecialchars($submission['name']); ?></td>
                        <td><?php echo htmlspecialchars($submission['email']); ?></td>
                        <td><?php echo htmlspecialchars($submission['phone']); ?></td>
                        <td><?php echo htmlspecialchars($submission['event_date']); ?></td>
                        <td><?php echo htmlspecialchars($submission['event_type']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($submission['message'])); ?></td>
                        <td><?php echo htmlspecialchars($submission['submission_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No contact form submissions yet.</p>
        <?php endif; ?>
    </section>

    <section>
        <h2>Career Applications</h2>
        <?php if (count($careerApplications) > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Application Date</th>
                </tr>
                <?php foreach ($careerApplications as $application): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($application['id']); ?></td>
                        <td><?php echo htmlspecialchars($application['position']); ?></td>
                        <td><?php echo htmlspecialchars($application['name']); ?></td>
                        <td><?php echo htmlspecialchars($application['age']); ?></td>
                        <td><?php echo htmlspecialchars($application['email']); ?></td>
                        <td><?php echo htmlspecialchars($application['application_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No career applications yet.</p>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2025 Riyaz Events. All rights reserved.</p>
    </footer>
</body>
</html>
