<?php
    // Perform database connection
    include 'connection_establishment.php';
    $sql = "SELECT SUBJECT_CODE FROM SUBJECT_RECORDS";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["SUBJECT_CODE"] . "'>" . $row["SUBJECT_CODE"] . "</option>";
        }
    }
    else {
        echo "<option>No users found</option>";
    }
?>
