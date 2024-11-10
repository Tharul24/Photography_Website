<?php
session_start(); // Start the session

// Replace these variables with your actual database credentials
$servername = "localhost";  // Database server
$dbUsername = "root";       // Database username
$dbPassword = "";           // Database password
$dbName = "sohani_nethmini";  // Database name

// Create a connection to the database
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    // Check if the username exists
    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($id, $username, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set the session variables
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_username'] = $username;

            // Redirect to the admin dashboard or home page
            header("Location: adminpanel/uploadimage.html");
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password.";
        }
    } else {
        // Username does not exist
        echo "Username not found.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
