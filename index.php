<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
include_once('ProdutoController.php');
include_once('ClienteController.php');
include_once('UsuarioController.php');
include_once('VendaController.php');



require __DIR__ . './vendor/autoload.php';

$app = AppFactory::create();

$app->group('/api/produtos', function($app){
    $app->get('', 'ProdutoController:selectAll');
    $app->get('/{id}', 'ProdutoController:selectById');
    $app->post('', 'ProdutoController:insertProduto');
    $app->put('/{id}', 'ProdutoController:updateProduto');
    $app->delete('/{id}', 'ProdutoController:deleteById');
})->add('UsuarioController:validaToken');

$app->group('/api/clientes', function($app){
    $app->get('', 'ClienteController:selectAll');
    $app->get('/{id}', 'ClienteController:selectById');
    $app->post('', 'ClienteController:insertCliente');
    $app->put('/{id}', 'ClienteController:updateCliente');
    $app->delete('/{id}', 'ClienteController:deleteById');
})->add('UsuarioController:validaToken');

$app->group('/api/vendas', function($app){
    $app->get('', 'VendaController:selectAllVendas');
    $app->get('/{id}', 'VendaController:selectVendaById');
    $app->post('', 'VendaController:insertVenda');
    $app->put('/{id}', 'VendaController:updateVenda');
    $app->delete('{id}', 'VendaController:deleteVendaById');
})->add('UsuarioController:validaToken');

$app->group('/api/usuarios', function($app){
    $app->get('', 'UsuarioController:listar');
    $app->post('', 'UsuarioController:insertUsers');
})->add('UsuarioController:validaToken');

$app->group('/api/auth', function($app){
    $app->post('', 'UsuarioController:validaUser');
});

$app->run();

?>