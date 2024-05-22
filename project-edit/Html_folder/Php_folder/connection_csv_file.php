<?php
    // Database connection parameters
    include 'connection_establishment.php';

    // Hash password function
    function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Check if file was uploaded without errors
    if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $file = $_FILES["fileToUpload"]["tmp_name"];
        
        // Read CSV file
        $handle = fopen($file, "r");
        // Skip the first row
        fgetcsv($handle);
        while(($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Hash the password
            $hashedPassword = hashPassword($data[4]);

            // Prepare and bind the statement
            $stmt = $conn->prepare("INSERT INTO faculty_register 
            (FACULTY_ID, FACULTY_NAME, FACULTY_DEPARTMENT, FACULTY_EMAIL, FACULTY_PASSWORD, FACULTY_ROLE, FACULTY_DESCRIPTION) 
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
    } else {
        echo "Error uploading file";
    }

// Close connection
$conn->close();
?>
