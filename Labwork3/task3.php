<html>
<head>
    <title>Task 3</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Sample data
            $data = array(
                array('Jill', 'Smith', 50),
                array('Eve', 'Jackson', 94),
                array('John', 'Doe', 80)
            );

            // Loop through the data and create table rows
            foreach ($data as $row) {
                echo '<tr>';
                foreach ($row as $cell) {
                    echo '<td>' . $cell . '</td>';
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
