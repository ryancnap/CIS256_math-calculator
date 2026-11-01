<?php
require "config.php";
session_start();

// Reuse questions from index.php
$questions = $_SESSION['questions'];
$guesses = $_POST['guesses'] ?? [];

$results = [];
foreach ($questions as [$questionNumber, $a, $operator, $b, $answer])
{
    $guess = $guesses[$questionNumber] ?? '';
    $results[$questionNumber] = $guess !== '' && (int) $guess === $answer;
}

$correct = count(array_filter($results));
$percentCorrect = round($correct / NUMBER_PAIRS * 100);

$showResults = true;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CIS 256 - Math Test project</title>
    <?php require "styles.php"; ?>
</head>

<body>
    <h1>Test Results</h1>
    <?php require "quiz_table.php"; ?>
    <br/>
    <p>You got <?= $correct; ?> out of <?= NUMBER_PAIRS; ?> questions correct.</p>
    <p>Your score is <?= $percentCorrect?>%</p>
    <br/>
    <a href="index.php">Complete another test.</a>
</body>
</html>
