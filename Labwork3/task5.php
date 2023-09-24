<html>
<head>
    <title>Task 5</title>
</head>
<body>

<h2>Prime Number Checker</h2>

<form method="post">
    Enter a positive integer: <input type="text" name="number">
    <input type="submit" value="Check">
</form>

<?php
function isPrime($number) {
    if ($number < 2) {
        return false;
    }

    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputNumber = isset($_POST['number']) ? intval($_POST['number']) : null;

    if ($inputNumber !== null) {
        if (is_numeric($inputNumber) && $inputNumber > 0) {
            if (isPrime($inputNumber)) {
                echo "$inputNumber is a prime number.";
            } else {
                echo "$inputNumber is not a prime number.";
            }
        } else {
            echo "Please enter a valid positive integer.";
        }
    } else {
        echo "Please enter a positive integer.";
    }
}
?>

</body>
</html>
