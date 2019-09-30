<?php
    include_once('Venda.php');
    include_once('VendaDAO.php');

    class VendaController{
        public function selectAllVendas($request, $response, $args){
            $dao = new VendaDAO;
            $vendas = array();
            $vendas[] = $dao->selectAllVendas();
            $response = $response->withJSON($vendas);
            return $response;
        }

        public function selectVendaById($request, $response, $args){
            $id = $args['id'];
            $dao = new VendaDAO;
            $venda = $dao->selectById($id);
            return $response->withJSON($venda);
        }

        public function insertVenda($request, $response, $args){
            $parseBody = $request->getParsedBody();
            $valorTotal = $parseBody['quantidade']*$parseBody['valorUnitario'];
            $venda = new Venda(0, $parseBody['nomeProduto'], $parseBody['nomeCliente'], $parseBody['dataVenda'], $parseBody['quantidade'], $parseBody['valorUnitario'], $valorTotal);
            $dao = new VendaDAO;
            $venda = $dao->insertVenda($venda);

            return $response->withJSON($venda, 201);
        }

        public function updateVenda($request, $response, $args){
            $id = $args['id'];
            $parseBody = $request->getParsedBody();
            $venda = new Venda($id, $parseBody['nomeProduto'], $parseBody['nomeCliente'], $parseBody['dataVenda'], $parseBody['quantidade'], $parseBody['valorUnitario'], $parseBody['valorTotal']);
            $dao = new VendaDAO;
            $venda = $dao->updateVenda($venda);
            return $response->withJSON($venda);
        }

        public function deleteVendaById($request, $response, $args){
            $id = $args['id'];
            $dao = new VendaDAO;
            $venda = $dao->deleteById($id);
            return $response->withJSON($venda);
        }


    }

?>