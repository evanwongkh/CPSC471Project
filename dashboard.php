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