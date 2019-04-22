<?php
require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";

session_name("isca18");
session_start();

if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = new Guess();
}

$game = $_SESSION["game"];
$number = $game->number();
$tries = $game->tries();

$guess = $_POST["guess"] ?? null;
$doInit= $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

require __DIR__ . "/view/guess.php";

if ($doInit) :
    // Unset all of the session variables.
    $_SESSION = [];

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy();
    header("Refresh:0");
endif;
