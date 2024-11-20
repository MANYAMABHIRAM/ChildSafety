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
    <!-- Header Section -->
    <div class="header">
        <div class="logo">Child Safety - Parent Dashboard</div>
        <div class="nav-links">
            <a href="#">Dashboard</a>
            <a href="history2.php">History</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <hr>

    <?php
    $sql = "SELECT datetime, ST_X(location) as 'lat' ,ST_Y(location) as 'long' from pin order by datetime desc limit 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dt = $row["datetime"];
        $long = $row["long"];
        $lat = $row["lat"];
        $long = (float)$long;
        $lat = (float)$lat;
        echo "<script>var locationData = " . json_encode(["latitude" => $lat, "longitude" => $long]) . ";</script>";
    } else {
        echo "Error retrieveing information";
    }
    ?>
    <div id="map"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqHW3QmMMYPOP6uR5MMFvQQoIB3OkdhnE&callback=initMap" async defer></script>
    <!-- Google Maps API Script -->

    <script>
        function initMap() {
            // latitude = parseFloat(locationData.latitude);
            // longitude = parseFloat(longitude);
            console.log(typeof locationData.latitude);
            console.log(locationData.latitude);
            console.log(locationData.longitude);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: locationData.latitude,
                    lng: locationData.longitude
                }, // R.V.R & J.C College of Engineering, Guntur
                zoom: 15
            });

            var marker = new google.maps.Marker({
                map: map
            });

            // Update the marker position periodically (every 5 seconds in this example)
            setInterval(updateMarkerPosition, 5000);

            function updateMarkerPosition() {
                // Simulate live location by adding a small random offset to the coordinates
                var offset = 0.0001;
                var currentLocation = {
                    lat: map.center.lat() + offset,
                    lng: map.center.lng() + offset
                };

                // Update the marker position
                marker.setPosition(currentLocation);

                // Center the map on the updated location
                map.setCenter(currentLocation);
            }
        }
    </script>


</body>

</html>
