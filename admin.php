<?php

$config = require 'config.php';

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
        Secure admin site
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
