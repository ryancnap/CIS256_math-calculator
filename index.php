

// New requirements:
// keep track of correct answers
// replace blank with number input field
// check input field against correct answer

// create new page that displays the same test but with the number fields replaced by:
// 1. The answer
// 2. Correct/incorrect
// 3. For incorrect label, display Incorrect. The correct answer is _

// At the bottom of the new page, display percentage correct
// At the bottom of the new page, display a link allowing users to complete a new test

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

$_SESSION['questions'] = $questions;
$columns = array_chunk($questions, (int) ceil(count($questions) / NUMBER_COLUMNS));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CIS 256 - Math Test project</title>
    <style>
        /* Two columns side by side */
        .quiz {display: flex; gap: 4em; margin-top: 1em; font-size: 1.2em;}

        /* Fixed width cells */
        .quiz td {padding: 0.5em; text-align: right;}
        .quiz .number {width: 2.5em;}
        .quiz .operand {width: 1.5em;}
        .quiz .operator, .quiz .equal {width: 1em; text-align: center;}
        .quiz .answer {width: 10em; border-bottom: 1px solid black; text-align: left;}
    </style>
</head>

<body>
    <h1>Math Test</h1>
    <h2>Name:</h2>
    <form method="post" action="results.php">
        <div class = "quiz">
            <?php foreach ($columns as $column): ?>
                <table>
                    <?php foreach ($column as [$questionNumber, $a, $operator, $b, $answer]): ?>
                        <tr>
                            <td class="number"><?= $questionNumber ?>)</td>
                            <td class="operand"><?= $a ?></td>
                            <td class="operator"><?= $operator ?></td>
                            <td class="operand"><?= $b ?></td>
                            <td class="equal">=</td>
                            <td class="answer">
                                <!-- Following will build $_POST['guesses'] as an array keyed by question number, with the value as the guess input -->
                                <input type="number" name="guesses[<?= $questionNumber ?>]">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endforeach; ?>
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
