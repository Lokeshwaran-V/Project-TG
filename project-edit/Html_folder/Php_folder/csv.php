<!DOCTYPE html>
<html>
<head>
    <title>Upload CSV File</title>
</head>
<body>

<h2>Upload CSV File</h2>
<form action="connection_csv_file.php" method="post" enctype="multipart/form-data">
    Select CSV file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload CSV" name="submit">
</form>

</body>
</html>
