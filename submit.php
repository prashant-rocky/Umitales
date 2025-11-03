<?php
// Database connection details
$servername = "localhost";
$username = "root";       // change if you use another DB user
$password = "";           // change if your MySQL has a password
$dbname = "umitales";   // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Prepare SQL statement
    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        // Redirect to thank-you page after successful insert
        header("Location: thankyou.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>