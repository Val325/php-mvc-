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
        require_once "view/login.php"; 
        break;    
    case "/registration":
        registration();
        require_once "view/registration.php"; 
        break;  
    case "/exit":
        session_destroy();
        break;    
    case is_numeric(substr($_SERVER['REQUEST_URI'],1)):
        require_once "view/formsubpost.php"; 
        echo substr($_SERVER['REQUEST_URI'],1);
        $all_posts->show_id_posts(substr($_SERVER['REQUEST_URI'],1));
        $all_posts->show_all_posts_by_id(substr($_SERVER['REQUEST_URI'],1));
        break;    
    default: 
        include '404.html';
        break;
}

?>