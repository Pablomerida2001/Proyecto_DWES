<?php

    require_once "../../Model/User.php";

    $succes = false;

    $username = $_POST["username"]??"";
    $password = $_POST["password"]??"";

    $user = User::getUserByName($username);

    session_start();

    if($user != null){
        if(password_verify($password, $user->__get("password"))){
            $succes = true;
            
            $_SESSION["loginError"] = false;
            $_SESSION["user_id"] = $user->__get("user_id");
            $_SESSION["username"] = $username;
        }
    }

    if(!$succes){
        $_SESSION["loginError"] = true;
        $_SESSION["username"] = $username;
    }

    $succes ? header("Location: ../../index.php") : header("Location: ../../View/Login/Login.php");
?>