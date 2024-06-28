<?php
$servername = "localhost"; // or your database server
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "techeye"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    // Check if the input is valid
    if ($email) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO quote (email) VALUES ('$email')");

        // Execute the statement
        if ($stmt->execute()) {
            echo "Thank you! Your information has been saved.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid input. Please try again.";
    }
}

// Close the connection
$conn->close();
?>
