<?php
/**
 * Created by PhpStorm.
 * User: Mangueira
 * Date: 23/04/2018
 * Time: 23:19
 */

namespace JM\SON;

use JM\SON\Router\Router;
use JM\SON\DI\Resolver;
use JM\SON\Renderer\IPHPRenderer;

class App
{
    private $router;
    private $render;

    public function __construct()
    {
        $path_info = $_SERVER['PATH_INFO'] ?? '/';
        $request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET' ;

        $this->router = new Router($path_info, $request_method);
    }

    public function setRenderer(IPHPRenderer $render)
    {
        $this->render = $render;
    }

    public  function get(string $path, $fn)
    {
        $this->router->get($path, $fn);
    }

    public  function post(string $path, $fn)
    {
        $this->router->post($path, $fn);
    }

    public function run()
    {
        $route = $this->router->run();
        $resolver = new Resolver;

        $data = $resolver->method($route['callback'], ['params'=>$route['params']]);
        $this->render->setData($data);
        $this->render->run();
    }

}
