<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
include_once 'ProdutoDAO.php';

require __DIR__ . './vendor/autoload.php';

$app = AppFactory::create();
$app->get('/api/produtos', function(Request $request, Response $response, array $args){
    $dao = new ProdutoDAO;
    $produtos = array();
    $produtos[] = $dao->listAll();
    $response = $response->withJSON($produtos);
    return $response;
});

$app->get('/api/produtos/{id}', function(Request $request, Response $response, $args){
    $dao = new ProdutoDAO;
    $produto = $dao->searchById($args['id']);
    $response = $response->withJSON($produto);
    return $response;
});

$app->post('/api/produtos', function(Request $request, Response $response, $args){
    $parseBody = $request->getParsedBody();
    $produto = new Produto(0, $parseBody['nome'], $parseBody['tipo'], $parseBody['envase'], $parseBody['valorUnitario'], $parseBody['dataEstoque'], $parseBody['quantidade']);
    $dao = new ProdutoDAO;
    $produto = $dao->insertProd($produto);
    $response = $response->withJSON($produto)->withHeader('content-type', 'application/json');
    return $response;
});

$app->put('/api/produtos/{id}', function(Request $request, Response $response, $args){
    $parseBody = $request->getParsedBody();
    $produto = new Produto($args['id'], $parseBody['nome'], $parseBody['tipo'], $parseBody['envase'], $parseBody['valorUnitario'], $parseBody['dataEstoque'], $parseBody['quantidade']);
    $dao = new ProdutoDAO;
    $produto = $dao->updateProd($produto);
    $response = $response->withJSON($produto);
    return $response;
});

$app->delete('/api/produtos/{id}', function(Request $request, Response $response, $args){
    $dao = new ProdutoDAO;
    $produto = $dao->deleteById($args['id']);
    $response = $response->withJSON($produto);
    return $response;
});



$app->run();

?>