<?php

    define('__ROOT__', getcwd());

    //echo __ROOT__;

    require_once __ROOT__."/model/User.php";
    require_once __ROOT__."/controller/db/query.php";

    $user = User::getUserByEmail("test@test.com");
    //$user2 = User::createUser("te1a2eeest2", "te121a2eest@test.com", "1234");

    if($user != null)echo $user->__get("user_id");

    echo "a";
    //$query = new Query();
    //$query->test();


?>