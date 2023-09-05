<?php

use Api\Http\Response;
use Api\Controller\Pages;

//ROTA HOME
$obRouter->get('/',[
    function(){
        return new Response(200,Pages\home::getHome());
    }
]);