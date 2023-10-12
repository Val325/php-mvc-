<?php
require_once "model.php";
require_once "controller.php";
class View
{
    private $model;
    private $controller;
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function show_all_posts(){

        $posts = $this->controller->get_model()->get_db_all_posts();
        $amount_posts = count($posts);
        for($i=0; $i < $amount_posts; $i++)
        {
            echo "<div class='post'>"; 
            echo "<span>id: " . $posts[$i]['post'][0]['id'] . " </span>";            
            echo "<span>data: " . $posts[$i]['post'][0]['data'] . "</span> </br>";
            echo "</div>";            
        }
    }
}

$all_posts = new View($control, $post);
?>
