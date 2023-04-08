<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<h1>Register</h1>
	<form action="register_process.php" method="POST">
		<label>Username:</label>
		<input type="text" name="username"><br><br>
		<label>Password:</label>
		<input type="password" name="password"><br><br>
        <label>First Name:</label>
        <input type="text" name="fname"><br><br>
        <label>Last Name:</label>
        <input type="text" name="lname"><br><br>
        <label>Date of Birth:</label>
        <input type="text" name="DOB"><br><br>



		<input type="submit" value="Register">
	</form>
</body>
</html>