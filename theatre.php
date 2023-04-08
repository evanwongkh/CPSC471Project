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

// Get the theatre ID from the URL parameter
$theatreNo = $_GET['id'];

// Get the theatre data from the database
$sql = "SELECT * FROM theatre WHERE theatreNo=$theatreNo";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	// Display the theatre data
	$row = mysqli_fetch_assoc($result);
	$movie_id = $row['MovieID'];
	echo "<h1>Theatre " . $row['theatreNo'] . "</h1>";
	echo "<p>Movie ID: " . $movie_id . "</p>";

	// Get the movie data from the database
	$sql = "SELECT * FROM movie WHERE MovieID=$movie_id";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// Display the movie data
		$row = mysqli_fetch_assoc($result);
		echo "<h2>" . $row['Title'] . "</h2>";
	}

	// Get the showtimes data from the database
	$sql = "SELECT * FROM showtimes WHERE theatreNo=$theatreNo";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// Display the showtimes data
		echo "<h3>Showtimes</h3>";
		echo "<ul>";
		while ($row = mysqli_fetch_assoc($result)) {
            $time = $row['time'];
			echo "<li><a href='ticket.php?theatreNo=$theatreNo&time=$time'>" . $row['time'] . "</a></li>";
		}
		echo "</ul>";
	} else {
		echo "No showtimes available.";
	}
} else {
	echo "Theatre not found.";
}

mysqli_close($conn);
?>