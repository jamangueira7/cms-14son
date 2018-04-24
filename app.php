<?php
/**
 * Created by PhpStorm.
 * User: Mangueira
 * Date: 22/04/2018
 * Time: 13:35
 */
require __DIR__.'/vendor/autoload.php';
use JM\SON\Router\Router;
use JM\SON\DI\Resolver;
$path_info = $_SERVER['PATH_INFO'] ?? '/';
$request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET' ;

$route = new Router($path_info,$request_method);

class User
{
    public function __construct($name = 'User class')
    {
        echo $name;
    }
}

$route->get('/hello/{name}', function ($params, User $model){
    return 'Meu nome é ' . $params[1];
});

$result = $route->run();

$data = (new Resolver)->method($result['callback'],[
    'params' => $result['params']
]);
var_dump( $data);
