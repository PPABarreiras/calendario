<?php

use Api\Http\Router;
use Api\Utils\View;
use Api\Controller\pages\Home;

require __DIR__ . '/config/app.php';

#define('URL','http://localhost/ppa_api_calendario');

//INICIA O ROUTER
$obRouter = new Router(URL);

/**
 * exit;
 * echo Home::getHome();
 */

View::init([
    'URL' => URL
]);



//INCLUI AS ROTAS DA API
#include __DIR__ . '/Api/Routes/pages.php';

// IMPRIME O RESPONSE DA ROTA
$obRouter->run()
  ->sendResponse();

