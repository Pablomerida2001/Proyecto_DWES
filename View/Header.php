<?php
    $user_id = $_SESSION["user_id"]??"";

    if(isset($user_id)){
        $user = User::getUserById($user_id);
    }

    $pag = $_GET["p"]??1 ;
?>

<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $dir ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $dir ?>View/list/MyGames.php">Mis Juegos</a>
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
            <?php if($user != null){ ?>
                <div class="dropdown">
                    <a class="dropdown-toggle text-white" data-toggle="dropdown"><?= $user->__get("userName")?></a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item text-danger" href="<?= $dir ?>Controller/Login/Logout.php">Cerrar Sesión</a>
                    </div>
                </div>
            <?php }else{ ?>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item px-2">
                    <a type="button" name="login" id="loginButton" class="btn btn-success" href="<?= $dir ?>View/Login/Login.php">Iniciar Sesión</a>  
                </li>
                <li class="nav-item px-2">
                    <a type="button" name="register" id="registerButton" class="btn btn-primary" href="<?= $dir ?>View/Login/register.php">Registrate</a>  
                </li>
            </ul>
            <?php } ?>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>