<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game, redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the session for the game start.
    if (!isset($_SESSION["game"])) {
        $_SESSION["game"] = new Isa\Guess\Guess();
        $_SESSION["cheat"] = null;
    }

    return $app->response->redirect("guess/play");
});


/**
 * Play the game, show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $game = $_SESSION["game"];
    $tries = $game->tries();

    $data = [
        "guess" => $guess ?? null,
        "res" => $res ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game, make a guess.
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game";

    $guess = $_POST["guess"] ?? null;
    $doInit= $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    $game = $_SESSION["game"];
    $number = $game->number();
    $tries = $game->tries();

    if ($doGuess) {
        //Do a guess.
        $result = $game->makeGuess($guess);
        $_SESSION["guess"] = $guess;
    }

    if ($doCheat) {
        //Cheat by showing the number.
        $_SESSION["cheat"] = $game->number();
    }

    if ($doInit) {
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
    }
    return $app->response->redirect("guess/init");
});
