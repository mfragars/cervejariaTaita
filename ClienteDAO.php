<?php
    include_once 'PDOFactory.php';
    include_once 'Cliente.php';

    class ClienteDAO{
        public function insertClient(Cliente $cliente){
            $querie = "INSERT INTO cliente (nome, tipoDocumento, numeroDocumento, statusCliente) VALUES (:nome, :tipoDocumento, :numeroDocumento, :statusCliente)";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam(":nome", $cliente->nome);
            $command->bindParam(":tipoDocumento", $cliente->tipoDocumento);
            $command->bindParam(":numeroDocumento", $cliente->numeroDocumento);
            $command->bindParam(":statusCliente", $cliente->statusCliente);
            $command->execute();
            $cliente->id = $pdo->lastInsertId();
            return $cliente;
        }

        public function updateClient(Cliente $cliente){
            $querie = "UPDATE cliente SET nome = :nome, tipoDocumento = :tipoDocumento, numeroDocumento = :numeroDocumento, statusCliente = :statusCliente";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam(":nome", $cliente->nome);
            $command->bindParam(":tipoDocumento", $cliente->tipoDocumento);
            $command->bindParam(":numeroDocumento", $cliente->numeroDocumento);
            $command->bindParam(":statusCliente", $cliente->statusCliente);
            $command->execute();
            return $cliente;
        }

        public function selectById($id){
            $querie = "SELECT * FROM cliente WHERE id = :id";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam("id", $id);
            $command->execute();
            $result = $command->fetch(PDO::FETCH_OBJ);
            return new Cliente($result->id, $result->nome, $result->tipoDocumento, $result->numeroDocumento, $result->statusCliente);
        }

        public function selectByName($nome){
            $querie = "SELECT * FROM cliente WHERE nome LIKE :nome";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $nome = $nome."%";
            $command->bindParam("nome", $nome);
            $command->execute();
            $clientes = array();
                while($row = $command->fetch(PDO::FETCH_OBJ)){
                    $clientes[] = new Cliente($row->id, $row->nome, $row->tipoDocumento, $row->numeroDocumento, $row->statusCliente);
                }
            return $clientes;
        }

        public function selectAllClient(){
            $querie = "SELECT * FROM cliente";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->execute();
            $clientes = array();
                while($row = $command->fetch(PDO::FETCH_OBJ)){
                    $clientes[] = new Cliente($row->id, $row->nome, $row->tipoDocumento, $row->numeroDocumento, $row->statusCliente);
                }
            return $clientes;
        }

        public function deleteClientById($id){
            $querie = "DELETE FROM cliente WHERE id = :id";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam("id", $id);
            $command->execute();
        }
    }

?>