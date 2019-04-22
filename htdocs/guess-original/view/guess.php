<h1> Guess my number </h1>

<p> Guess a number between 1 and 100, you have <?= $tries; ?> tries left. </p>

<form method="post">
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?= $game->number() ?>">
    <input type="hidden" name="tries" value="<?= $game->tries() ?>">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doGuess) : ?>
    <?php $result = $game->makeGuess($guess); ?>
    <p>Your guess <?= $guess ?> is <b><?= $result ?></b></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>The number is <?= $game->number() ?></p>
<?php endif; ?>
