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
    $results[$questionNumber] = $guess !== '' && $guess === $answer;
}

$correct = count(array_filter($results));
$percentCorrect = round($correct / count($questions) * 100);

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
    <p>You got <?php echo $correct; ?> out of <?php echo count($questions); ?> questions correct.</p>
    <p>Your score is <?= $correct?> of <?=count($questions)?></p>
    <p>Your score is <?= $percentCorrect?>%</p>
</body>
</html>
