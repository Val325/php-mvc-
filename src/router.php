<?php 
require_once "src/view.php";
//echo $_SERVER['REQUEST_URI'];
class Router
{
    private $model;
    private $controller;
    private $file_name;
    public function __construct($controller,$model,$file) {
        $this->controller = $controller;
        $this->model = $model;
        $this->file_name = $file;
    }
}

switch($_SERVER['REQUEST_URI'])
{
    case "/": 
        $all_posts->show_all_posts();
        break;
    default: 
        include 'view/post.php';
        break;
}

?>