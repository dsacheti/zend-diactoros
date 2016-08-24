<?php
require __DIR__.'/vendor/autoload.php';

$uri = new \Zend\Diactoros\Uri('http://cep.republicavirtual.com.br/web_cep.php?cep=99950000&formato=json');
//zend-diactoros não trabalha com requisição do cliente
$requesta = (new \Zend\Diactoros\Request())
    ->withUri($uri)
    ->withMethod('GET');
//para requisiççao usamos o guzzle
$guzzle = new \GuzzleHttp\Client();

$adaptador = new \Http\Adapter\Guzzle6\Client($guzzle);
$resposta = $adaptador->sendRequest($requesta);
echo 'Mensagem'.$resposta->getBody();

printf('Status do resposta %d - %s',$resposta->getStatusCode(),$resposta->getReasonPhrase());
printf("Cabeçalhos:\n");
foreach ($resposta->getHeaders() as $header=>$values) {
    printf("\t %s: %s\n",$header,implode(',',$values));
}