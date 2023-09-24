<?php
$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "studentmarkdb";
$conn = "";

$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "MySQL connected successfully with database selection<br>";
}

$sql_best_students = "SELECT * FROM students WHERE Mark > 75";
$sql_good_students = "SELECT * FROM students WHERE Mark > 60 AND Mark <= 75";
$sql_average_students = "SELECT * FROM students WHERE Mark < 60";

$result_best_students = $conn->query($sql_best_students);
$result_good_students = $conn->query($sql_good_students);
$result_average_students = $conn->query($sql_average_students);

// Display the results in tables
echo "<h3>Best Students (Mark > 75)</h3>";
displayTable($result_best_students);

echo "<h3>Good Students (Mark > 60 and <= 75)</h3>";
displayTable($result_good_students);

echo "<h3>Average Students (Mark < 60)</h3>";
displayTable($result_average_students);

function displayTable($result) {
    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Class</th>
        <th>Mark</th>
        <th>Sex</th>
        </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Class"] . "</td>";
            echo "<td>" . $row["Mark"] . "</td>";
            echo "<td>" . $row["Sex"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results.";
    }
}

mysqli_close($conn);
?>
