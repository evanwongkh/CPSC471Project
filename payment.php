<!-- 
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "movietheatre";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$time = $_GET['time'];
$theatre_id = $_GET['theatre_id'];
$AccID = $_SESSION['AccID'];

// Get the movie ID and title from the movie table
$sql = "SELECT MovieID, Title FROM movie WHERE MovieID IN (SELECT MovieID FROM theatre WHERE theatreNo=$theatre_id)";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$movie_id = $row['MovieID'];
	$movie_title = $row['Title'];
} 
else {
	echo "Movie not found for this theatre.";
	exit();
}

if (isset($_POST['submit'])) {
    $cardNumber = $_POST['cardNumber'];
    $expiration = $_POST['expiration'];
    $cvv = $_POST['cvv'];

    // Validate payment information
    if (!is_numeric($cardNumber) || strlen($cardNumber) != 16) {
        $error = "Invalid card number.";
    } elseif (!preg_match("/^\d{2}\/\d{2}$/", $expiration)) {
        $error = "Invalid expiration date.";
    } elseif (!is_numeric($cvv) || strlen($cvv) != 3) {
        $error = "Invalid CVV.";
    } else {
        // Payment successful, create ticket

        $sql = "INSERT INTO ticket (AccID, movieID, time) VALUES ($AccID, $movie_id, '$time')";

        if (mysqli_query($conn, $sql)) {
            // Ticket created successfully, redirect to ticket page
            header("Location: ticket.php");
            exit();
        } else {
            $error = "Error creating ticket: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
</head>

<body>
    <h3>Payment Information</h3>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>" ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="cardNumber">Card Number:</label>
        <input type="text" name="cardNumber" id="cardNumber" required>
        <br>
        <label for="expiration">Expiration Date (MM/YY):</label>
        <input type="text" name="expiration" id="expiration" required>
        <br>
        <label for="cvv">CVV:</label>
        <input type="text" name="cvv" id="cvv" required>
        <br>
        <input type="submit" name="submit" value="Pay">
    </form>
</body>

</html> -->
