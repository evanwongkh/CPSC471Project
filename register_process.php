<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "movietheatre";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the user's input
$username = $_POST['username'];
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['DOB'];

// Calculate age based on date of birth
$now = new DateTime();
$birthdate = new DateTime($dob);
$age = $now->diff($birthdate)->y;

// Check if the username already exists in the database
$sql = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	// The username is already taken
	echo "Username is already taken.";
} else {
	// Insert the new user into the database
	$sql = "INSERT INTO user (username, password, Fname, Lname, DOB, age) VALUES ('$username', '$hashedPassword', '$fname', '$lname', '$dob', '$age')";
	mysqli_query($conn, $sql);

	// Redirect the user to the login page
	header("Location: index.php");
	exit();
}
?>