<?php
session_start();
include 'Html_folder\Php_folder\connection_establishment.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form | Time Table Generator</title>
  <!-- Custom CSS File -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <?php
        if(isset($_SESSION['status'])) {
            $alert_class = $_SESSION['alert_class'];
            $status_message = $_SESSION['status'];
    ?>
            <div class="alert <?php echo $alert_class; ?> alert-dismissible fade show" role="alert">
                <strong><?php echo $status_message; ?></strong>
                <button type="button" class="close-btn" onclick="closeAlert()">X</button>
            </div>

            <?php
                unset($_SESSION['status']);
                unset($_SESSION['alert_class']);
        }
            ?>
            
    <!-- <input type="checkbox" id="check"> -->
    <div class="login form">
      <header>Login</header>
      <form action="rbac.php" method="post" id="loginForm">
        <input type="text" placeholder="Enter your email" name="email" id="loginEmail" required>
        <input type="password" placeholder="Enter your password" name="password" id="loginPassword" required>
       
        <input type="submit" class="button" value="Login">
      </form>
    </div>
    
  </div>

  <script>
    window.addEventListener('load', function() {
        // Clear login form fields
        document.getElementById('loginEmail').value = '';
        document.getElementById('loginPassword').value = '';
    });

    function closeAlert() {
      var alert = document.querySelector('.alert');
      alert.style.display = 'none';
    }
  </script>

</body>
</html>
