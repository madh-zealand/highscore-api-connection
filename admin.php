<?php

$config = require 'config.php';
require 'api.php';

// If not authenticated, ask to log in
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Highscore API Connection"');
    http_response_code(401);
    echo 'Unauthorized access';
    exit;
}

// Validate credentials
if (
    $_SERVER['PHP_AUTH_USER'] !== $config['admin']['username'] ||
    $_SERVER['PHP_AUTH_PW'] !== $config['admin']['password']
) {
    http_response_code(401);
    echo 'Unauthorized access';
    exit;
}

// Handle delete post actions
if ($_POST && isset($_POST['delete'], $_POST['game-id'])) {
    $gameId = $_POST['game-id'];

    $response = apiDelete("https://highscores.martindilling.com/api/v1/games/{$gameId}");
    header("Location: admin.php");
    exit;
}

// Handle create post actions
if ($_POST && isset($_POST['save'], $_POST['title'])) {
    $title = $_POST['title'];
    $response = apiPost('https://highscores.martindilling.com/api/v1/games', [
        'title' => $title,
    ]);
    header("Location: admin.php");
    exit;
}

// Fetch all games
$response = apiGet('https://highscores.martindilling.com/api/v1/games');
$games = $response['data'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Highscore API Connection | Admin area</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="logout">
        <a data-button-logout href="#">Logout</a>
    </div>

    <div class="container">
        <div class="game-new">
            <div class="game-title">
                <input form="new-game-form" type="text" name="title" placeholder="Game title...">
            </div>
            <div class="game-actions">
                <form id="new-game-form" method="post">
                    <button type="submit" name="save">
                        Save
                    </button>
                </form>
            </div>
        </div>
        <?php foreach ($games as $game): ?>
            <div class="game-listing">
                <div class="game-id">
                    <?php echo $game['id'] ?>
                </div>
                <div class="game-title">
                    <?php echo $game['title'] ?>
                </div>
                <div class="game-actions">
                    <form method="post">
                        <input type="hidden" id="game-id" name="game-id" value="<?php echo $game['id'] ?>">
                        <button type="submit" name="delete">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        const buttonLogout = document.querySelector('[data-button-logout]');

        buttonLogout.addEventListener('click', (event) => {
            event.preventDefault();
            fetch('logout.php')
                .then(function(response) {
                    console.log('Failed to log out', response);
                    if (response.status === 401) {
                        console.log('Successfully logged out', response);
                        window.location.reload();
                    } else {
                        console.log('Failed to log out', response);
                    }
                });
        });
    </script>
</body>
</html>
