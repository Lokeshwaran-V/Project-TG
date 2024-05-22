<?php

    include 'connection_establishment.php';
    // Retrieve form data
    $Faculty_Name = $_POST['Faculty_Name'];
    $DEPARTMENT = $_POST['DEPARTMENT'];
    $YEAR = $_POST['YEAR'];
    $SUBJECT_CODE = $_POST["SUBJECT_CODE"];
    $SUBJECT_NAME = $_POST["SUBJECT_NAME"];
    $SUBJECT_TYPE = $_POST["SUBJECT_TYPE"];
    
    function update_subject($Faculty_Name,$DEPARTMENT,$YEAR,$SUBJECT_CODE,$SUBJECT_NAME,$SUBJECT_TYPE){
        
        // SQL query to update data into the database
        $update_sql = "UPDATE SUBJECT_RECORDS SET 
        FACULTY_NAME = '$Faculty_Name',
        DEPARTMENT = '$DEPARTMENT',
        YEAR = '$YEAR',
        SUBJECT_CODE = '$SUBJECT_CODE',
        SUBJECT_NAME = '$SUBJECT_NAME',
        SUBJECT_TYPE = '$SUBJECT_TYPE'
        WHERE SUBJECT_CODE = '$SUBJECT_CODE'";

        try{
            if ($GLOBALS["conn"]->query($update_sql) === TRUE) {
                echo "Record inserted successfully";
                echo 
                '<script type="text/javascript">',
                    'window.location.href = "logout.php";',
                '</script>';
                session_destroy();
            }
        }
        catch(mysqli_sql_exception){
            echo "Error: " .$GLOBALS["conn"]->error;       
        }
    }
    update_subject($Faculty_Name,$DEPARTMENT,$YEAR,$SUBJECT_CODE,$SUBJECT_NAME,$SUBJECT_TYPE);
?>