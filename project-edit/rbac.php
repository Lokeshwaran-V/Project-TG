<?php
    session_start();
    global $session_url;
    include 'Html_folder\Php_folder\connection_establishment.php';
    // var_dump($_POST);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the email exists in the database
        $sql = "SELECT * FROM FACULTY_REGISTER WHERE FACULTY_EMAIL = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Email does not exist in the database
            $_SESSION['status'] = "Account does not exist. Please sign up.";
            $_SESSION['alert_class'] = "alert-warning";
            header('location: index.php');
            exit; // Stop further execution
        }

        // Retrieve the hashed password from the database
        $row = $result->fetch_assoc();
        $hashed_password = $row['FACULTY_PASSWORD'];
        $role = $row['FACULTY_ROLE'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, proceed with login
            if ($role == 'ADMIN') {
                // Redirect to admin dashboard
                $_SESSION['FACULTY_ROLE'] = $row['FACULTY_ROLE']; // Set user id in session for future use
                $session_url = $_SESSION['FACULTY_ROLE'];
                // echo $_SESSION['FACULTY_ROLE'];
                header("Location: admin-dashboard.php");
                exit();
            } elseif ($role == 'FACULTY') {
                // Redirect to faculty dashboard
                $_SESSION['FACULTY_ROLE'] = $row['FACULTY_ROLE']; // Set user id in session for future use
                // echo $_SESSION['FACULTY_ROLE'];
                header("Location: admin-dashboard.php");
                exit();
            }
        } else {
            // Password is incorrect
            $_SESSION['status'] = "Incorrect password. Please try again.";
            $_SESSION['alert_class'] = "alert-warning"; // Assuming you have this class for displaying error messages
            header('location: index.php');
            exit; // Stop further execution
        }
    }
?>