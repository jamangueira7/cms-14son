<?php
/**
 * Created by PhpStorm.
 * User: Mangueira
 * Date: 22/04/2018
 * Time: 13:35
 */
require __DIR__.'/vendor/autoload.php';


$app = new \JM\SON\App;
$app->setRenderer(new JM\SON\Renderer\PHPRenderer);

$app->get('/hello/{name}', function ($params){
    return "<h1>{$params[1]}</h1>";
});

$app->run();

