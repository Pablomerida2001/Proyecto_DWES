<?php
    require_once "../../Model/Game.php";
    require_once "../../Model/List.php";
    require_once "../../Model/User.php";

    $dir = "../../";
    session_start();

    $user_id = $_SESSION["user_id"]??"";

    $list_id = $_GET["id"];
    $list = GamesList::getListById($list_id);

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
    <title><?= $list->__get("name")??"Lista"; ?></title>
</head>
<?php require_once "../Header.php"; ?>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table lists">
                            <thead>
                                <tr>
                                    <th><span>Portada</span></th>
                                    <th><span>Nombre</span></th>
                                    <th><span>Fecha de salida</span></th>
                                    <th><span>Nota</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                    foreach($list->__get("games") as $game){ 
                                        $i++;?>
                                        <tr class="<?= $i%2==0 ? "bg-secondary text-white" : "" ?>">
                                            <td><img style="width:75px" src="<?= $game->__get("img"); ?>"/></td>
                                            <td class="align-middle"><?= $game->__get("name"); ?></td>
                                            <td class="align-middle"><?= date_format(date_create($game->__get("releaseDate")), "d/m/Y"); ?></td>
                                            <td class="score align-middle" contenteditable maxlength=7><?= $game->__get("score") == "" ? "/10" : $game->__get("score"); ?></td><td class="align-middle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square ml-3" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></td>
                                            <td class="align-middle"><a href="../../View/Games/GameInfo.php?id=<?= $game->__get("game_id"); ?>" class="btn btn-primary text-white">Ver M??s</a></td>
                                            <td class="align-middle"><a href="../../controller/list/removeGame.php?id=<?= $game->__get("game_id"); ?>&list_id=<?= $list->__get("list_id"); ?>" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></a></td>
                                        </tr>			
                                <?php } ?>		
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.onload = () => {
        let score = document.getElementsByClassName("score");
        values = [];
        for (let i = 0; i < score.length; i++){
            values[i] = score[i].textContent;
            score[i].focusout = () =>{
                if(score[i].textContent != values[i]){
                    let url = "../../controller/list/modifyScore.php?list_id=<?= $list_id?>&game_index=" + i +"&score="+score[i].textContent;
                    window.location.href = url;
                    values[i] = score[i].textContent;
                }
            }
            score[i].onkeydown = (e) =>{
                if(score[i].textContent.length >= 7 && e.keyCode != 8){
                    e.preventDefault();
                }
            }
        }
    }
</script>
</html> 