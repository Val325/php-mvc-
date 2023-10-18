<?php 
require_once "src/view.php";
require_once "functions.php";
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
    case "/about":
        about();
        break;
    case "/login":
        login();
        break;    
    case "/registration":
        registration();
        break;  
    case preg_match('/^[0-9]*$/',$_SERVER['REQUEST_URI']):
        require_once "view/form.php"; 
        $all_posts->show_all_posts_by_id(substr($_SERVER['REQUEST_URI'],1));
        break;    
    default: 
        include 'view/post.php';
        break;
}

?>