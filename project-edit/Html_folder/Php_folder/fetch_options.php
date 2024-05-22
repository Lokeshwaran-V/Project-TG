
<?php
include 'connection_establishment.php';

function fetchOptions($sql) {
    $stmt = $GLOBALS['conn']->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    // $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value=". $row[$sql]. ">". $row[$sql]. "</option>";
        }
    } else {
        echo "<option>No users found</option>";
    }
}
?>

