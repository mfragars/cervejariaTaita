<?php
    include_once('PDOFactory.php');
    include_once('Usuario.php');

    class UsuarioDAO{
        public function insertUser(Usuario $usuario){
            $querie = "INSERT INTO users (nome, login, senha) VALUES (:nome, :login, :senha)";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam(":nome", $usuario->nome);
            $command->bindParam(":login", $usuario->login);
            $command->bindParam(":senha", $usuario->senha);
            $command->execute();
            $usuario->id = $pdo->lastInsertId();
            return $usuario;
        }

        public function selectAllUsers(){
            $querie = "SELECT * FROM users";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->execute();
            $usuarios = array();
            while($row = $command->fetch(PDO::FETCH_OBJ)){
                $usuarios[] = new Usuario($row-id, $row->nome, $row->login,$row->senha);
            }
            return $usuarios;
        }

        public function selectOneUser($login){
            $querie = "SELECT * FROM users where login = :login";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam("login", $login);
            $command->execute();
            $result = $command->fetch(PDO::FETCH_OBJ);
            return new Usuario($result->id, $result->nome, $result->login, $result->senha);
        }
    }

?>