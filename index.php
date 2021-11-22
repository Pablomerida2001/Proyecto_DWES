<?php

    require_once "./model/User.php";
    require_once "./model/Game.php";
    require_once "./controller/db/query.php";

    session_start();

    $username = $_SESSION["username"]??"";

    $games = Game::getAllGames();

    //$user2 = User::createUser("test", "test@test.com", "1234");

    //$user = User::getUserByName("test");
    //if($user != null)echo $user->__get("user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./View/styles/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./View/scripts/index.js"></script>
    <title>Inicio</title>
</head>

<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
                <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="15" alt="logo" loading="lazy"/>
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Test</a>
                </li>
            </ul>
            <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
            <!-- Icon -->
            <a class="text-reset me-3" href="#">
                <i class="fas fa-shopping-cart"></i>
            </a>

            <?php  if($username != "" && "a" == "b"){ ?>
            <!-- Avatar -->
            <a
                class="dropdown-toggle d-flex align-items-center hidden-arrow"
                href="#"
                id="navbarDropdownMenuLink"
                role="button"
                data-mdb-toggle="dropdown"
                aria-expanded="false"
            >                
                <!-- User profile picture -->
                <img
                src="https://mdbootstrap.com/img/new/avatars/2.jpg"
                class="rounded-circle"
                height="25"
                alt=""
                loading="lazy"
                />
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item" href="#">My profile</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">Settings</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">Logout</a>
                </li>
            </ul>
            </div>
            <?php }else{ ?>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item px-2">
                    <button type="button" name="login" id="loginButton" class="btn btn-success" data-toggle="modal" href="View/Login.php">Iniciar Sesión</button>  
                </li>
                <li class="nav-item px-2">
                    <button type="button" name="login" id="registerButton" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Registrate</button>  
                </li>
            </ul>
            <?php } ?>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>

<body>

    <div class="container mx-auto mt-3">		
	<?php		

        if (empty($datos)):
        ?>
            <div class="alert alert-info">
                No se han encontrado registros
            </div>
        <?php
        else:
            $i = 0 ;
            while($i < count($datos)):
                $e = 0 ;
                echo "<div class=\"row\">" ;
                while (($i < count($datos)) and ($e < 10)):
        ?>
                <div class="col-md-12 col-lg-4">
                    <div class="item card shadow m-2">
                        <div class="poster overflow-hidden">			 			
                            <img class="card-img-top" 
                                src="<?= (is_null($datos[$i]->__get("img")))?"imgs/poster.jpg":$datos[$i]->__get("img") ?>" />
                        </div>
                        
                        <div class="card-body">
                            <div class="text-center">
                                <h3><?= $datos[$i]->__get("name") ?></h3>
                                <h5><?= $datos[$i]->__get("description") ?></h5>
                            </div>
                            
                            <p class="text-truncate"><?= $datos[$i]->__get("description")?></p>

                            <div class="row">
                                <div class="col-sm-6 text-center">
                                    <a href="editar.php?id=<?= $datos[$i]->idSer ?>">
                                        <i class="bi bi-info-square"></i> Editar
                                    </a>
                                </div>
                                <div class="col-sm-6 text-center">
                                    <a href="borrar.php?id=<?= $datos[$i]->idSer ?>">
                                        <i class="bi bi-eraser"></i> Borrar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>

        <?php
                    $i++; $e++ ;
                endwhile ;
                echo "</div>" ;
            endwhile ;
        ?>


            <div class="text-center mt-2 mb-5">
                <?php
                    // enlace a la página anterior
                    if ($pag == 1) echo "anterior |" ;
                    else echo "<a href=\"main.php?p=".($pag-1)."\">anterior |</a>" ;

                    // enlace a la página siguiente
                    if ($pag == $total) echo "siguiente" ;
                    else echo "<a href=\"main.php?p=".($pag+1)."\">siguiente</a>" ;
                ?>						
            </div>
        <?php endif ; ?>
	</div>
</body>
</html>