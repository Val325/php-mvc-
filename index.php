<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/styles.css">
	<title>Main</title>
</head>
<body>
	<h1>
		Notes 
		<?php
			if (isset($_SESSION["user_name"]) && $_SESSION["user_name"]) {
				echo $_SESSION["user_name"];
				echo "<span class='exit_nav'> Exit </span>";
			}else{
				echo "<span class='register'>Register </span>";
				echo "<span class='login_nav'>Login </span>";
				
			}
			
		?>
		
		
		 
		
	</h1>
<h3>Note input data</h3>


<?php 

require_once "src/router.php";

//header("Location:/");
?>
</body>
</html>
<script type = "text/javascript">
    let exit = document.querySelector('.exit_nav');
    exit.addEventListener('click', function() {
        window.location = "/exit";
    });
</script>