<?php
/**
 * Created by PhpStorm.
 * User: Mangueira
 * Date: 22/04/2018
 * Time: 13:35
 */
require __DIR__.'/vendor/autoload.php';

use Pimple\Container;

use App\Model\Users;
use JM\SON\Drivers\MySqlPdo;




$app = new \JM\SON\App;
$app->setRenderer(new JM\SON\Renderer\PHPRenderer);
$container = new Container();

$container['pdo'] = function($c){
    return new PDO('mysql:host=localhost:8080;dbname=cms-14son','root','');
};

$container['model_user'] = $container->factory(function($c){
    $driver = new MySqlPdo($c['pdo']);
    $model = new Users();
    $model->setDriver($driver);
    return $model;
});

$app->setContainer($container);

$app->get('/hello/{name}', function ($params) use ($app){
    $users = $app->getContainer()['model_user'];
    $data = $users->findAll();
    var_dump($data);
    return "<h1>{$params[1]}</h1>";
});

$app->run();

