<?php
    // Perform database connection
    session_start();
    include 'Html_folder\Php_folder\connection_establishment.php';

    $Department = $_POST['subjects_department'];
    $Year = $_POST['subjects_year'];

    function sql($Department, $Year){
        global $conn; // Use global to access $conn inside the function

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM SUBJECT_RECORDS WHERE DEPARTMENT=? AND YEAR=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $Department, $Year);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            echo "<table style='border-collapse: collapse; width: 100%; border: 1px solid #ddd'>";
            echo "
            <style>
                .table-header {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                    background-color: #f2f2f2;
                }
            </style>";

            echo "<tr>
            <th class='table-header'>S.NO</th>
            <th class='table-header'>FACULTY_NAME</th>
            <th class='table-header'>DEPARTMENT</th>
            <th class='table-header'>YEAR</th>
            <th class='table-header'>SUBJECT_CODE</th>
            <th class='table-header'>SUBJECT_NAME</th>
            <th class='table-header'>SUBJECT_TYPE</th>            
            </tr>";

            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td style='border: 1px solid #ddd; padding: 8px;'>" . $row["S_NO"] .
                "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["FACULTY_NAME"] . 
                "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["DEPARTMENT"] . 
                "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["YEAR"] . 
                "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["SUBJECT_CODE"] . 
                "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["SUBJECT_NAME"] . 
                "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["SUBJECT_TYPE"] . 
                "</td></tr>";
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
