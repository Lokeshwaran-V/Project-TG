<?php
// Database connection parameters
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if(isset($_POST["submit"])) {
    // Check if file was uploaded without errors
    if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $file = $_FILES["fileToUpload"]["tmp_name"];
        
        // Read CSV file
        $handle = fopen($file, "r");
        // Skip the first row
        fgetcsv($handle);
        while(($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Prepare and bind the statement
            $stmt = $conn->prepare("INSERT INTO your_table (firstname, lastname, email) VALUES (?, ?, ?)");
            
            // Bind parameters and execute the statement for each row
            $stmt->bind_param("sss", $data[0], $data[1], $data[2]);
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
}

// Close connection
$conn->close();
?>
