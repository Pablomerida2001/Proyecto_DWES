<?php
    require_once "../../Model/Game.php";
    require_once "../../Model/List.php";
    require_once "../../model/User.php";

    $dir = "../../";
    session_start();

    $user_id = $_SESSION["user_id"]??"";

    //TODO create a script to do this for all pages
    if($user_id == ""){
        header("Location: ../Login/Login.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--TODO same-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Nueva lista</title>
</head>
<?php require_once "../Header.php"; ?>
<body class="bg-light">
    <div class="container p-5">
        <div class="col align-center p-5">
            <h1 class="mb-5">Crear una lista nueva</h1>
            <form action="../../controller/list/createList.php" method="POST">
                <div class="form-group">
                    <label for="nameInput">Nombre de la Lista</label>
                    <input name="name" type="text" class="form-control" id="nameInput" placeholder="Introduce el nombre de la lista" maxlength="100">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Crear</button>
            </form>
        </div>
    </div>
</body>
</html>