<?php

// https://github.com/slimphp/Slim/blob/4.x/README.md

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

use \Classes\Page;
use \Classes\Track;
use \Classes\Mail;


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

    $page = new Page();
    $page->setTpl("index");
    exit;
});

/* Define app routes ----------------------------------------------------------------------- */
// return page with track response (html)
$app->get('/track/{code}', function (Request $request, Response $response, $args) {
    $obj = $args['code']; //"CODIGO DE RASTREIO"

    /*$response->getBody()->write("Hello, $obj");
    return $response;*/
    $page = new Page([
        "header"=>true,
        "footer"=>false
    ]);

    $page->setTpl("headerResult");

    $track = new Track();
    $html = $track->trackObject($obj);
    $response->getBody()->write($html);
    return $response;
    exit;
});

// return JSON with API response 
$app->get('/api/{code}', function (Request $request, Response $response, $args) {
    $obj = $args['code'];
    $track = new Track();
    echo $track->getJSON($obj);
    exit;
});

$app->get('/email', function (Request $request, Response $response, $args) {
    $page = new Page();
    $page->setTpl("formEmail");
    exit;
});

// sends the response to an email
$app->get('/email/send/{email}', function (Request $request, Response $response, $args) {
    $toAdress = $args['email'];

    //value of GET param
    $obj = $request->getUri()->getQuery();
    $obj = explode('=', $obj);

    $track = new Track();
    $html = $track->trackObject($obj[1]);
    echo $track->sendMail($toAdress, $html);
    exit;
});

// Run app
$app->run();