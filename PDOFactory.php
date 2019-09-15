<?php
    class PDOFactory{
        //private: para criar somente uma conexão
        private static $pdo;

        public static function getConnection(){
            if(!isset($pdo)){
                $connection = "mysql:host=localhost;dbname=cervejaria_taita";
                $user = "root";
                $pass = "";
                
                $pdo = new PDO($connection, $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES,false);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            return $pdo;
        }
    }

?>