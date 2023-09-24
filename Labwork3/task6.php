<html>
<head>
    <title>Task 6</title>
</head>
<body>

<h2>Numerical Array Sorter</h2>

<form method="post">
    Enter numbers (comma-separated): <input type="text" name="numbers">
    <br>
    <input type="submit" name="sortAscending" value="Sort (Ascending)">
    <input type="submit" name="sortDescending" value="Sort (Descending)">
</form>

<?php
function sortNumericArray($input, $ascending) {
    $numbers = explode(',', $input);
    $numbers = array_map('trim', $numbers);

    // Remove empty elements
    $numbers = array_filter($numbers);

    if (empty($numbers)) {
        return "Please enter valid numerical values.";
    }

    // Convert the elements to integers
    $numbers = array_map('intval', $numbers);

    // Sort the array based on the button clicked
    if ($ascending) {
        sort($numbers);
    } else {
        rsort($numbers);
    }

    return $numbers;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = isset($_POST['numbers']) ? $_POST['numbers'] : null;

    if ($input !== null) {
        if (isset($_POST['sortAscending'])) {
            $sortedNumbers = sortNumericArray($input, true);
            $sortType = "ascending";
        } elseif (isset($_POST['sortDescending'])) {
            $sortedNumbers = sortNumericArray($input, false);
            $sortType = "descending";
        }

        if (is_array($sortedNumbers)) {
            echo "Original array: $input <br>";
            echo "Sorted array ($sortType): " . implode(", ", $sortedNumbers);
        } else {
            echo $sortedNumbers;
        }
    } else {
        echo "Please enter numerical values.";
    }
}
?>

</body>
</html>
