<?php
session_start();

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

// Fetch available seats for the given theatre, time, and showtime
$theatreNo = $_GET['theatreNo'];
$time = $_GET['time'];
$showtimeNo = $_GET['showtimeNo'];
$AccID = $_SESSION['AccID'];

$sql = "SELECT seat FROM ticket WHERE AccID = $AccID AND showtimeNo = '$showtimeNo'";
$result = mysqli_query($conn, $sql);

// Create an array of all seats in the theatre
$seats = range('A', 'J');
$seats = array_map(function($seatNum) {
    return $seatNum . '1,' . $seatNum . '2,' . $seatNum . '3,' . $seatNum . '4,' . $seatNum . '5';
}, $seats);
$seats = implode(',', $seats);
$seatsArray = explode(',', $seats);

// Remove seats that are already booked
while ($row = mysqli_fetch_assoc($result)) {
    $bookedSeat = $row['seat'];
    $seatsArray = array_map(function($seat) use ($bookedSeat) {
        return $seat === $bookedSeat ? 'unavailable' : $seat;
    }, $seatsArray);
}

// Display the seats in a table
echo "<table>";
$rowNum = 1;
foreach ($seatsArray as $seat) {
    if ($rowNum == 1) {
        echo "<tr>";
    }
    echo "<td>" . ($seat === 'unavailable' ? 'unavailable' : $seat . "<br><button onclick=\"goToPayment('$theatreNo', '$time', '$showtimeNo', '$seat')\">Select</button>") . "</td>";
    if ($rowNum == 5) {
        echo "</tr>";
        $rowNum = 1;
    } else {
        $rowNum++;
    }
}
echo "</table>";

// JavaScript function to redirect to the payment.php page
echo "<script>
function goToPayment(theatreNo, time, showtimeNo, seat) {
    window.location.href = 'payment.php?theatreNo=' + theatreNo + '&time=' + time + '&showtimeNo=' + showtimeNo + '&seat=' + seat;
}
</script>";
?>