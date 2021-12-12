<?php

    require_once __DIR__."/../controller/db/query.php";
    require_once __DIR__."/Utils.php";
    require_once __DIR__."/Genre.php";

    class Game{

        private String $game_id;
        private String $name;
        private String $description;
        private String $img;
        private ?String $releaseDate;
        private ?array $genres = [];

        public function emptyConstructor() {}

        public function constructorWithParams($id, $name, $description, $img){
            
        }

        public function __construct() {
            $arguments = func_get_args();
            $numberOfArguments = func_num_args();
      
            call_user_func_array(array($this, $numberOfArguments === 0 ? "emptyConstructor" : "constructorWithParams"), $arguments);
        }

        public function __set($name, $value){
            if(property_exists($this, $name)){
                $this->$name = $value;
            }
        }

        public function __get($name){
            if(property_exists($this, $name)){
                return $this->$name;
            }
        }

        public static function gameFromArray($arr){
            if($arr != null ){
                $game = new Game();
                foreach ($arr as $key => $value){
                    $game->__set($key, $value);
                }
                $game->__set("genres", self::getGenres($game->__get("game_id")));
                return $game;
            }else{
                return null;
            }
        }

        public static function getGameById($id){
            $sql = "SELECT * FROM game WHERE game_id = ?";
            $query = new Query();
            
            return self::gameFromArray($query->query($sql, [$id]));
        }

        public static function getGameByName($name):?Game {
            $sql = "SELECT * FROM game WHERE name = ?";
            $query = new Query();

            return self::gameFromArray($query->query($sql, [$name]));
        }

        public static function getGamesPaginated($page, $number):?Game {
            $sql = "SELECT * FROM game LIMIT ?,?";
            $query = new Query();

            return self::gameFromArray($query->query($sql, [0 , 10]));
        }

        public static function getAllGames():?array {
            $sql = "SELECT * FROM game";
            $query = new Query();

            $result = $query->queryMultiple($sql);
            $games = [];
            $i = 0;

            foreach($result as $game){
                $games[$i] = self::gameFromArray($game);
                $i++;
            }
            
            return $games;
        }

        public static function createGame($name, $description, $img, $releaseDate):?Game {
            $game = null;
            $id = Utils::generateUUID();

            if(self::getGameByName($name) === null){
                $query = new Query();

                $sql = "INSERT INTO game VALUES(?, ?, ?, ?, ?);";

                $game = self::gameFromArray($query->query($sql, [$id, $name, $description, $img, $releaseDate]));
            }
            return $game;
        }

        public static function getGamesByGenre($genre_id):?array {
            $sql = "SELECT game_id FROM gamegenres WHERE genre_id = ?";
            $query = new Query();

            $result = $query->queryMultiple($sql, [$genre_id]);
            $games = [];
            $i = 0;

            foreach($result as $game){
                $games[$i] = self::gameFromArray(self::getGameById($game["game_id"]));
                $i++;
            }
            
            return $games;
        }

        public static function getGenres($game_id){
            $sql = "SELECT genre_id FROM gamegenres where game_id = ?";
            $query = new Query();

            $result = $query->queryMultiple($sql, [$game_id]);
            $i = 0;
            $genres = [];

            foreach($result as $genre){
                $genres[$i] = Genre::getGenreById($genre["genre_id"]);
                $i++;
            }
            return $genres;
        }

        public static function addGenre($genre_id, $game_id){
            $sql = "SELECT * FROM gamegenres WHERE genre_id = ? AND game_id = ?";
            $query = new Query();

            $result = $query->query($sql, [$genre_id, $game_id]);

            if(empty($result)){
                $sql = "INSERT INTO gamegenres VALUES(?, ?);";

                $query->query($sql, [$game_id, $genre_id]);                
                return true;
            }

            return false;
        }
    }

?>