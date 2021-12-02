<?php
    require_once "../../Model/Game.php";
    require_once "../../Model/List.php";
    require_once "../../model/User.php";

    $dir = "../../";
    session_start();

    $user_id = $_SESSION["user_id"]??"";

    $game_id = $_GET["id"];

    $game = Game::getGameById($game_id);

    if($_GET["s"]??false) echo "<script>window.alert(\"Juego añadido correctamente\");</script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title><?= $game!=null ? $game->__get("name") : "Juego no encontrado"?></title>
</head>
<?php require_once "../Header.php"?>
<body class="bg-light">
    <div class="container">
        <img class="img-fluid mt-3" src="<?= $game->__get("img") ?>"/> 

        <div class="d-flex">
            <h1 class="mt-3"><?= $game->__get("name") ?></h1>

            <div class="dropdown show mt-4 ml-5">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Guardar Juego</a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <?php
                        $lists = GamesList::getListsByUser($user_id);
                        foreach($lists as $list){
                            ?>
                            <a class="dropdown-item" href="../../controller/list/addToList.php?game=<?= $game_id?>&list=<?= $list->__get("list_id")?>"><?= $list->__get("name") ?></a>
                            <?php
                        }
                    ?>
                    <a class="dropdown-item text-danger" href="../list/newList.php">Nueva lista</a>
                </div>
            </div>

        </div>

        <h4 class="mt-5">Descripción</h4>
        <p><?= $game->__get("description") ?></p>

        <?php if($game->__get("releaseDate") != null){
            ?>
            <h4 class="mt-5">Fecha de Salida</h4>
            <p><?= date_format(date_create($game->__get("releaseDate")), "d/m/Y"); ?></p>
        <?php
        }?>
    </div>
    
</body>
</html>