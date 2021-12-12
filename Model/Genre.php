<?php

    require_once __DIR__."/../controller/db/query.php";
    require_once __DIR__."/Utils.php";

    class Genre{
        private String $genre_id;
        private String $name;
        private ?String $description;

        public function emptyConstructor() {}

        public function constructorWithParams($genre_id, $name, $description){
            
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

        public static function genreFromArray($arr){
            if($arr != null ){
                $genre = new Genre();
                foreach ($arr as $key => $value){
                    $genre->__set($key, $value);
                }
                return $genre;
            }else{
                return null;
            }
        }

        public static function getGenreById($id){
            $sql = "SELECT * FROM genre WHERE genre_id = ?";
            $query = new Query();

            return self::genreFromArray($query->query($sql, [$id]));
        }

        public static function getGenreByName($name):?Genre {
            $sql = "SELECT * FROM genre WHERE name = ?";
            $query = new Query();

            return self::genreFromArray($query->query($sql, [$name]));
        }

        public static function createGenre($name, $description = null):bool {
            $id = Utils::generateUUID();
            
            $sql = "SELECT * FROM genre WHERE name = ?";
            $query = new Query();

            $result = self::genreFromArray($query->query($sql, [$name]));

            if($result === null){
                $sql2 = "INSERT INTO genre VALUES(?, ?, ?);";

                $list = self::genreFromArray($query->query($sql2, [$id, $name, $description]));
                return true;
            }

            return false;
        }
    }

?>