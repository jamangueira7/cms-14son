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
use Pimple\Container;

class App
{
    private $router;
    private $render;
    private $container;

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

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

}
