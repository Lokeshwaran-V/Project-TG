

<!DOCTYPE html>
<html>
<head>
    <title>Subject Delete form</title>
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
    
    <form action="Php_folder\Delete-subject.php" method="post">
        <fieldset id="formfield">
            <legend align="center"> DELETE SUBJECT </legend><br>
            <label for="SUBJECT_CODE">SUBJECT CODE</label>
            <select id="SUBJECT_CODE" name="SUBJECT_CODE" required>
            <?php 
                include 'Php_folder/fetch-sub-code.php';
            ?>
            </select><br><br><br>

            <label for="SUBJECT_NAME">SUBJECT NAME</label>
            <select id="SUBJECT_NAME" name="SUBJECT_NAME" required>
            <?php 
                include 'Php_folder/fetch-sub-name.php';
            ?>
            </select><br><br><br>

            <center><button>Delete</button></center>
        </fieldset>
    </form>

    
</body>
</html>