<?php
namespace App\Helper\HTTP\Response;

class View
{
    /**
     * @param string $template
     * @param array $parameters
     */
    public static function render(string $template, array $parameters = [])
    {
        ob_start();
        //extract everything in param into the current scope
        extract($parameters, EXTR_SKIP);
        include($template);
    }
}