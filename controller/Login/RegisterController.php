<?php

    require_once "../../Model/User.php";

    $succes = false;

    $username = $_POST["username"]??"";
    $email = $_POST["email"]??"";
    $password = $_POST["password"]??"";

    $user = User::getUserByName($username);
    if($user == null) $user = User::getUserByEmail($email);

    session_start();

    if($user == null){
            User::createUser($username, $email, $password);
            $user = User::getUserByEmail($email);
            $succes = true;
            
            $_SESSION["RegisterError"] = false;
            $_SESSION["user_id"] = $user->__get("user_id");
            $_SESSION["username"] = $username;
    }

    if(!$succes){
        $_SESSION["RegisterError"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
    }

    $succes ? header("Location: ../../index.php") : header("Location: ../../View/Register.php");
?>