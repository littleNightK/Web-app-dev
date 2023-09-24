<html>
<head>
    <title>Task 7</title>
</head>
<body>

<h2>String Reverser</h2>

<form method="post">
    Enter a string: <input type="text" name="inputString">
    <input type="submit" value="Reverse">
</form>

<?php
function reverseString($str) {
    return strrev($str);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputString = isset($_POST['inputString']) ? $_POST['inputString'] : null;

    if ($inputString !== null) {
        $reversedString = reverseString($inputString);
        echo "Original string: $inputString<br>";
        echo "Reversed string: $reversedString";
    } else {
        echo "Please enter a string.";
    }
}
?>

</body>
</html>
