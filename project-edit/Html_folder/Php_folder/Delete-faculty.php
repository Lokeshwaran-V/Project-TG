<?php

    include 'connection_establishment.php';

    $FACULTY_ID = $_POST["FACULTY_ID"];
    $FACULTY_NAME = $_POST["FACULTY_NAME"];

    function delete_faculty($FACULTY_ID,$FACULTY_NAME){
        // SQL query to insert data into the database
        $delete_sql = "DELETE FROM FACULTY_REGISTER WHERE FACULTY_ID = '$FACULTY_ID' AND FACULTY_NAME = '$FACULTY_NAME'";
        try{
            if ($GLOBALS["conn"]->query($delete_sql) === TRUE) {
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
    delete_faculty($FACULTY_ID,$FACULTY_NAME);

?>