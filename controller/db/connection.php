<?php

    class DbConnection{
        private static $instance = null;
        private $db;
        public $url;

        private function __construct(){
            $this->connect();
        }

        private function connect():void {
            $host = "localhost";
            $user = "root";
            $password = "";
            $dbname = "proyectophp";

            $this->url = "mysql:dbname=$dbname;host=$host";
            
            try{
                $this->setDb(new PDO($this->url, $user, $password));                
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        private function __clone() {}

        private function setDb($value){
            $this->db = $value;
        }

        public function __get($property){
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        public static function getInstance(){
            if(self::$instance == null){
                self::$instance = new DbConnection();
            }
            return DbConnection::$instance;
        }

        public function Login(String $username, String $password):bool {
            $gsent = $this->db->prepare("SELECT password FROM user WHERE username = ?");

            $gsent->execute(array($username));
            
            $hash = $gsent->fetch();

            return password_verify($password, $hash["password"]);
        }

        public function register(String $username,String $email, String $password):bool {
            $gsent = $this->db->prepare("SELECT * FROM user WHERE (username = ?) OR (email = ?)");
            $gsent->execute(array($username, $email));
            
            $user = $gsent->fetch();

            if($user == null){
                $gsent = $this->db->prepare("INSERT INTO user VALUES('', ?, ?, ?);");

                $password = trim(password_hash($password, PASSWORD_BCRYPT));

                return $gsent->execute(array($username, $email, $password));                ;
            }else{
                return false;
            }
        }

        public function __destruct(){
            //$this->__get("db")->close();
        }
    }

?>