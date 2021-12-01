<?php
    require_once "../../Model/User.php";

    session_start();

    $user_id = $_SESSION["user_id"]??null;
    $username = $_SESSION["username"]??"";
    $email = $_SESSION["email"]??"";
    $error = $_SESSION["registerError"]??false;

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
    <title>Registrate</title>
</head>
<body>
        <section class="gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <div class="mt-md-4 pb-5">
                    <h2 class="fw-bold mb-2 text-uppercase">Registrate</h2>
                    <p class="text-white-50 mb-4">Crear una cuenta nueva</p>

                    <form method="post" action="../../controller/Login/RegisterController.php" name="signup-form" oninput='password2.setCustomValidity(password2.value != password.value ? "Las contraseñas no coinciden" : "")'>

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="username" >Nombre de usuario</label>
                            <input type="text" name="username" pattern="[a-zA-Z0-9]+" required class="form-control form-control-lg" value="<?= $username ?>"/>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="email" >Email</label>
                            <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required class="form-control form-control-lg" value="<?= $email ?>"/>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="password">Contraseña</label>
                            <input type="password" name="password" required class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline form-white mb-5">
                            <label class="form-label" for="password2">Repite la contraseñas</label>
                            <input type="password" name="password2" required class="form-control form-control-lg" />
                        </div>

                        <?php if($error){ ?>
                            <p><a class="text-danger fw-bold">Usuario o contraseña incorrectos</a></p>
                        <?php } ?>
                    
                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Registrarse</button>
                        
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