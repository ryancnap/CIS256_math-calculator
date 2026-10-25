<?php
require "config.php";
session_start();

// Reuse questions from index.php
$questions = $_SESSION['questions'];
$guesses = $_POST['guesses'] ?? [];
$showResults = true;
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
    <?php require "quiz_table.php"; ?>
</body>
</html>
