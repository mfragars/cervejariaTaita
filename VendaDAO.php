<?php
    include_once('PDOFactory.php');
    include_once('Venda.php');

    class VendaDAO{
        public function selectAllVendas(){
            $querie = "SELECT vd.Id id, prd.nome nomeProduto, clt.nome nomeCliente, dataVenda, quantidade, vd.valorUnitario, valorTotal FROM vendas vd INNER JOIN produtos prd ON IdProd = prd.id INNER JOIN cliente clt ON clt.id = idClt";
            $dao = PDOFactory::getConnection();
            $command = $dao->prepare($querie);
            $command->execute();
            $vendas = array();
                while($row = $command->fetch(PDO::FETCH_OBJ)){
                    $vendas[] = new Venda($row->id, $row->nomeProduto, $row->nomeCliente, $row->dataVenda, $row->quantidade, $row->valorUnitario, $row->valorTotal);
                }
            return $vendas;
        }

        public function selectById($id){
            $querie = "SELECT vd.Id id, prd.nome nomeProduto, clt.nome nomeCliente, dataVenda, quantidade, vd.valorUnitario, valorTotal FROM vendas vd INNER JOIN produtos prd ON IdProd = prd.id INNER JOIN cliente clt ON clt.id = idClt WHERE vd.id = :id";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam('id', $id);
            $command->execute();
            $result = $command->fetch(PDO::FETCH_OBJ);
            return new Venda($result->id, $result->nomeProduto, $result->nomeCliente, $result->dataVenda, $result->quantidade, $result->valorUnitario, $result->valorTotal);
        }

        public function insertVenda(Venda $venda){
            $querie = "INSERT INTO vendas (idProd, idClt, dataVenda, quantidade, valorUnitario, valorTotal) VALUES ((SELECT id FROM produtos WHERE nome = :nomeProduto), (SELECT id FROM cliente WHERE nome = :nomeCliente), :dataVenda, :quantidade, :valorUnitario, :valorTotal)";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam(":nomeProduto", $venda->nomeProduto);
            $command->bindParam(":nomeCliente", $venda->nomeCliente);
            $command->bindParam(":dataVenda", $venda->dataVenda);
            $command->bindParam(":quantidade", $venda->quantidade);
            $command->bindParam(":valorUnitario", $venda->valorUnitario);
            $command->bindParam(":valorTotal", $venda->valorTotal);
            $command->execute();
            $venda->id = $pdo->lastInsertId();
            return $venda;
        }

        public function updateVenda(Venda $venda){
            $querie = "UPDATE vendas SET idProd = (SELECT id FROM produtos WHERE nome = :nomeProduto), idClt = (SELECT id FROM cliente WHERE nome = :nomeCliente), dataVenda = :dataVenda, quantidade = :quantidade, valorUnitario = :valorUnitario, valorTotal = :valorTotal WHERE id = :id";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam(":id", $venda->id);
            $command->bindParam(":nomeProduto", $venda->nomeProduto);
            $command->bindParam(":nomeCliente", $venda->nomeCliente);
            $command->bindParam(":dataVenda", $venda->dataVenda);
            $command->bindParam(":quantidade", $venda->dataVenda);
            $command->bindParam(":valorUnitario", $venda->valorUnitario);
            $command->bindParam(":valorTotal", $venda->valorTotal);
            $command->execute();
            return $venda;
        }

        public function deleteById($id){
            $querie = "DELETE FROM vendas WHERE id = :id";
            $pdo = PDOFactory::getConnection();
            $command = $pdo->prepare($querie);
            $command->bindParam("id", $id);
            $command->execute();
        }
    }

?>