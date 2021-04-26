<?php

namespace Src\Controllers;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use Laminas\Diactoros\Response\HtmlResponse;
class BaseController
{
    protected $templateEngine;

    public function __construct()
    {

        $loader = new FilesystemLoader('../view/public');
        $this->templateEngine = new Environment($loader, [
            'debug' => true,
            'cache' => false
        ]);
    }

    // este [] vacio es por que si no pasand ningun parametro 
    public function RenderHTML($filename, $data = [])
    {
        return new HtmlResponse($this->templateEngine->render($filename,$data));
    }
}
