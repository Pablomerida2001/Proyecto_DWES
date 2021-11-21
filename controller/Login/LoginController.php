<?php

    require_once "../../Model/User.php";
    $root = __DIR__."../..";

    $succes = false;

    $username = $_POST["username"]??"";
    $password = $_POST["password"]??"";

    $user = User::getUserByName("username");

    session_start();

    if($user != null){
        if(password_verify($password, $user->__get("password"))){
            $succes = true;
            
            $_SESSION["user"] = serialize($user);
        }
    }else{
        $_SESSION["username"] = $username;
    }

    $succes ? header("Location: $root/../../index.php") : header("Location: ../../View/Login.php");
?>