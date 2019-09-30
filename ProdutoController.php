<?php
    include_once('Produto.php');
    include_once('ProdutoDAO.php');

    class ProdutoController{
        public function selectAll($request, $response, $args){
            $dao = new ProdutoDAO;
            $produtos = array();
            $produtos[] = $dao->listAll();
            $response = $response->withJSON($produtos);
            return $response;
        }

        public function selectById($request, $response, $args){
            $dao = new ProdutoDAO;
            $produto = $dao->searchById($args['id']);
            $response = $response->withJSON($produto);
            return $response;
        }

        public function insertProduto($request, $response, $args){
            $parseBody = $request->getParsedBody();
            $produto = new Produto(0, $parseBody['nome'], $parseBody['tipo'], $parseBody['envase'], $parseBody['valorUnitario'], $parseBody['dataEstoque']);
            $dao = new ProdutoDAO;
            $produto = $dao->insertProd($produto);
            $response = $response->withJSON($produto,201);
            return $response;
        }

        public function updateProduto($request, $response, $args){
            $parseBody = $request->getParsedBody();
            $produto = new Produto($args['id'], $parseBody['nome'], $parseBody['tipo'], $parseBody['envase'], $parseBody['valorUnitario'], $parseBody['dataEstoque']);
            $dao = new ProdutoDAO;
            $produto = $dao->updateProd($produto);
            $response = $response->withJSON($produto);
            return $response;
        }

        public function deleteById($request, $response, $args){
            $dao = new ProdutoDAO;
            $produto = $dao->deleteById($args['id']);
            $response = $response->withJSON($produto);
            return $response;
        }
    }

?>