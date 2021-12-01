<?php

    require_once __DIR__."/../controller/db/query.php";
    require_once __DIR__."./Game.php";

    class GamesList{

        private String $list_id;
        private String $name;
        private ?String $creationDate;
        private String $user_id;
        private array $games = [];

        public function emptyConstructor() {}

        public function constructorWithParams($list_id, $name, $user_id){
            
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

        public static function listFromArray($arr){
            if($arr != null ){
                $list = new GamesList();
                foreach ($arr as $key => $value){
                    $list->__set($key, $value);
                }
                $list->__set("games", self::getGames($list->__get("list_id")));
                return $list;
            }else{
                return null;
            }
        }

        public static function getListById($id){
            $sql = "SELECT * FROM list WHERE list_id = ?";
            $query = new Query();

            return self::listFromArray($query->query($sql, [$id]));
        }

        public static function getListsByUser($user_id):?array {
            $sql = "SELECT * FROM list WHERE user_id = ?";
            $query = new Query();

            $result = $query->queryMultiple($sql, [$user_id]);
            $lists = [];
            $i = 0;

            foreach($result as $list){
                $lists[$i] = self::listFromArray($list);
                $i++;
            }

            return $lists;
        }

        public static function createList($name, $user_id):?Game {
            $list = null;
            $id = self::generateUUID();
            $date = date("Y-m-d");
            
            $sql = "SELECT * FROM list WHERE user_id = ? AND name = ?";
            $query = new Query();

            $result = self::listFromArray($query->query($sql, [$user_id, $name]));

            if($result === null){
                $sql2 = "INSERT INTO list VALUES(?, ?, ?, ?);";

                $list = self::listFromArray($query->query($sql2, [$id, $name,$date, $user_id]));
            }

            return $list;
        }

        public static function getGames($list_id){
            $sql = "SELECT game_id FROM listgames where list_id = ?";
            $query = new Query();

            $result = $query->queryMultiple($sql, [$list_id]);
            $i = 0;
            $games = [];

            foreach($result as $game){
                $games[$i] = Game::getGameById($game["game_id"]);
                $i++;
            }
            return $games;
        }

        public static function addGame($game_id, $list_id){
            $sql = "SELECT * FROM listgames WHERE game_id = ? AND list_id = ?";
            $query = new Query();

            $result = $query->query($sql, [$game_id, $list_id]);

            if(empty($result)){
                $sql = "INSERT INTO listgames VALUES(?, ?);";

                $query->query($sql, [$list_id, $game_id]);                
                return true;
            }

            return false;
        }
    }

?>