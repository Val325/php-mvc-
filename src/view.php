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
            echo "<div class='post-main'>"; 

            echo "<a href=/" . $i + 1 . "> <input type='button' <div class='btn' value='Go to Post' /></a>";
            echo "<div class='data_post'>";
            echo "<span>id: " . $posts[$i]['post'][0]['id'] . " </span>";            
            echo "<span>data: " . $posts[$i]['post'][0]['data'] . "</span> </br>";
            if (file_exists($_SERVER["DOCUMENT_ROOT"] .'/src/'. $posts[$i]['post'][0]['pathimage']) &&
                !is_dir($_SERVER["DOCUMENT_ROOT"] .'/src/'. $posts[$i]['post'][0]['pathimage'])){
                echo "<a href='src/".$posts[$i]['post'][0]['pathimage']."' >";
                echo "<img src='src/".$posts[$i]['post'][0]['pathimage']."' width='200' height='200' />";
                echo "</a>";
            }
            echo "</div>";
            echo "</div>";            
        }
    }
    public function show_id_posts($id){

        $post = $this->controller->get_model()->get_db_post($id);
        echo "<div class='post-sub'>"; 
        echo "<span>id: " . $post['id'] . " </span>";            
        echo "<span>data: " . $post['data'] . "</span> </br>";
        //print_r($posts);

            echo "<a href='src/".$post['pathimage']."' >";
            echo "<img src='src/".$post['pathimage']."' width='200' height='200' />";
            echo "</a>";
        echo "</div>";            
    }
    public function show_all_posts_by_id($id){
        try{
        $posts = $this->controller->get_model()->get_db_subpost($id);
        $amount_posts = count($posts);
        //print_r($posts);
            for($i=0; $i < $amount_posts; $i++)
            {
                echo "<div class='post-main'>"; 
                echo "<div class='data_post'>";
                print_r($posts[$i]);
                echo "<span>id: " . $posts[$i]['post'][0]['id'] . " </span>";            
                echo "<span>data: " . $posts[$i]['post'][0]['data'] . "</span> </br>";


                    echo "<a href='src/".$posts[$i]['post'][0]['pathimage']."' >";
                    echo "<img src='src/".$posts[$i]['post'][0]['pathimage']."' width='200' height='200' />";
                    echo "</a>";

                echo "</div>";
                echo "</div>";                 
            }
        }catch(TypeError $err){
            //header("Location:/");
        }
    }    
}

$all_posts = new View($control, $post);
?>
