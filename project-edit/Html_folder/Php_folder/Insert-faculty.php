<?php
    session_start();
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

    function create_faculty_table(){
        
        // SQL query to create table in database
        $create_faculty = "CREATE TABLE IF NOT EXISTS FACULTY_REGISTER 
        (FACULTY_ID INT(6) NOT NULL PRIMARY KEY, 
        FACULTY_NAME VARCHAR(20) NOT NULL,
        FACULTY_DEPARTMENT VARCHAR(20) NOT NULL,
        FACULTY_EMAIL VARCHAR(25) NOT NULL UNIQUE,
        FACULTY_PASSWORD VARCHAR(10),
        FACULTY_ROLE VARCHAR(20),
        FACULTY_ROLE_DESCRIPTION VARCHAR(20))";

        if ($GLOBALS["conn"]->query($create_faculty) === TRUE) {
            // echo "Table created successfully <br>";

        } else {
            echo "Error: " .$GLOBALS["conn"]->error;
        }

    }
    function insert_faculty($FACULTY_ID,$FACULTY_NAME,$FACULTY_DEPARTMENT,$FACULTY_EMAIL,$HASHED_PASSWORD,$FACULTY_ROLE,$FACULTY_ROLE_DESCRIPTION){
        
        // SQL query to insert data into the database
        $insert_sql = "INSERT INTO FACULTY_REGISTER 
        (FACULTY_ID, FACULTY_NAME, 
        FACULTY_DEPARTMENT, 
        FACULTY_EMAIL, 
        FACULTY_PASSWORD, 
        FACULTY_ROLE, 
        FACULTY_ROLE_DESCRIPTION)
        VALUES ('$FACULTY_ID', '$FACULTY_NAME', '$FACULTY_DEPARTMENT', '$FACULTY_EMAIL', '$HASHED_PASSWORD', '$FACULTY_ROLE','$FACULTY_ROLE_DESCRIPTION')";
        
        try{
            if ($GLOBALS["conn"]->query($insert_sql) === TRUE) {
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
    
    create_faculty_table();
    insert_faculty($FACULTY_ID,$FACULTY_NAME,$FACULTY_DEPARTMENT,$FACULTY_EMAIL,$HASHED_PASSWORD,$FACULTY_ROLE,$FACULTY_ROLE_DESCRIPTION);

    session_destroy();
    exit();
    
?>