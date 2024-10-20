<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Location Map</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    /* Header Styles */
    .header {
        background-color: #f4f4f4;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 40px;
        font-weight: 600;
        color: #1aa31f;
        margin-left: 25px;
    }

    .nav-links {
        display: flex;
    }

    .nav-links a {
        margin-right: 30px;
        color: black;
        text-decoration: none;
        font-weight: 500;
        position: relative;
    }

    /* Underline Animation */
    .nav-links a:before {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        background-color: #1aa31f;
        /* Underline color */
        bottom: 0;
        left: 0;
        transition: width 0.3s ease;
        /* Transition duration and easing */
    }

    .nav-links a:hover:before {
        width: 100%;
    }

    /* Map Styles */
    #map {
        height: 575px;
        width: 75%;
        margin: 20px auto;
    }

    /* Horizontal Rule Styles */
    hr {
        height: 5px;
        background-color: green;
        border: none;
        margin: 0;
    }
    </style>
</head>
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

?>

<body>

</body>