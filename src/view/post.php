<?php 
require_once "formsubpost.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/view.php";


$post_id = substr($_SERVER['REQUEST_URI'],1);


$post->create_table_subpost($post_id);
$all_posts->show_id_posts($post_id);
if (isset($_POST["post"])){
	$post_id_referer = substr($_SERVER['HTTP_REFERER'],17);
	echo "</ br>";
	echo "post id: " . $post_id_referer;
	echo "post data: " . $_POST["post"];
	$post->save_db_post_by_id($post_id_referer, $_POST["post"]);
}
?>
