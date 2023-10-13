<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/view.php";
$post_id = substr($_SERVER['REQUEST_URI'],1);
$all_posts->show_id_posts($post_id);
?>