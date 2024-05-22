<?php
    
    include 'connection_establishment.php';

    // Retrieve form data
    $ROOM_NO = $_POST["ROOM_NO"];
    $ROOM_NAME = $_POST["ROOM_NAME"];
    $ROOM_DEPARTMENT = $_POST["ROOM_DEPARTMENT"];

    function create_room(){
        $create_sql = "CREATE TABLE IF NOT EXISTS ROOMS
        (ROOM_NO INT(5) NOT NULL PRIMARY KEY,
        ROOM_NAME VARCHAR(20) NOT NULL,
        ROOM_DEPARTMENT VARCHAR(20) NOT NULL)";
    

        // Execute the query
        if ($GLOBALS["conn"]->query($create_sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error: " . $GLOBALS['conn']->error;
        }
    }
    function insert_room($ROOM_NO,$ROOM_NAME,$ROOM_DEPARTMENT){
        $insert_sql = "INSERT INTO ROOMS (ROOM_NO, ROOM_NAME, ROOM_DEPARTMENT) VALUES ('$ROOM_NO', '$ROOM_NAME', '$ROOM_DEPARTMENT')";
    

        // Execute the query
        if ($GLOBALS["conn"]->query($insert_sql) === TRUE) {
            echo "New record inserted successfully";
        } else {
            echo "Error: ". $GLOBALS['conn']->error;
        }
    }
    create_room();
    insert_room($ROOM_NO,$ROOM_NAME,$ROOM_DEPARTMENT);
    echo '<script type="text/javascript">',
     'window.localStorage.clear();',
     'window.location.reload(true);',
     'window.location.replace("../../admin-dashboard.php");',
     '</script>';
     
    // Close the database connection
    $conn->close();
?>
