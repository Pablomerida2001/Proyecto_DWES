<?php
    require_once "./Model/User.php";
    require_once "./Model/Game.php";
    require_once "./Model/Genre.php";
    require_once "./controller/db/query.php";

    //Genre::createGenre("RPG Games", "Role-playing games use protagonists as the leading figures in the occurring events. The player performs as a protagonist; his moves affect the setting and the possible outcome. Some RPGs are created in the form of trading card games; some relate to wargames. Except for the video RPGs, the genre is divided into two primary forms; the original tabletop role-playing, handled through discussion, and live-action role-playing, conducted through the characters' actions. Each of them has a game master who's in charge of the rules and settings. The video RPGs include sandboxes, like GTA; tactical games, like Dragonfall; and roguelikes, like Mystery Dungeon. Usually, the primary purpose is to save the world or other characters. That includes taking part in collaborative storytelling, fighting, collecting items and solving puzzles if needed. The plot tends to develop in a fantasy or science fiction universe.");
    //Game::addGenre(Genre::getGenreByName("RPG Games")->__get("genre_id"), Game::getGameByName("The Witcher 3: Wild Hunt")->__get("game_id"));

    $dir = "./";
    session_start();

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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
            $i = 9 * ($pag - 1);
            while($i < count($games) && $i < 9 * $pag):
                $e = 0 ;
                echo "<div class=\"row\">" ;
                while (($i < count($games)) and ($e < 9)):
        ?>
                <div class="col-md-12 col-lg-4">
                    <div class="item card shadow m-2">
                        <div class="poster overflow-hidden">			 			
                            <img style="height: 350px;" class="card-img-top" 
                                src="<?= (is_null($games[$i]->__get("img")))?"imgs/poster.jpg":$games[$i]->__get("img") ?>" />
                        </div>
                        
                        <div class="card-body">
                            <div class="text-center">
                                <a href="View/Games/GameInfo.php?id=<?= $games[$i]->__get("game_id"); ?>"><h3><?= $games[$i]->__get("name") ?></h3></a>
                            </div>
                            
                            <p class="text-truncate"><?= $games[$i]->__get("description")?></p>
                        </div>
                    </div>	
                </div>

        <?php
                $i++; 
                $e++ ;
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
                    if ($pag*9 >= count($games)) echo "siguiente" ;
                    else echo "<a href=\"index.php?p=".($pag+1)."\">siguiente</a>" ;
                ?>						
            </div>
        <?php endif ; ?>
	</div>
</body>
</html>