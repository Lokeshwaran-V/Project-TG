<?php
    // Database connection parameters
    include 'connection_establishment.php';

    // Check if file was uploaded without errors
    if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $file = $_FILES["fileToUpload"]["tmp_name"];
        
        // Read CSV file
        $handle = fopen($file, "r");
        // Skip the first row
        fgetcsv($handle);
        while(($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Prepare and bind the statement
            $stmt = $conn->prepare("INSERT INTO subject_records 
            (S_NO, FACULTY_NAME, DEPARTMENT, YEAR, SUBJECT_CODE, SUBJECT_NAME, SUBJECT_TYPE) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
            
            // Bind parameters and execute the statement for each row
            $stmt->bind_param("sssssss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
            $stmt->execute();
            
            // Close statement
            $stmt->close();
        }
        
        // Close file handle
        fclose($handle);
        
        echo "Records inserted successfully";
        echo 
        '<script type="text/javascript">',
            'window.location.href = "logout.php";',
        '</script>';
        session_destroy();
    } else {
        echo "Error uploading file";
    }

// Close connection
$conn->close();
?>
