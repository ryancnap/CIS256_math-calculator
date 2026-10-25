<?php
require "config.php";
session_start();

// At the bottom of the new page, display percentage correct
// At the bottom of the new page, display a link allowing users to complete a new test

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

$_SESSION['questions'] = $questions;
$columns = array_chunk($questions, (int) ceil(count($questions) / NUMBER_COLUMNS));
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
