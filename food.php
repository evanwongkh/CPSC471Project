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

if (isset($_POST['submit'])) {
    $name = $_POST['food'];
    $quantity = $_POST['quantity'];
    $price = $quantity * 10;

    // Insert order into database
    $sql = "INSERT INTO food (AccID, name, price) VALUES ('$AccID', '$name', '$price')";

    if (mysqli_query($conn, $sql)) {
        $message = "Order placed successfully.";
    } else {
        $error = "Error placing order: " . mysqli_error($conn);
    }
}

if (isset($_POST['cancel'])) {
    $OrderNumber = $_POST['OrderNumber'];

    // Delete order from database
    $sql = "DELETE FROM food WHERE OrderNumber=$OrderNumber";
    mysqli_query($conn, $sql);
}

$sql = "SELECT * FROM food WHERE AccID = '$AccID' ";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Food Menu</title>
</head>

<body>
    <h3>Food Menu</h3>
    <?php if (isset($message)) echo "<p style='color:green'>$message</p>" ?>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>" ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="food">Food Item:</label>
        <select name="food" id="food" required>
            <option value="">--Select--</option>
            <option value="Burger">Burger</option>
            <option value="Pizza">Pizza</option>
            <option value="Fries">Fries</option>
            <option value="Salad">Salad</option>
        </select>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>
        <br>
        <input type="submit" name="submit" value="Order">
    </form>

    <h3>Ordered Food</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Food Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['OrderNumber']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Price']; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="OrderNumber" value="<?php echo $row['OrderNumber']; ?>">
                            <input type="submit" name="cancel" value="Cancel">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>


</body>

</html>