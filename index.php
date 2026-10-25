<?php
require "config.php";
session_start();

// Generate x pairs of random numbers with operator-based logic and add to array of all questions.
// Constraints: a - b >= minimum result, a + b <= maximum result, minimum result >= 0.
foreach (range(1, NUMBER_PAIRS) as $questionNumber) {
    $operator = (rand(0, 1) == 0) ? '+' : '-';

    if ($operator == '+')
    {
        $result = rand(MINIMUM_RESULT, MAXIMUM_RESULT);
        $a = rand(MINIMUM_RESULT, $result);
        $b = $result - $a;
        $pair = [$a, $b];
        $answer = $a + $b;
        shuffle($pair);
    }
    else
    {
        $a = rand(MINIMUM_RESULT, MAXIMUM_RESULT);
        $b = rand(MINIMUM_RESULT, $a);
        $pair = [$a, $b];
        $answer = $a - $b;
    }

    $questions[] = [$questionNumber, $pair[0], $operator, $pair[1], $answer];
}

// Store questions array in session variable for later
$_SESSION['questions'] = $questions;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CIS 256 - Math Test project</title>
    <?php require "styles.php"; ?>
</head>

<body>
    <h1>Math Test</h1>
    <h2>Name:</h2>
    <form method="post" action="results.php">
        <?php $showResults = false; require "quiz_table.php"; ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
