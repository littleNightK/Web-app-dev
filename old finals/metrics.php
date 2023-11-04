<?php
//submit function to insert data into database
function submit($truePositive, $falseNegative, $falsePositive, $trueNegative, $accuracy, $precison, $recall, $f1Score) {
    // Create a connection to your MySQL database
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "2003";
    $dbname = "myMetrics";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //check if table exists
    $tableName = 'myMetrics';
    $tableExistsQuery = "SHOW TABLES LIKE '$tableName'";
    $tableExistsResult = $conn->query($tableExistsQuery);

    // Create table if not exists
    if ($tableExistsResult->num_rows == 0) {
        $sql_create = "CREATE TABLE myMetrics (
            truePositive INT,
            falseNegative INT,
            falsePositive INT,
            trueNegative INT,
            accuracy FLOAT,
            precison FLOAT,
            recall FLOAT,
            f1Score FLOAT
        )";
        if ($conn->query($sql_create) === TRUE) {
            echo "Table created successfully<br>";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }

    // Insert data into table
    $sql_insert = "INSERT INTO myMetrics (truePositive, falseNegative, falsePositive, trueNegative, accuracy, precison, recall, f1Score) VALUES ($truePositive, $falseNegative, $falsePositive, $trueNegative, $accuracy, $precison, $recall, $f1Score);";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Data inserted successfully<br>";
    } else {
        echo "Error inserting data: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

//display funtion to calculate results and display them in a web page
function display() {
    // Create a connection to your MySQL database
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "2003";
    $dbname = "myMetrics";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check exist table
    $tableName = 'myMetrics';
    $tableExistsQuery = "SHOW TABLES LIKE '$tableName'";
    $tableExistsResult = $conn->query($tableExistsQuery);

    // Create table if not exists
    if ($tableExistsResult->num_rows == 0) {
        echo "Table does not exist. Please submit data first.";
    } else {
        // Fetch data from table
        $sql_fetch = "SELECT * FROM myMetrics";
        $result = $conn->query($sql_fetch);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "True Positive: " . $row["truePositive"] . "<br>";
                echo "False Negative: " . $row["falseNegative"] . "<br>";
                echo "False Positive: " . $row["falsePositive"] . "<br>";
                echo "True Negative: " . $row["trueNegative"] . "<br>";
                echo "Accuracy: " . $row["accuracy"] . "<br>";
                echo "Precison: " . $row["precison"] . "<br>";
                echo "Recall: " . $row["recall"] . "<br>";
                echo "F1 Score: " . $row["f1Score"] . "<br>";
            }
        } else {
            echo "No data found.";
        }
    }

    // Close the database connection
    $conn->close();

}
// Check if the POST values are set
if (isset($_POST['truePositive']) && isset($_POST['falseNegative']) && isset($_POST['falsePositive']) && isset($_POST['trueNegative'])) {
    // Fetch values from POST request
    $truePositive = $_POST['truePositive'];
    $falseNegative = $_POST['falseNegative'];
    $falsePositive = $_POST['falsePositive'];
    $trueNegative = $_POST['trueNegative'];

    // Check for non-negative numbers
    if ($truePositive >= 0 && $falseNegative >= 0 && $falsePositive >= 0 && $trueNegative >= 0) {
        // Calculate metrics
        $accuracy = ($truePositive + $trueNegative) / ($truePositive + $falseNegative + $falsePositive + $trueNegative);
        $precison = $truePositive / ($truePositive + $falsePositive);
        $recall = $truePositive / ($truePositive + $falseNegative);
        $f1Score = 2 * ($precison * $recall) / ($precison + $recall);
        if (isset($_POST['submit'])) {
            submit($truePositive, $falseNegative, $falsePositive, $trueNegative , $accuracy, $precison, $recall, $f1Score);
        }


        
    } else {
        echo "Please enter non-negative values for all fields.";
    }
    
    // Call display function when clicked on the "Display" button
    if (isset($_POST['display'])) {
        display();
    }

} else {
    echo "POST values not set. Make sure you submitted the form correctly.";
}
?>
