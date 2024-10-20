<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $radius = $_POST['radius'];
    
    $query = "INSERT INTO absoluteLoc VALUES(POINT($lat, $lng), $radius);";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Valid credentials, redirect to the dashboard
        header("Location: settings.html");
        exit();
    } else {
        echo "Query failed.";
    }
    
} 
?>
