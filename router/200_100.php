<?php
/**
 * Create routes using $app programming style.
 */

/**
 * Init the game, redirect to play the game.
 */
$app->router->get("100/init", function () use ($app) {
    // Init the session for the game start.
    if (!isset($_SESSION["100game"])) {
        $_SESSION["100game"] = new Isa\Handler\Handler();
    }

    if (!isset($_SESSION["dice"])) {
        $_SESSION["dice"] = new Isa\Dice\Dice();
    }

    if (!isset($_SESSION["roll"])) {
        $_SESSION["roll"] = null;
    }

    if (!isset($_SESSION["computer"])) {
        $_SESSION["computer"] = null;
    }

    if (!isset($_SESSION["fail"])) {
        $_SESSION["fail"] = null;
    }

    if (!isset($_SESSION["compFail"])) {
        $_SESSION["compFail"] = null;
    }

    if (!isset($_SESSION["playWinner"])) {
        $_SESSION["playWinner"] = null;
    }

    if (!isset($_SESSION["compWinner"])) {
        $_SESSION["compWinner"] = null;
    }

    return $app->response->redirect("100/100play");
});

/**
 * Play the game, show game status.
 */
$app->router->get("100/100play", function () use ($app) {
    $title = "Play the game";

    $game = $_SESSION["100game"];

    $data = [
        "roll" => $roll ?? null,
        "computer" => $computer ?? null,
        "save" => $save ?? null,
    ];

    $app->page->add("100/100play", $data);
    $app->page->add("100/100debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game, make a guess.
 */
$app->router->post("100/100play", function () use ($app) {
    $title = "Play the game";

    $roll = $_POST["roll"] ?? null;
    $save= $_POST["save"] ?? null;
    $computer = $_POST["computer"] ?? null;
    $avsluta = $_POST["avsluta"] ?? null;
    $fail = $_POST["fail"] ?? null;
    $playWinner = $_POST["playWinner"] ?? null;
    $compWiner = $_POST["compWinner"] ?? null;

    $game = $_SESSION["100game"];
    $dice = $_SESSION["dice"];

    if ($roll) {
        $_SESSION["fail"] = null;
        $_SESSION["roll"] = null;
        $_SESSION["computer"] = null;
        $dice->throw(2);
        $_SESSION["roll"] = $dice->sum();
        $res = $dice->check();
        if ($res == false) {
            $_SESSION["fail"] = "FAIL";
            $dice->emptyArray();
        }
        $res = true;
    }

    if ($computer) {
        $_SESSION["fail"] = null;
        $_SESSION["roll"] = null;
        $_SESSION["computer"] = "rolled";
        $dice->throw(2);
        $res = $dice->check();
        if ($res == false) {
            $_SESSION["compFail"] = "FAIL";
            $dice->emptyArray();
        }
        $game->saveC($dice->sum());
        $dice->emptyArray();
        $res = true;
        if ($game->getComputerPoints() >= 100) {
            $_SESSION["compWinner"] = true;
        }
    }

    if ($save) {
        $_SESSION["fail"] = null;
        $_SESSION["roll"] = null;
        $_SESSION["computer"] = null;
        $game->saveP($dice->sum());
        $dice->emptyArray();
        if ($game->getPlayerPoints() >= 100) {
            $_SESSION["playWinner"] = true;
        }
    }

    if ($avsluta) {
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

    return $app->response->redirect("100/init");
});
