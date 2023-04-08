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

// Get the AccID from the session variable
$AccID = $_SESSION['AccID'];

// If a ticket is being cancelled, remove it from the database
if (isset($_GET['cancel'])) {
    $ticket_id = $_GET['cancel'];
    $sql = "DELETE FROM ticket WHERE ticket_id=$ticket_id AND AccID=$AccID";
    if (mysqli_query($conn, $sql)) {
        // Check if there are still tickets left
        $sql = "SELECT * FROM ticket WHERE AccID=$AccID";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "Ticket cancelled successfully.";
        }
    } else {
        echo "Error cancelling ticket: " . mysqli_error($conn);
    }
}

// Get the ticket information for the user
$sql = "SELECT * FROM ticket WHERE AccID=$AccID";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Display the ticket information in a table
    echo "<h3>My Tickets</h3>";
    echo "<table>";
    echo "<tr><th>Ticket ID</th><th>Time</th><th>Movie Title</th><th>Cancel</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['ticket_id'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['movieTitle'] . "</td>";
        echo "<td><a href=\"mytickets.php?cancel=" . $row['ticket_id'] . "\">Cancel</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No tickets found for this user.\n";
    header("refresh:5;url=dashboard.php");
    echo "The page will redirect in 5 seconds...";
}

mysqli_close($conn);
?>