<?php 
    require_once '../../Model/User.php';
    require_once '../../Model/List.php';

    session_start();

    $user_id = $_SESSION["user_id"]??"";

    if($user_id === ""){
        header("Location: ../../View/Login.php");
    }

    $name = $_POST["name"];

    if(GamesList::createList($name, $user_id)){
        header("Location: ../../View/list/MyGames.php");
    }else{
        header("Location: ../../View/list/newList.php");
    }
?>