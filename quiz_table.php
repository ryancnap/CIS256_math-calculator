<?php
// Reorganize questions into even columns for display purposes only.
$columns = array_chunk($questions, (int) ceil(count($questions) / NUMBER_COLUMNS));
?>
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
                    <?php if ($showResults): ?>
                        <?php
                            $guess = $guesses[$questionNumber] ?? '';
                            $isCorrect = $guess !== '' && (int) $guess === $answer;
                        ?>
                        <td class="answer"><?= $guess ?></td>
                        <td class="feedback">
                            <?= $isCorrect ? "Correct!" : "Incorrect. The answer is $answer." ?>
                        </td>
                    <?php else: ?>
                        <td class="answer">
                            <!-- Following will build $_POST['guesses'] as an array keyed by question number, with the value as the guess input -->
                            <input type="number" name="guesses[<?= $questionNumber ?>]">
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endforeach; ?>
</div>