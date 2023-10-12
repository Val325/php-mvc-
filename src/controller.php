<?php
require_once "model.php";

class Controller
{
    private $model;
    public function __construct($model) {
        $this->model = $model;
    }
    public function get_model(){
        return $this->model;
    }
}
$control = new Controller($post);
?>