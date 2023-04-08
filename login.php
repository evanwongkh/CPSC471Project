<?php
// Start a session
session_start();

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

// Validate the user's credentials
$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
	// The user is authenticated
	$_SESSION['username'] = $username;
	header("Location: dashboard.php");
	exit();
} else {
	// The user is not authenticated
	echo "Invalid username or password.";
}
?>