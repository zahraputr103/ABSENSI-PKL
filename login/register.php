<?php 

require '../config/koneksi.php';

if (isset($_POST["signup"]) > 0) {

	if (registrasi($_POST) > 0) {
		echo "<script>
				alert ('User Added!');
				document.location.href='sign.php';
				</script>";
	}
	else {
		echo mysqli_error($conn);
	}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css"href="../css/style-conf.css">

	
</head>
<body>
	<div class="container">
		<div class="left">
			<br><br><br><br><br><br><br><br>
			<h1>Welcome Back!</h1> <br>
			<p>To keep connected with us <br>Please login with your personal info</p><br>
			<a href="sign.php"><button class="signin">Sign In</button></a>
		</div>
		<div class="register">
			<form action="" method="post">
				<h1>Creat Acount</h1>
				<br>	
				<input type="text" id="username" name="username" placeholder="Full your Name"/>
				<input type="password" id="password" name="password" placeholder="Password"/>
				<input type="password" id="password2" name="password2" placeholder="Confirm Password">
				<select name="tingkat" value="tingkat">
				<option value="tingkat">Pilih tingkatan anda</option>
					<option value="siswa">Siswa</option>
				</select>
				<button type="submit" class="signup" name="signup" id="signup">Sign Up</button>
			</form>
		</div>
	</div>
	
</body>
</html>