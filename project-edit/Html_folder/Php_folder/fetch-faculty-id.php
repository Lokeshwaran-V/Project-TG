<?php
    // include 'faculty timetable-script.js';
    // Perform database connection
    include 'connection_establishment.php';
    $sql = "SELECT FACULTY_ID FROM FACULTY_REGISTER";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["FACULTY_ID"] . "'>" . $row["FACULTY_ID"] . "</option>";
        }
    }
    else {
        echo "<option>No users found</option>";
    }
?>
