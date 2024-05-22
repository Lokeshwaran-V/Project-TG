<?php
    // Perform database connection
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "123456789";
    $db_name = "FacultyRegisterDB";

    // Create connection
    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name );

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>