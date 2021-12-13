<?php

    require_once "../../Model/List.php";

    $list_id = $_GET["list_id"];
    $score = $_GET["score"];
    

    $list = GamesList::getListById($list_id);
    $index = $_GET["game_index"];
    $game_id = $list->__get("games")[$index]->__get("game_id");
    $list->modifyScore($score, $game_id);

    header("Location: ../../View/list/ListContent.php?id=$list_id");
?>