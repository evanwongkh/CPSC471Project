<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
}

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

// Get the time and theatre ID from the URL parameter
$time = $_GET['time'];
$theatre_id = $_GET['theatreNo'];

// Get the movie ID and title from the movie table
$sql = "SELECT MovieID, Title FROM movie WHERE MovieID IN (SELECT MovieID FROM theatre WHERE theatreNo=$theatre_id)";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$movie_id = $row['MovieID'];
	$movie_title = $row['Title'];
} else {
	echo "Movie not found for this theatre.";
	exit();
}

// Get the accID from the user table
$username = $_SESSION['username'];
$sql = "SELECT AccID FROM user WHERE username='$username'";
$result = mysqli_query($conn, $sql);
if ($result === false) {
    die("Error executing query: " . mysqli_error($conn));
}
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$acc_id = $row['AccID'];
} else {
	echo "User not found.";
	exit();
}

// Insert the ticket information into the Ticket table
$sql = "INSERT INTO ticket (AccID, Time, MovieTitle) VALUES ($acc_id, '$time', '$movie_title')";
if (mysqli_query($conn, $sql)) {
	echo "Ticket booked successfully.";
} else {
	echo "Error booking ticket: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ticket Receipt</title>
</head>
<body>
	<h2>Ticket Receipt</h2>
	<table border="1">
		<tr>
			<th>Account ID</th>
			<th>Movie Title</th>
			<th>Showtime</th>
		</tr>
		<tr>
			<td><?php echo $acc_id; ?></td>
			<td><?php echo $movie_title; ?></td>
			<td><?php echo $time; ?></td>
		</tr>
	</table>
</body>
</html>
<br>
<a href="dashboard.php" class="btn btn-primary">Return to Dashboard</a>
