<?php

    require_once __DIR__."/../controller/db/query.php";
    require_once __DIR__."/Utils.php";

    class User{
        private String $user_id;
        private String $userName;
        private String $email;
        private String $registerDate;
        private String $password;

        public function emptyConstructor() {}

        public function constructorWithParams($id, $userName, $email, $password){
            
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

        public static function userFromArray($arr){
            if($arr != null ){
                $user = new User();
                foreach ($arr as $key => $value){
                    $user->__set($key, $value);
                }
                return $user;
            }else{
                return null;
            }
        }

        public static function getUserById($id){
            $sql = "SELECT * FROM user WHERE user_id = ?";
            $query = new Query();

            return self::userFromArray($query->query($sql, [$id]));
        }

        public static function getUserByEmail($email):?User {
            $sql = "SELECT * FROM user WHERE email = ?";
            $query = new Query();

            return self::userFromArray($query->query($sql, [$email]));
        }

        public static function getUserByName($userName):?User {
            $sql = "SELECT * FROM user WHERE userName = ?";
            $query = new Query();

            return self::userFromArray($query->query($sql, [$userName]));
            
        }

        public static function createUser($userName, $email, $password):?User {
            $user = null;
            $id = Utils::generateUUID();
            $date = date("Y-m-d");

            if(self::getUserByEmail($email) === null && self::getUserByName($userName) === null){
                $query = new Query();

                $sql = "INSERT INTO user VALUES(?, ?, ?, ?, ?);";

                $password = trim(password_hash($password, PASSWORD_BCRYPT));

                $user = self::userFromArray($query->query($sql, [$id, $userName, $email, $date, $password]));
            }
            return $user;
        }
    }
?>