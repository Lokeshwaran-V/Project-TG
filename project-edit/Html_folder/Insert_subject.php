<!DOCTYPE html>
<html>
<head>
    <title>Subject Insert form</title>
    <style>
        form {
            display: flex;
            justify-content: center;
            position: relative;
        }
        fieldset {
            background-color: #eeeeee;
            max-width: 75%;
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
        input[type="text"],
        input[type="email"],
        select {
            font-family: serif;
            font-size: 20px;
            width: 200px; /* Adjust the width of input boxes */
            display: inline-block; /* Ensure each input is on a new line */

        }
        select{
            text-align: center;
        }
        #FACULTY_PASSWORD{
            font-family: serif;
            font-size: 20px;
            max-width: 150px; /* Adjust the width of input boxes */
            display: inline-block; /* Ensure each input is on a new line */      
        }
        #password-toggle {
            display: inline-block;
            font-family: serif;
            font-size: 16px;
        }
        button {
            font-family: serif;
            font-size: 20px;
        }
    </style>
</head>
<body>
    
    <form action="Php_folder\Insert-subject.php" method="post">
        <fieldset id="formfield">
            <legend align="center"> INSERT SUBJECT </legend><br>
            <label for="Faculty_Name">FACULTY NAME</label>
            <select name="Faculty_Name" id="Faculty_Name">
                <?php include 'Php_folder\fetch-faculty-name.php'; ?>
            </select><br><br><br>

            <label for="DEPARTMENT">DEPARTMENT</label>
            <input type="text" id="DEPARTMENT" name="DEPARTMENT" required><br><br><br>

            <label for="YEAR">YEAR</label>
            <select id="YEAR" name="YEAR" required>
                <option value="1">1st YEAR</option>
                <option value="2">2nd YEAR</option>
                <option value="3">3rd YEAR</option>
                <option value="4">4th YEAR</option>
            </select><br><br><br>

            <label for="SUBJECT_CODE">SUBJECT CODE</label>
            <input type="text" id="SUBJECT_CODE" name="SUBJECT_CODE" required><br><br><br>

            <label for="SUBJECT_NAME">SUBJECT NAME</label>
            <input type="text" id="SUBJECT_NAME" name="SUBJECT_NAME" required><br><br><br>

            <label for="SUBJECT_TYPE">SUBJECT TYPE</label>
            <select id="SUBJECT_TYPE" name="SUBJECT_TYPE" required>
                <option value="THEORY">THEORY</option>
                <option value="LAB">LAB</option>
            </select><br><br><br>

            <center><button>Insert</button></center>
            
        </fieldset>
    </form>
    <form action="Php_folder/subject_csv.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload CSV" name="submit">
    </form>
    
</body>
</html>