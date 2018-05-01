<?php
/**
 * Created by PhpStorm.
 * User: Mangueira
 * Date: 23/04/2018
 * Time: 23:07
 */

namespace JM\SON\Renderer;


class PHPRenderer implements IPHPRenderer
{
    private $data;

    public function setData($data)
    {
        $this->data = $data;
    }
    public function run()
    {
        if (is_string($this->data)) {
            header('Content-type:text/html; charset=UTF=8');
            echo $this->data;
            exit;
        }
        if (is_array($this->data)) {
            header('Content-type: application/json');
            echo json_encode($this->data);
            exit;
        }
        throw new \Exception("Data is invalid");
    }
}
