<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
</head>
<body>
	<h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
	<p>You are now logged in to the dashboard.</p>
	<a href="logout.php">Logout</a>
</body>
</html>

<?php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "movietheatre";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM movie";
$result = mysqli_query($conn, $sql);
?>

<div style="text-align: center;">
<?php
// Check if there are any results
while ($row = mysqli_fetch_assoc($result)) {
	$MovieID = $row['MovieID'];
	$title = $row['Title'];
	echo "<a href='movie.php?id=$MovieID'>$title</a><br>";
}
?>
</div>

<a href="mytickets.php" class="btn btn-primary">View My Tickets</a>

