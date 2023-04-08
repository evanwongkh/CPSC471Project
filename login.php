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

$hashedPassword = "SELECT password FROM user WHERE username = '$username'";
$result = $conn->query($hashedPassword);

if ($result->num_rows > 0) {
    // Retrieve the hashed password
    $row = $result->fetch_assoc();
    $hashedPasswordFromDatabase = $row["password"];
}

if (password_verify($password, $hashedPasswordFromDatabase)) {
	echo "Password is valid!";
	$_SESSION['username'] = $username;
	header("Location: dashboard.php");
	exit();
} else {
	echo "Password is invalid!";
}

?>