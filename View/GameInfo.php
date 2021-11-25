<?php
    require_once "../Model/Game.php";

    $game_id = $_GET["id"];

    $game = Game::getGameById($game_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $game!=null ? $game->__get("name") : "Juego no encontrado"?></title>
</head>
<body>

    <a>a</a>
    
</body>
</html>