<?php

// https://github.com/slimphp/Slim/blob/4.x/README.md

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

/**
 * Instantiate App
 *
 * In order for the factory to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */
$app = AppFactory::create();

// Add Routing Middleware
$app->addRoutingMiddleware();

/**
 * Add Error Handling Middleware
 *
 * @param bool $displayErrorDetails -> Should be set to false in production
 * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool $logErrorDetails -> Display error details in error log
 * which can be replaced by a callable of your choice.
 
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response, $args) {

    $response->getBody()->write("Hello World!");
    return $response;
});

// Run app
$app->run();


/* https://m.correios.com.br/enviar-e-receber/precisa-de-ajuda/manual_rastreamentoobjetosws.pdf

    Para buscar o status do objeto , basta enviar uma requisição
    para o arquivo " rastreio.php " dentro de " api " .
    O arquivo " rastreio.php " buscara o status do objeto no próprio site dos correios
*/

/*
$obj = 'OA016913717BR'; //"CODIGO DE RASTREIO"
$url = "http://localhost/api/rastreio.php?obj={$obj}";
$rastreio = file_get_contents($url);*/

/*$rastreio = json_encode([
    ['date'=> '12/12/2020',
        'hour'=> '02:22',
        'location'=> 'Macapa/AP',
        'action'=> 'sdga ',
        'message'=> 'sdga'
    ],
    [
        'date'=> '13/01/2021',
        'hour'=> '23:12',
        'location'=> 'Sao Paulo/SP',
        'action'=> 'KLA JGO4 GKL4Ç H',
        'message'=> 'LASJG RJÇ KRJÇ HOI OEJ EOTHJAEOIT'
    ]
]);*/
//echo $rastreio; // imprime o JSON da resposta do rastreio
/*
require_once('./generateHTML.php');
generateHTML($rastreio, $obj);*/