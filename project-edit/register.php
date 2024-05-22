<?php
    session_start();
    include 'Html_folder\Php_folder\connection_establishment.php';

    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username or email already exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username or email already exists
        $_SESSION['status'] = "User with this email already exists.";
        $_SESSION['alert_class'] = "alert-warning";
        header('location: index.php');
        exit; // Stop further execution
    } 
    else {
        // create table into database
        $create_sql = "CREATE TABLE IF NOT EXISTS USERS
            (S_NO INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            USERNAME VARCHAR(20) NOT NULL,
            EMAIL VARCHAR(40) NOT NULL,
            PASSWORD VARCHAR(2000) NOT NULL,
            USERTYPE VARCHAR(20) NOT NULL)";
        $stmt = $conn->prepare($create_sql);
        $stmt->execute();

        // Insert data into database
        $sql = "INSERT INTO users (username, email, password, usertype) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $usertype);
        if ($stmt->execute()) {
            $_SESSION['status'] = "Your account has been created.";
            $_SESSION['alert_class'] = "alert-success";
            header('location: index.php');
            exit; // Stop further execution
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
?>
