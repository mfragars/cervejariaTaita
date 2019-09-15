<?php
    include_once 'Produto.php';
    include_once 'PDOFactory.php';

    class ProdutoDAO{
        public function insertProd(Produto $produto){
            $querieInsert = "INSERT INTO produtos (nome, tipo, envase, valorUnitario, dataEstoque, quantidade) VALUES (:nome, :tipo, :envase, :valorUnitario, :dataEstoque, :quantidade)";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querieInsert);
            $command->bindParam(":nome", $produto->nome);
            $command->bindParam(":tipo", $produto->tipo);
            $command->bindParam(":envase", $produto->envase);
            $command->bindParam(":valorUnitario", $produto->valorUnitario);
            $command->bindParam(":dataEstoque", $produto->dataEstoque);
            $command->bindParam(":quantidade", $produto->quantidade);
            $command->execute();
            $produto->id = $pdo->lastinsertId();
            return $produto;
        }

        public function  updateProd(Produto $produto){
            $querieUpdate = "UPDATE produtos SET nome = :nome, tipo = :tipo, envase = :envase, valorUnitario = :valorUnitario, dataEstoque = :dataEstoque, quantidade = :quantidade WHERE id = :id";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querieUpdate);
            $command->bindParam(":id", $produto->id);
            $command->bindParam(":nome", $produto->nome);
            $command->bindParam(":tipo", $produto->tipo);
            $command->bindParam(":envase", $produto->envase);
            $command->bindParam(":valorUnitario", $produto->valorUnitario);
            $command->bindParam(":dataEstoque", $produto->dataEstoque);
            $command->bindParam(":quantidade", $produto->quantidade);
            $command->execute();
            return $produto;
        }

        public function searchById($id){
            $querieById = "SELECT * FROM produtos WHERE id = :id";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querieById);
            $command->bindParam("id", $id);
            $command->execute();
            $result = $command->fetch(PDO::FETCH_OBJ);
            return new Produto($result->id, $resut->nome, $result->tipo, $result->envase, $result->valorUnitario, $result->dataEstoque, $result->quantidade);
        }

        public function listAll(){
            $querieAll = "SELECT * FROM produtos";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querieAll);
            $command->execute();
            $produtos = array();
                while($row = $command->fetch(PDO::FETCH_OBJ)){
                    $produtos[] = new Produto($row->id,$row->nome,$row->tipo,$row->envase,$row->valorUnitario,$row->dataEstoque,$row->quantidade);
                }
            return $produtos;
        }

        public function deleteById($id){
            $querieDelete = "DELETE FROM produtos WHERE id = :id";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querieDelete);
            $command->bindParam("id", $id);
            $command->execute();
        }
    }

?>