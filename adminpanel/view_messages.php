<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contact Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #e91e63;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .no-messages {
            text-align: center;
            color: #e91e63;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Contact Messages</h1>
    <?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = ""; // Default password for XAMPP
    $dbname = "sohani_nethmini";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch messages from the contacts table
    $sql = "SELECT id, name, email, subject, message, created_at FROM contacts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        echo "Error: " . $conn->error;
    } else if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th></tr>';

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['subject']) . '</td>';
            echo '<td>' . htmlspecialchars($row['message']) . '</td>';
            echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p class="no-messages">No messages found.</p>';
    }

    // Close connection
    $conn->close();
    ?>
</div>

</body>
</html>
