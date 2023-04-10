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

$seatImage = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32pt" height="32pt" version="1.1" viewBox="0 0 700 500">
<path xmlns="http://www.w3.org/2000/svg" d="m536.67 256.67h-23.336v-140c0-18.566-7.375-36.371-20.5-49.5-13.129-13.125-30.934-20.5-49.5-20.5h-186.66c-18.566 0-36.371 7.375-49.5 20.5-13.125 13.129-20.5 30.934-20.5 49.5v140h-23.336c-12.375 0-24.246 4.9141-32.996 13.668-8.7539 8.75-13.668 20.621-13.668 32.996v186.67c0 6.1875 2.457 12.125 6.832 16.5s10.312 6.832 16.5 6.832h70c6.1875 0 12.125-2.457 16.5-6.832s6.832-10.312 6.832-16.5v-23.332h233.34v23.332c0 6.1875 2.457 12.125 6.832 16.5s10.312 6.832 16.5 6.832h70c6.1875 0 12.125-2.457 16.5-6.832s6.832-10.312 6.832-16.5v-186.67c0-12.375-4.9141-24.246-13.668-32.996-8.75-8.7539-20.621-13.668-32.996-13.668zm-303.34 116.66c0-6.1875 2.4609-12.121 6.8359-16.496 4.375-4.3789 10.309-6.8359 16.5-6.8359h186.67-0.003907c6.1914 0 12.125 2.457 16.5 6.8359 4.375 4.375 6.8359 10.309 6.8359 16.496v46.668h-233.34zm0-256.66c0-6.1914 2.4609-12.125 6.8359-16.5s10.309-6.8359 16.5-6.8359h186.67-0.003907c6.1914 0 12.125 2.4609 16.5 6.8359s6.8359 10.309 6.8359 16.5v190.87c-7.4844-2.7188-15.375-4.1406-23.336-4.2031h-186.66c-7.9609 0.0625-15.852 1.4844-23.336 4.2031zm-70 186.66h23.336v163.33l-23.336 0.003907zm373.33 163.33-23.332 0.003907v-163.34h23.332z"/>
</svg>';

$seatUnavailable = '<div class="unavailable-seat"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32pt" height="32pt" version="1.1" viewBox="0 0 700 500">
<path xmlns="http://www.w3.org/2000/svg" d="m536.67 256.67h-23.336v-140c0-18.566-7.375-36.371-20.5-49.5-13.129-13.125-30.934-20.5-49.5-20.5h-186.66c-18.566 0-36.371 7.375-49.5 20.5-13.125 13.129-20.5 30.934-20.5 49.5v140h-23.336c-12.375 0-24.246 4.9141-32.996 13.668-8.7539 8.75-13.668 20.621-13.668 32.996v186.67c0 6.1875 2.457 12.125 6.832 16.5s10.312 6.832 16.5 6.832h70c6.1875 0 12.125-2.457 16.5-6.832s6.832-10.312 6.832-16.5v-23.332h233.34v23.332c0 6.1875 2.457 12.125 6.832 16.5s10.312 6.832 16.5 6.832h70c6.1875 0 12.125-2.457 16.5-6.832s6.832-10.312 6.832-16.5v-186.67c0-12.375-4.9141-24.246-13.668-32.996-8.75-8.7539-20.621-13.668-32.996-13.668zm-303.34 116.66c0-6.1875 2.4609-12.121 6.8359-16.496 4.375-4.3789 10.309-6.8359 16.5-6.8359h186.67-0.003907c6.1914 0 12.125 2.457 16.5 6.8359 4.375 4.375 6.8359 10.309 6.8359 16.496v46.668h-233.34zm0-256.66c0-6.1914 2.4609-12.125 6.8359-16.5s10.309-6.8359 16.5-6.8359h186.67-0.003907c6.1914 0 12.125 2.4609 16.5 6.8359s6.8359 10.309 6.8359 16.5v190.87c-7.4844-2.7188-15.375-4.1406-23.336-4.2031h-186.66c-7.9609 0.0625-15.852 1.4844-23.336 4.2031zm-70 186.66h23.336v163.33l-23.336 0.003907zm373.33 163.33-23.332 0.003907v-163.34h23.332z"/>
</svg>';
?>

<html>
    <style>
    .unavailable-seat {
        fill: red;
    }
    </style>
</html>

<?php
// Create an array of all seats in the theatre
$seats = range('A', 'G');
$seats = array_map(function($seatNum) {
    return $seatNum . '1,' . $seatNum . '2,' . $seatNum . '3,' . $seatNum . '4,' . $seatNum . '5';
}, $seats);
$seats = implode(',', $seats);
$seatsArray = explode(',', $seats);

// Get an array of all booked seats
$bookedSeats = array();
while ($row = mysqli_fetch_assoc($result)) {
    $bookedSeats[] = $row['seat'];
}

?>
<div style="display: flex; justify-content: center;">
<?php

// Display the seats in a table
echo "<table>";
$rowNum = 1;
foreach ($seatsArray as $seat) {
    if ($rowNum == 1) {
        echo "<tr>";
    }

    // Replace the button with an SVG image
    if (in_array($seat, $bookedSeats)) {
        echo "<td>";
        echo $seat;
        echo "<br>";
        echo '<div style="color: red;">';
        echo $seatUnavailable;
        echo "</div>";
        echo "</td>";
    } else {
        echo "<td>";
        echo '<div onclick="goToPayment(\'' . $theatreNo . '\', \'' . $time . '\', \'' . $showtimeNo . '\', \'' . $seat . '\')" style="cursor:pointer">';
        echo $seat;
        echo "<br>";
        echo $seatImage;
        echo "</div>";
        echo "</td>";
    }
    
    if ($rowNum == 5) {
        echo "</tr>";
        $rowNum = 1;
    } else {
        $rowNum++;
    }
}
echo "</table>";
?>
</div>

<?php
// JavaScript function to redirect to the payment.php page
echo "<script>
function goToPayment(theatreNo, time, showtimeNo, seat) {
    window.location.href = 'payment.php?theatreNo=' + theatreNo + '&time=' + time + '&showtimeNo=' + showtimeNo + '&seat=' + seat;
}
</script>";
?>