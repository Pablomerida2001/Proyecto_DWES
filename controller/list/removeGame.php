<?php
    require_once '../../Model/List.php';

    $game_id = $_GET["id"];
    $list_id = $_GET["list_id"];

    GamesList::removeGame($game_id, $list_id);

    header("Location: ../../View/list/ListContent.php?id=$list_id");
?>