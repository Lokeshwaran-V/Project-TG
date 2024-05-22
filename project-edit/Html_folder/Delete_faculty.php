

<!DOCTYPE html>
<html>
<head>
    <title>Faculty Delete form</title>
    <style>
        form {
            display: flex;
            justify-content: center;
            position: relative;
        }
        fieldset {
            background-color: #eeeeee;
            max-width: 100%; 
            min-width: 30%;
            font-family: serif;
            font-size: 20px;
            display: block;
        }
        label {
            display: inline-block;
            width: 50%;
            font-family: serif;
            font-size: 25px;
        }
        select{
            display: inline-block; /* Ensure each input is on a new line */
            font-family: serif;
            font-size: 20px;
            width: 200px; /* Adjust the width of input boxes */

        }

        button {
            font-family: serif;
            font-size: 20px;
        }
    </style>
</head>
<body>
    
    <form action="Php\Faculty\Delete-faculty.php" method="post">
        <fieldset id="formfield">
            <legend align="center"> DELETE FACULTY </legend><br>
            <label for="FACULTY_ID">FACULTY ID</label>
            <select id="FACULTY_ID" name="FACULTY_ID" required>
                <?php include 'Php_folder\fetch-faculty-id.php'; ?>
            </select><br><br><br>

            <label for="FACULTY_NAME">FACULTY NAME</label>
            <select id="FACULTY_NAME" name="FACULTY_NAME" required>
                <?php include 'Php_folder\fetch-faculty-name.php'; ?>
            </select><br><br><br>

            <center><button>Delete</button></center>
        </fieldset>
    </form>

    
</body>
</html>