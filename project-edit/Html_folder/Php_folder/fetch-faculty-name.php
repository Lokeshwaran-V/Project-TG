<?php
    // include 'faculty timetable-script.js';
    // Perform database connection
    include 'connection_establishment.php';
    $sql = "SELECT FACULTY_NAME FROM FACULTY_REGISTER";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["FACULTY_NAME"] . "'>" . $row["FACULTY_NAME"] . "</option>";
        }
    }
    else {
        echo "<option>No users found</option>";
    }
?>
