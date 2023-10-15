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
        require_once "view/form.php"; 
        $all_posts->show_all_posts();
        break;
    case preg_match('/^[0-9]*$/',$_SERVER['REQUEST_URI']):
        require_once "view/form.php"; 
        $all_posts->show_all_posts();
        break;    
    default: 
        include 'view/post.php';
        break;
}

?>