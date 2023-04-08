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
$AccID = $_SESSION['AccID'];
$time = $_GET['time']; 
$theatreNo = $_GET['theatreNo']; 


if (isset($_POST['submit'])) {
    $cardNumber = $_POST['cardNumber'];
    $expiration = $_POST['expiration'];
    $cvv = $_POST['cvv'];
    $theatreNo = $_POST['theatreNo'];
    $time = $_POST['time'];

    // Validate payment information
    if (!is_numeric($cardNumber) || strlen($cardNumber) != 16) {
        $error = "Invalid card number.";
    } elseif (!preg_match("/^\d{2}\/\d{2}$/", $expiration)) {
        $error = "Invalid expiration date.";
    } elseif (!is_numeric($cvv) || strlen($cvv) != 3) {
        $error = "Invalid CVV.";
    } else {
        // Payment successful, redirect to ticket page
        header("Location: ticket.php?theatreNo=$theatreNo&time=$time");
        exit();
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
        <input type="hidden" name="theatreNo" value="<?php echo $theatreNo; ?>">
        <input type="hidden" name="time" value="<?php echo $time; ?>">
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

</html>