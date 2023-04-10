<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['AccID'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "movietheatre";

// Connect to database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get discount data based on user's AccID
$AccID = $_SESSION['AccID'];
$sql = "SELECT * FROM discount WHERE AccID='$AccID'";
$result = mysqli_query($conn, $sql);

// Display discount data to user

if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr>
                <th>Discount ID</th>
                <th>Discount Name</th>
                <th>Discount Percentage</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['DiscountID'] . "</td>
                <td>" . $row['DiscountName'] . "</td>
                <td>" . $row['DiscountPercentage'] . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No discounts found for your account.";
}

mysqli_close($conn);
?>

