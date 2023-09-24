<html>
<head>
    <title>Task 4</title>
</head>
<body>
    <h2>Factorial Calculator</h2>
    <form method="POST">
        Enter a positive integer: <input type="text" name="number" /><br><br>
        <input type="submit" value="Calculate Factorial" />
    </form>

    <?php
    function factorial($n) {
        if ($n === 0 || $n === 1) {
            return 1;
        } else {
            return $n * factorial($n - 1);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $number = isset($_POST['number']) ? intval($_POST['number']) : 0;

        if ($number >= 0) {
            $result = factorial($number);
            echo "The factorial of $number is: $result";
        } else {
            echo "Please enter a valid positive integer.";
        }
    }
    ?>
</body>
</html>
