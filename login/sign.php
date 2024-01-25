<?php
require 'cek_sign.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SIGN IN</title>
	<link rel="stylesheet" type="text/css"href="../css/style-conf.css">

	
</head>
<body>
	<div class="container">
		<div class="login">
			<form action="" method="post">
				<h1>SIGN IN</h1>
				<br>
				<input type="text" id="username"  name="username" placeholder="Full your name"/>
				<input type="password" id="password" name="password" placeholder="Password"/>
				<button type="submit" class="signin" name="login" value="login">Sign In</button>
			</form>
		</div>
		<div class="right">
			<br><br><br><br><br><br><br><br>
			<h1>Hello, Friend!</h1> <br>
			<p>Please register your personal data <br> to get an account (⁠◠⁠‿⁠◕⁠)</p><br>
			<a href="register.php"><button class="signup">Sign Up</button></a>
		</div>
	</div>
	
</body>
</html>