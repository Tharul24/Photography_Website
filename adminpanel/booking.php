<?php
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['e-mail'];
    $tel = $_POST['tel'];
    $jtype = $_POST['jtype'];
    $date = $_POST['date'];
    $stime = $_POST['stime'];
    $package = $_POST['selPackage'];
    $location = $_POST['location'];

    // SQL query to insert data into the enquiries table
    $sql = "INSERT INTO enquiries (name, email, contact, job_type, date, time, package, location) 
            VALUES ('$name', '$email', '$tel', '$jtype', '$date', '$stime', '$package', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "Enquiry submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
