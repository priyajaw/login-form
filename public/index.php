<?php

// echo 'hello from public folder';
// echo 'requested url="'.$_SERVER['QUERY_STRING'].'"';
// require '../App/Controller/Posts.php';

require_once dirname(__DIR__) . "/vendor/autoload.php";


spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
  
});

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');




// \www\mvc\public\index.php=_dir_;
// name=/www/mvc

// require '../Core/Router.php';


$router=new Core\Router();
// $router= new Router();
// echo get_class($router);


$router->add('',['controller'=>'home','action'=>'index']);
$router->add('posts',['controller'=>'Posts','action'=>' ']);
// $router->add('posts/new',['controller'=>'Posts/new','action'=>'new']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}',['namespace'=>'Admin']);
// $router->add('admin/{action}/{controller}');



// Display the routing table
// echo '<pre>';
// //var_dump($router->getRoutes());
// echo htmlspecialchars(print_r($router->getRoutes(), true));
// echo '</pre>';


// // Match the requested route
// $url = $_SERVER['QUERY_STRING'];

// if ($router->match($url)) {
//     echo '<pre>';
//     var_dump($router->getParams());
//     echo '</pre>';
// } else {
//     echo "No route found for URL '$url'";
// }

$router->dispatch($_SERVER['QUERY_STRING']);
// echo $_SERVER['QUERY_STRING'];
?>