<?php
	session_start();
	//require_once("/includes/head.php");

	if(isset($_POST['signin'])) {
		$username= $_POST['username'];
		$password= $_POST['password'];

		if($username=="admin" && $password=="123") {
			$_SESSION['user']= $username;
			header("Location: /home/");
		}
	}
?>

<!doctype html>
<html lang="en-US">
<head>
	<title>CourseMate</title>
</head>

<body>
	<h1>Welcome to your personal course assistant!</h1>
	<h2>Log in</h2>
	<form action="index.php" method="post">
		Username: <input type="text" name="username" placeholder="Enter your username"> <br/>
		Password: <input type="password" name="password"> <br/>
		<input type="submit" name="signin" value="Sign in">
	</form>
</body>

</html>