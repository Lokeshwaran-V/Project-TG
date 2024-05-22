<?php

    include 'connection_establishment.php';
    // Retrieve form data
    $Faculty_Name = $_POST['Faculty_Name'];
    $DEPARTMENT = $_POST['DEPARTMENT'];
    $YEAR = $_POST['YEAR'];
    $SUBJECT_CODE = $_POST["SUBJECT_CODE"];
    $SUBJECT_NAME = $_POST["SUBJECT_NAME"];
    $SUBJECT_TYPE = $_POST["SUBJECT_TYPE"];
    
    function create_subject(){
        $create_sql = "CREATE TABLE IF NOT EXISTS SUBJECT_RECORDS 
        (FACULTY_NAME VARCHAR(20) NOT NULL,
        DEPARTMENT VARCHAR(20) NOT NULL,
        YEAR INT(5) NOT NULL,
        SUBJECT_CODE VARCHAR(7) NOT NULL PRIMARY KEY, 
        SUBJECT_NAME VARCHAR(20) NOT NULL,
        SUBJECT_TYPE VARCHAR(20) NOT NULL)";

        if ($GLOBALS["conn"]->query($create_sql) === TRUE) {
            echo "Table created successfully <br>";
        } else {
            echo "Error: " .$GLOBALS["conn"]->error;
        }
    }
    function insert_subject($Faculty_Name,$DEPARTMENT,$YEAR,$SUBJECT_CODE,$SUBJECT_NAME,$SUBJECT_TYPE){
        // SQL query to insert data into the database
        $insert_sql = "INSERT INTO SUBJECT_RECORDS 
        (Faculty_Name,DEPARTMENT,YEAR,SUBJECT_CODE,SUBJECT_NAME,SUBJECT_TYPE)
        VALUES ('$Faculty_Name','$DEPARTMENT','$YEAR','$SUBJECT_CODE', '$SUBJECT_NAME', '$SUBJECT_TYPE')";

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
    create_subject();
    insert_subject($Faculty_Name,$DEPARTMENT,$YEAR,$SUBJECT_CODE,$SUBJECT_NAME,$SUBJECT_TYPE);

?>