<?php
namespace Anax\View;

$game = $_SESSION["game"];
$cheat = $_SESSION["cheat"];
?>
<html>
<h1> Guess my number </h1>

<p> Guess a number between 1 and 100, you have <?= $tries; ?> tries left. </p>

<form method="post">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($game->res()) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $game->res() ?></b></p>
<?php endif; ?>

<?php if ($cheat) : ?>
    <p>The number is <b><?= $game->number() ?></b>.</p>
<?php endif; ?>

</html>
