<?php
$db_server = "127.0.0.1:3306";
$db_username = "root";
$db_password = "2003";
$db_name = "studentmarkdb";
$conn = "";

$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "MySQL connected successfully with database selection<br>";
}

$sql = "UPDATE students SET Class = 'Two' WHERE Mark < 60";

if ($conn->query($sql) === TRUE) {
    echo "Classes updated successfully.";
} else {
    echo "Error updating classes: " . $conn->error;
}

mysqli_close($conn);
?>
