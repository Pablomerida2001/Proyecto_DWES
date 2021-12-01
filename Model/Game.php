<?php

    require_once __DIR__."/../controller/db/query.php";

    class Game{

        private String $game_id;
        private String $name;
        private String $description;
        private String $img;
        private ?String $releaseDate;

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

        public static function generateUUID($data = null){
            // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
            $data = $data ?? random_bytes(16);
            assert(strlen($data) == 16);

            // Set version to 0100
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            // Set bits 6-7 to 10
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

            // Output the 36 character UUID.
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        public static function gameFromArray($arr){
            if($arr != null ){
                $game = new Game();
                foreach ($arr as $key => $value){
                    $game->__set($key, $value);
                }
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

        public static function createGame($name, $description, $img, $releaseDate = null):?Game {
            $game = null;
            $id = self::generateUUID();

            if(self::getGameByName($name) === null){
                $query = new Query();

                $sql = "INSERT INTO game VALUES(?, ?, ?, ?, ?);";

                $game = self::gameFromArray($query->query($sql, [$id, $name, $description, $img, $releaseDate]));
            }
            return $game;
        }
    }

?>