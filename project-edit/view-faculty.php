<?php
    // Perform database connection
    session_start();
    include 'Html_folder\Php_folder\connection_establishment.php';

    $Faculty_Id = $_POST['faculty-timetable-faculty'];
    $Department = $_POST['faculty-timetable-department'];
    $Year = $_POST['faculty-timetable-year'];

    function sql($Department, $Year){
        global $conn; // Use global to access $conn inside the function

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT FACULTY_ID, SUBJECT_NAME FROM SUBJECT_RECORDS WHERE FACULTY_DEPARTMENT=? AND YEAR=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $Department, $Year);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>SUBJECT CODE</th><th>SUBJECT NAME</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["SUBJECT_CODE"] . "</td><td>" . $row["SUBJECT_NAME"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        // Close statement
        $stmt->close();
    }

    sql($Department, $Year);
?>
