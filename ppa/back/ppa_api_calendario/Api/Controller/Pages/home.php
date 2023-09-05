<?php

namespace Api\Controller\pages;

use Api\Utils\View;

class Home extends Page{

    /**
     * Método responsável por retornar o conteúdo (view) da nossa home
     * @return string
     */
    public static function getHome(){
        $Content = View::render('pages/calendar',[
            
        ]);

        return parent::getPage($Content);
    }
}
