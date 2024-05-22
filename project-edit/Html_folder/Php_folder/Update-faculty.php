<?php

    include 'connection_establishment.php';
    // Retrieve form data
    $FACULTY_ID = $_POST["FACULTY_ID"];
    $FACULTY_NAME = $_POST["FACULTY_NAME"];
    $FACULTY_DEPARTMENT = $_POST["FACULTY_DEPARTMENT"];
    $FACULTY_EMAIL = $_POST["FACULTY_EMAIL"];
    $FACULTY_PASSWORD = $_POST["FACULTY_PASSWORD"];
    $FACULTY_ROLE = $_POST["FACULTY_ROLE"];
    $FACULTY_ROLE_DESCRIPTION = $_POST["FACULTY_ROLE_DESCRIPTION"];

    // Hash the password
    $HASHED_PASSWORD = password_hash($FACULTY_PASSWORD, PASSWORD_DEFAULT);
    
    function update_faculty($FACULTY_ID,$FACULTY_NAME,$FACULTY_DEPARTMENT,$FACULTY_EMAIL,$HASHED_PASSWORD,$FACULTY_ROLE,$FACULTY_ROLE_DESCRIPTION){
        
        // SQL query to update data into the database
        $update_sql = "UPDATE FACULTY_REGISTER SET 
        FACULTY_ID = '$FACULTY_ID',
        FACULTY_NAME = '$FACULTY_NAME',
        FACULTY_DEPARTMENT = '$FACULTY_DEPARTMENT',
        FACULTY_EMAIL = '$FACULTY_EMAIL',
        FACULTY_PASSWORD = '$HASHED_PASSWORD',
        FACULTY_ROLE = '$FACULTY_ROLE',
        FACULTY_ROLE_DESCRIPTION = '$FACULTY_ROLE_DESCRIPTION'
        WHERE FACULTY_ID = '$FACULTY_ID'";
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
    update_faculty($FACULTY_ID,$FACULTY_NAME,$FACULTY_DEPARTMENT,$FACULTY_EMAIL,$HASHED_PASSWORD,$FACULTY_ROLE,$FACULTY_ROLE_DESCRIPTION);
     
?>