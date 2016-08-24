<?php
require __DIR__.'/vendor/autoload.php';

use \Psr\Http\Message\ResponseInterface;
//use \Psr\Http\Message\RequestInterface;//voltada para envio - não quando se está trabalhando como servidor - como este caso
use \Psr\Http\Message\ServerRequestInterface;//esta é para o servidor

$server = \Zend\Diactoros\Server::createServer(
    function(ServerRequestInterface $requisicao, ResponseInterface $resposta) {
        $data = $requisicao->getParsedBody();
        if($data['email']){
            $resposta->getBody()->write("Email recebido");
            //printf("\n");
            echo $data['email'];
        }else{
            $resposta->getBody()->write("nada recebido");
        }
    },$_SERVER,$_GET,$_POST,$_COOKIE,$_FILES);
$server->listen();