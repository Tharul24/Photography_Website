<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Default is empty for XAMPP
$dbname = "sohani_nethmini";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $details = $_POST['details'];
    $payment_id = $_POST['payment_id'];

    // Handle file upload
    $target_dir = "uploads/receipt/"; // Directory to save the uploaded file
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid image or PDF
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false || $fileType == "pdf") {
        $uploadOk = 1;
    } else {
        echo "File is not an image or PDF.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "pdf") {
        echo "Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO payments (first_name, last_name, email, contact, details, payment_id, receipt_path)
                    VALUES ('$first_name', '$last_name', '$email', '$contact', '$details', '$payment_id', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded and your details have been saved.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close connection
$conn->close();
?>
