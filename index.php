<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/styles.css">
	<title>Main</title>
</head>
<body>
	<h1>Notes</h1>
<h3>Note input data</h3>
<div class="form">
	<form action="src/model.php" method="POST">
      	<textarea name="post" rows="4" cols="50"></textarea><br>
    		<input type="submit" value="Отправить">
	</form>
</div>

<?php 
require_once "src/view.php";
$all_posts->show_all_posts();
?>
</body>
</html>
