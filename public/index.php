<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

use App\Database;
use App\CurlRequest;

$app = new \Slim\App;

/**
 * Root route shows hello to show it's working :)
 * 
 */

$app->get('/', function (Request $request, Response $response, array $args) {
    
    $response->getBody()->write("Hello");
    return $response;
});


/**
 * POST route to get request
 * 
 */

$app->post('/curl', function (Request $request, Response $response) {
    
    $data = $request->getParsedBody();

    \App\Database::init();
    $curl = new CurlRequest();

    foreach($data as $page)
    {
        $url = $page['url'];
        $title = "";

        try{

            $title = $curl->getTitle($url);
           
        }catch(\GuzzleHttp\Exception\RequestException | \GuzzleHttp\Exception\ConnectException  $e)
        {
            $status = "TIMEOUT";
        }
        
        $marfeelizable = $curl->isMarfeelizable();

        $resp['url'] = $url;
        $resp['title'] = $title;
        $resp['status'] = $status;
        $resp['marfeelizable'] = $marfeelizable;

        // We store result in a SQlite database in the database folder
        \App\Database::store($url,$title,$status,$marfeelizable);

        $respuesta[] = $resp;
        
    }

    return json_encode($respuesta);
});

$app->run();
