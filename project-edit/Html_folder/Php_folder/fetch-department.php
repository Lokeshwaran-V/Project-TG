<?php
    // Perform database connection
    include 'connection_establishment.php';
    
    $sql = "SELECT DISTINCT DEPARTMENT FROM SUBJECT_RECORDS";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["DEPARTMENT"] . "'>" . $row["DEPARTMENT"] . "</option>";
        }
    }
    else {
        echo "<option>No users found</option>";
    }
?>
