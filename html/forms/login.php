<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Login</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
	<link href="../../login.css" rel="stylesheet">
</head>
<body>
	<div class="contact-form">
		<h2>Login Form</h2>
		<form action="../includes/login.php" method="post">
			<p>Email</p><input name="email" placeholder="Enter Email" type="email">
			<p>Password</p><input name="password" placeholder="Enter Password" type="password">
             <input type="submit" name="submit" value="Sign in">
             
            <p>Dont have a account? <a href="signup.php" style="color:rgb(0, 0, 0)">Sign up</a>.</p>
            <p><a href="../../index.php" style="color:rgb(0, 0, 0)">Go Back</a></p>

		</form>
	</div>
</body>
</html>