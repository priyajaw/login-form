<?php
namespace Core;

class View
{
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = "../App/Views/$view";

        if (is_readable($file)) {
            require $file;
        } else {
            echo throw new \Exception("$file not found");
        }
    }
    public static function renderTemplate($template, $args = [])
    {

        static $twig = null;
        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views/');
            $twig = new \Twig\Environment($loader, array(
                'debug' => true,
            ));
            if (session_status() != PHP_SESSION_NONE) {
                $twig->addGlobal('session', $_SESSION);
            }

        }
        echo $twig->render($template, $args);
    }
}
