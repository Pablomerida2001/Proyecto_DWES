<?php
    require_once '../../Model/List.php';

    $list_id = $_GET["id"];

    GamesList::delete($list_id);

    header("Location: ../../View/list/MyGames.php");
?>