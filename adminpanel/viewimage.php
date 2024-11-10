<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
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

        .image-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .image-grid .image-container {
            width: 23%;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .image-grid img {
            width: 100%;
            height: auto;
            display: block;
        }

        .image-container h4 {
            text-align: center;
            padding: 10px 0;
            margin: 0;
            background-color: #e91e63;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Uploaded Images</h1>
    <div class="image-grid">
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

        // Fetch images from database
        $sql = "SELECT image_path, image_type FROM images";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="image-container">';
                echo '<img src="' . $row['image_path'] . '" alt="' . $row['image_type'] . '">';
                echo '<h4>' . $row['image_type'] . '</h4>';
                echo '</div>';
            }
        } else {
            echo '<p>No images found.</p>';
        }

        // Close connection
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>
