<?php
// Connection parameters
$servername = "localhost";  // If you're using XAMPP locally, 'localhost' is the server name.
$username = "root";  // Default XAMPP username
$password = "";  // Default XAMPP password is empty
$dbname = "sohani_nethmini";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (name, email, tel, function, date, stime, etime, location) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $name, $email, $tel, $function, $date, $stime, $etime, $location);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$function = $_POST['function'];
$date = $_POST['date'];
$stime = $_POST['stime'];
$etime = $_POST['etime'];
$location = $_POST['location'];

if ($stmt->execute()) {
    echo "New booking recorded successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
