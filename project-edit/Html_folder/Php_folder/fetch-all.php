<?php
    
    include 'Html_folder/Php_folder/connection_establishment.php';
    $sql = "SELECT * FROM SUBJECT_RECORDS";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    function subject_code(){
        if ($GLOBALS['result']->num_rows > 0) {
            while($row = $GLOBALS['result']->fetch_assoc()) {
                echo "<option value='" . $row["SUBJECT_CODE"] . "'>" . $row["SUBJECT_CODE"] . "</option>";                
            }
        }
        else {
            echo "<option>No users found</option>";
        }

    }
    function subject_name(){
        if ($GLOBALS['result']->num_rows > 0) {
            while($row = $GLOBALS['result']->fetch_assoc()) {
                echo "<option value='" . $row["SUBJECT_NAME"] . "'>" . $row["SUBJECT_NAME"] . "</option>";
                
            }
        }
        else {
            echo "<option>No users found</option>";
        }
        
    }

    // if ($result->num_rows > 0) {
    //     while($row = $result->fetch_assoc()) {
    //         echo "<option value='" . $row["SUBJECT_CODE"] . "'>" . $row["SUBJECT_CODE"] . "</option>";
    //         echo "<option value='" . $row["SUBJECT_NAME"] . "'>" . $row["SUBJECT_NAME"] . "</option>";
            
    //     }
    // }
    // else {
    //     echo "<option>No users found</option>";
    // }
?>
