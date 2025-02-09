<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Highscore API Connection</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="title">
        Highscore API Connection
    </div>
    <div class="credits">
        <a href="https://github.com/madh-zealand/highscores-api" target="_blank">Highscores API Github</a>
    </div>
    <div class="container">
        <div data-player class="player"></div>
        <div data-score class="score"></div>
        <button data-send-button class="send-button">Send</button>
        <pre data-response-preview class="response-preview"></pre>
    </div>

    <script>
        const playerElement = document.querySelector('[data-player]');
        const scoreElement = document.querySelector('[data-score]');
        const sendButton = document.querySelector('[data-send-button]');
        const responsePreviewElement = document.querySelector('[data-response-preview]');

        const player = generatePirateName();
        const score = Math.round(Math.random() * 1000);

        playerElement.textContent = player;
        scoreElement.textContent = score.toString();

        function generatePirateName() {
            const firstNames = ["Blackbeard", "Salty", "One-Eyed", "Mad", "Captain", "Peg-Leg", "Red", "Stormy", "Jolly", "Barnacle"];
            const lastNames = ["McScurvy", "Silverhook", "Rumbelly", "Seadog", "Plankwalker", "Bones", "Squidbeard", "Driftwood", "Sharkbait", "Bootstraps"];

            const randomFirstName = firstNames[Math.floor(Math.random() * firstNames.length)];
            const randomLastName = lastNames[Math.floor(Math.random() * lastNames.length)];

            return `${randomFirstName} ${randomLastName}`;
        }
    </script>
</body>
</html>
