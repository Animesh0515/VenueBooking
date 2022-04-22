<?php

// To connect to database
global $conn;
$serverName = "localhost";
    $database = "venuebooking";
    $username = "root";
    $dbpassword = "";

    // Start connection

     $conn = mysqli_connect($serverName,$username,$dbpassword,$database);
    if (!$conn) {
        // Show error here
        // echo mysqli_connect_error();
        // die("Connection failed: " . mysqli_connection_error());
         echo "Oops ! There is a problem at our end. Try again later !";
         exit();
      }
?>
