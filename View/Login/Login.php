<?php

    require_once "../../Model/User.php";

    session_start();

    $user_id = $_SESSION["user_id"]??null;
    $username = $_SESSION["username"]??"";
    $error = $_SESSION["loginError"]??false;

    if($user_id != null && !$error){
        header("Location: ../../index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="md-5 mt-md-4 pb-5">

                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Introduce tu nombre de usuario y la contraseña</p>

                    <form method="post" action="../../controller/Login/LoginController.php" name="login-form">

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="username" >Nombre de usuario</label>
                            <input type="text" name="username" pattern="[a-zA-Z0-9]+" required class="form-control form-control-lg" value="<?= $username ?>"/>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="password">Contraseña</label>
                            <input type="password" name="password" required class="form-control form-control-lg" />
                        </div>
                    
                        <p class="small mb-2 pb-lg-2"><a class="text-white-50" href="./recoverPwd.php">¿Has olvidado la contraseña?</a></p>

                        <?php if($error){ ?>
                            <p><a class="text-danger fw-bold">Usuario o contraseña incorrectos</a></p>
                        <?php } ?>

                        <button class="btn btn-outline-light btn-lg px-5 mb-5" type="submit">Iniciar sesión</button>     
                        
                        <div>
                            <p class="mb-0 mt-0">¿No tienes cuenta? <a href="./register.php" class="text-white-50 fw-bold">Registrate</a></p>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</body>
</html>