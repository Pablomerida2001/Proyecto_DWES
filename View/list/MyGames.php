<?php
    require_once "../../Model/Game.php";
    require_once "../../Model/List.php";
    require_once "../../model/User.php";

    $dir = "../../";
    session_start();

    $user_id = $_SESSION["user_id"]??"";

    $lists = GamesList::getListsByUser($user_id);
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
    <title>Mis Juegos</title>
</head>
<?php require_once "../Header.php"?>
<body class="bg-light">
    <div class="container mt-5">
        <?php if(count($lists) != 0){?>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table lists">
                            <thead>
                                <tr>
                                    <th><span>Nombre</span></th>
                                    <th><span>Fecha de creación</span></th>
                                    <th><span>Número de juegos</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($lists as $list){ ?>
                                        <tr>
                                            <td><?= $list->__get("name"); ?></td>
                                            <td><?= date_format(date_create($list->__get("creationDate")), "d/m/Y"); ?></td>
                                            <td><?= count($list->__get("games")); ?></td>
                                            <td><a href="ListContent.php?id=<?= $list->__get("list_id"); ?>" class="btn btn-primary text-white">Ver</a></td>
                                        </tr>			
                                <?php } ?>		
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{?>
            <h5 class="text-center">No tienes ninguna lista creada todavía. <a href="./newList.php">Crear una ahora</a></h4>
        <?php } ?>
    </div>
</body>
</html>