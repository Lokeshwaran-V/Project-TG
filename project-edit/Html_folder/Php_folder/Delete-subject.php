<?php
    include 'connection_establishment.php';

    $SUBJECT_CODE = $_POST["SUBJECT_CODE"];
    $SUBJECT_NAME = $_POST["SUBJECT_NAME"];

    function delete_subject($SUBJECT_CODE,$SUBJECT_NAME){
        // SQL query to insert data into the database
        $delete_sql = "DELETE FROM SUBJECT_RECORDS WHERE SUBJECT_CODE = '$SUBJECT_CODE' AND SUBJECT_NAME = '$SUBJECT_NAME'";
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
    delete_subject($SUBJECT_CODE,$SUBJECT_NAME);

?>