<?php
namespace Anax\View;

$game = $_SESSION["100game"];
$roll = $_SESSION["roll"];
$dice = $_SESSION["dice"];
$fail = $_SESSION["fail"];
$computer = $_SESSION["computer"];
$compWinner = $_SESSION["compWinner"];
$playWinner = $_SESSION["playWinner"];

?>
<html>

<h1> Tärningsspelet 100 </h1>

<p> Du och datorn spelar imot varandra. Med hjälp av knapparna nedan
    så kastar du först tärningarna, sedan väljer du om du vill spara
    värdena (om du ej får en etta) eller om du vill spela vidare. Lycka till!
</p>
<p> Du har <?= $game->getPlayerPoints() ?> poäng.</p>
<p> Datorn har <?= $game->getComputerPoints() ?> poäng.</p>

<form method="post">
    <input type="submit" name="roll" value="Roll">
    <input type="submit" name="save" value="Save">
    <input type="submit" name="computer" value="Roll for computer">
    <input type="submit" name="avsluta" value="Avsluta">
</form>

<?php if ($roll) : ?>
    <p> Your numbers are <?= $dice->print() ?>.</p>
<?php endif; ?>

<?php if ($computer) : ?>
    <p> The computer rolled, he has a total of <?= $game->getComputerPoints()?>.</p>
<?php endif; ?>

<?php if ($fail) : ?>
    <p> Sorry but you got a 1 and lost the points. Klick on
    "Roll for computer" to see what the computer does.</p>
<?php endif; ?>

<?php if ($compWinner) : ?>
    <p> The computer won!!</p>
<?php endif; ?>

<?php if ($playWinner) : ?>
    <p> You won!!</p>
<?php endif; ?>
</html>
