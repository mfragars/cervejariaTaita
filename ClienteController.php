<?php
    include_once('Cliente.php');
    include_once('ClienteDAO.php');

    class ClienteController{
        public function selectAll($request, $response, $args){
            $dao = new ClienteDAO;
            $clientes = array();
            $clientes[] = $dao->selectAllClient();
            $response = $response->withJSON($clientes);
            return $response;
        }

        public function selectById($request, $response, $args){
            $dao = new ClienteDAO;
            $cliente = $dao->selectById($args['id']);
            $response = $response->withJSON($cliente);
            return $response;
        }

        public function insertCliente($request, $response, $args){
            $parseBody = $request->getParsedBody();
            $cliente = new Cliente(0, $parseBody['nome'], $parseBody['tipoDocumento'], $parseBody['numeroDocumento'], $parseBody['statusCliente']);
            $dao = new ClienteDAO;
            $cliente = $dao->insertClient($cliente);
            $response = $response->withJSON($cliente, 201);
            return $response;
        }

        public function updateCliente($request, $response, $args){
            $parseBody = $request->getParseBody();
            $cliente = new Cliente($args['id'], $parseBody['nome'], $parseBody['tipoDocumento'], $parseBody['numeroDocumento'], $parseBody['statusCliente']);
            $dao = new ClienteDAO;
            $cliente = $dao->updateClient($cliente);
            $response = $response->withJSON($cliente);
            return $response;
        }

        public function deleteById($request, $response, $args){
            $dao = new ClienteDAO;
            $cliente = $dao->deleteClientById($args['id']);
            $response = $response->withJSON($cliente);
            return $response;
        }
    }
?>