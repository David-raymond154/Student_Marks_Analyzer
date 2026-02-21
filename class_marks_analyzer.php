<?php

$number = 0;
$marks = [];

if (isset($_POST['student_number'])) {
    $number = (int)$_POST['student_number'];
}

if (isset($_POST['process'])) {
    $marks = $_POST['marks'];

    $total = 0;
    $highest = $marks[0];
    $lowest = $marks[0];

    echo "<h2>Results</h2>";

    foreach ($marks as $index => $value) {
        echo "Student " . ($index + 1) . ": " . $value . "<br>";

        $total += $value;

        if ($value > $highest) {
            $highest = $value;
        }

        if ($value < $lowest) {
            $lowest = $value;
        }

    }

    $count = count($marks);
    $average = ($count > 0) ? $total / $count : 0;

    echo "<br>Total Marks: $total <br>";
    echo "Class Average: " . number_format($average, 1) . "<br>";
    echo "Highest Mark: $highest <br>";
    echo "Lowest Mark: $lowest <br>";

    $i = 0;
    $above50 = 0;
    $below40 = 0;

    while ($i < $count) {
        if ($marks[$i] > 50) {
            $above50++;
        }
        if ($marks[$i] < 40) {
            $below40++;
        }
        $i++;
    }

    echo "Students scoring Above 50: $above50 <br>";
    echo "Students scoring Below 40: $below40 <br>";

    if ($average >=75) {
        echo "Class Performance: Excellent <br>";
    } elseif ($average < 50) {
        echo "Class Performance: Poor <br>";
    }

    echo "<hr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Marks Analyzer</title>
</head>
<body>
    <h1>Student Marks Analyzer</h1>

    <form method="POST">
        <label>Number of Students:</label>
        <input type="number" name="student_number" value="<?php echo $number; ?>" min="1" required><br><br>
        <button type="submit" name="submit">Submit</button>
    </form>

    <br>

    <?php
    if ($number > 0) {
        echo "<h3>Enter Marks for $number Students</h3>";
        echo "<form method='POST'>";

        echo "<input type='hidden' name='student_number' value='$number'>";

        for ($i = 1; $i <= $number; $i++) {
            echo "Student $i Marks: ";
            echo "<input type='number' name='marks[]' min='0' max='100' required><br><br>";
        }

        echo "<button type='submit' name='process'>Submit Marks</button>";
        echo "</form>";
    }
    ?>
</body>

</html>