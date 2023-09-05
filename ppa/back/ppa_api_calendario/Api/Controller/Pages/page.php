<?php

namespace Api\Controller\pages;

use Api\Utils\View;

class Page{

    /**
     * Método responsável por renderizar o Header da página
     * @return string
     */
    private static function getNav(){
        return View::render('pages/nav');
    }

    /**
     * Método responsável por renderizar o Footer da página
     * @return string
     */
    private static function getFooter(){
        return View::render('pages/footer');
    }

    /**
     * Método responsável por retornar o conteúdo (view) da nossa página genérica
     * @return string
     */
    public static function getPage($Content){
        return View::render('pages/page',[
            'content' => $Content,
            'nav' => self::getNav(),
            'footer' => self::getFooter()
        ]);
    }
}