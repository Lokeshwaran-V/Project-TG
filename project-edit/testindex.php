<!DOCTYPE html>
<html>
    <head>
        <title>Timetable Generator</title>
    </head>
    
    <body>
        <h2>Timetable Generator</h2>
        <form action="fetch-all.php" method="post">
            <label for="subjects">Subjects:</label>
            <input type="text" name="subjects" id="subjects"><br><br>
            <label for="teachers">Teachers:</label>
            <input type="text" name="teachers" id="teachers"><br><br>
            <label for="rooms">Rooms:</label>
            <input type="text" name="rooms" id="rooms"><br><br>
            <input type="submit" value="Generate Timetable">
        </form>
    </body>
</html>