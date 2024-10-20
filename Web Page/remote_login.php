<?php
// Replace with your database credentials
$dbHost = "13.235.42.204";
$dbUser = "raspberry";
$dbPass = "SourceKode@1234";
$dbName = "SourceKode";

// Connect to the database
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    // User is already logged in, redirect to the dashboard
    header("Location: dashboard.php");
    exit();
}
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform validation against the database
    $query = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Valid credentials, redirect to the dashboard
        header("Location: settings.html");
        exit();
    } else {
        echo "Invalid username or password. Please try again.";
    }
}

// Close the database connection
$conn->close();
