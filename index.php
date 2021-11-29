<?php
    require_once "./model/User.php";
    require_once "./model/Game.php";
    require_once "./controller/db/query.php";

    $dir = "./";
    session_start();
    //session_destroy();

    $user_id = $_SESSION["user_id"]??"";

    if(isset($user_id)){
        $user = User::getUserById($user_id);
    }

    $games = Game::getAllGames();

    $pag = $_GET["p"]??1 ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./View/styles/index.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./View/scripts/index.js"></script>
    <title>Inicio</title>
</head>

<?php require_once "View/Header.php"?>

<body>

    <div class="container mx-auto mt-3">		
	<?php		

        if (empty($games)):
        ?>
            <div class="alert alert-info">
                No se han encontrado registros
            </div>
        <?php
        else:
            $i = 0 ;
            while($i < count($games)):
                $e = 0 ;
                echo "<div class=\"row\">" ;
                while (($i < count($games)) and ($e < 10)):
        ?>
                <div class="col-md-12 col-lg-4">
                    <div class="item card shadow m-2">
                        <div class="poster overflow-hidden">			 			
                            <img class="card-img-top" 
                                src="<?= (is_null($games[$i]->__get("img")))?"imgs/poster.jpg":$games[$i]->__get("img") ?>" />
                        </div>
                        
                        <div class="card-body">
                            <div class="text-center">
                                <a href="View/GameInfo.php?id=<?= $games[$i]->__get("game_id"); ?>"><h3><?= $games[$i]->__get("name") ?></h3></a>
                            </div>
                            
                            <p class="text-truncate"><?= $games[$i]->__get("description")?></p>
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
                    else echo "<a href=\"index.php?p=".($pag-1)."\">anterior |</a>" ;

                    // enlace a la página siguiente
                    if ($pag*10 >= count($games)*10) echo "siguiente" ;
                    else echo "<a href=\"index.php?p=".($pag+1)."\">siguiente</a>" ;
                ?>						
            </div>
        <?php endif ; ?>
	</div>
</body>
</html>