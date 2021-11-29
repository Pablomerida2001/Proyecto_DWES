<?php 

    require_once '../../Model/User.php';
    require_once '../../Model/List.php';

    session_start();

    $user_id = $_SESSION["user_id"]??"";

    if($user_id === ""){
        header("Location: ../../View/Login.php");
    }

    $game_id = $_GET["game"]??"";
    $list_id = $_GET["list"]??"";

    GamesList::addGame($game_id, $list_id);

    echo "ta bien";

    header("Location: ../../View/Gameinfo.php?id=$game_id&s=true");
?>