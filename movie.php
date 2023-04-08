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

// Get the MovieID parameter from the URL
$MovieID = $_GET['id'];

// Retrieve the movie data from the database
$sql = "SELECT * FROM movie WHERE MovieID='$MovieID'";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
	// Display the movie title
	$row = mysqli_fetch_assoc($result);
	$title = $row['Title'];
	echo "<h1>$title</h1>";

	// Display the list of theaters showing the movie
	$sql = "SELECT * FROM theatre WHERE MovieID='$MovieID'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo "<h2>Theaters showing $title:</h2>";
		echo "<ul>";

		while ($row = mysqli_fetch_assoc($result)) {
			$theatreNo = $row['theatreNo'];
			echo "<li><a href='theatre.php?id=$theatreNo'>Theater $theatreNo</a></li>";
		}

		echo "</ul>";
	} else {
		echo "<p>No theaters found for $title</p>";
	}
} else {
	echo "<p>Movie not found</p>";
}

mysqli_close($conn);
?>