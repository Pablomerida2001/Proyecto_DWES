<?php

    require_once "connection.php";

    class Query{
        protected $table_name;
        protected $primary_key;

        public $db;

        public function __construct(){
            $this->db = DbConnection::getInstance()->__get("db");
        }

        public function query($sql, $params = null){
            $statement = $this->db->prepare($sql);
            $params != null ? $statement->execute($params) : $statement->execute();
           
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function queryMultiple($sql, $params = null){
            $statement = $this->db->prepare($sql);

            $params != null ? $statement->execute($params) : $statement->execute();
           
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    } 

?>