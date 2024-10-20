<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Coordinates History</title>
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
        table {
            width: 75%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            color:#1aa31f;
            background-color: #f4f4f4;
        }
        /* Add your existing styles here */
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
    <!-- Header Section -->
    <div class="header">
        <div class="logo">Child Safety - Parent Dashboard</div>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="history2.php">History</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <hr>

    <?php
    $sql = "SELECT datetime, ST_X(location) as 'lat' ,ST_Y(location) as 'long' FROM pin ORDER BY datetime DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data in a table format
        echo "<table border='1'>";
        echo "<tr><th>Date and Time</th><th>Latitude</th><th>Longitude</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["datetime"] . "</td>";
            echo "<td>" . $row["lat"] . "</td>";
            echo "<td>" . $row["long"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No data found in the table.";
    }
    ?>
</body>

</html>
