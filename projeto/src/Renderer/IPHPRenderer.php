<?php
/**
 * Created by PhpStorm.
 * User: Mangueira
 * Date: 23/04/2018
 * Time: 23:05
 */

namespace JM\SON\Renderer;


interface IPHPRenderer
{
    public function setData($data);
    public function run();
}
