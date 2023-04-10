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

// Check if user is an admin
$sql = "SELECT * FROM user WHERE AccID='$AccID' AND admin=1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    $error_message = "You do not have the necessary permissions to access this page.";
    header("Location: dashboard.php?error_message=".urlencode($error_message));
    exit();
}

// Add movie to database
if (isset($_POST['submit_movie'])) {
    $movie_title = $_POST['movie_title'];

    $sql = "INSERT INTO movie (Title) VALUES ('$movie_title')";

    if (mysqli_query($conn, $sql)) {
        $message = "Movie added successfully.";
    } else {
        $error = "Error adding movie: " . mysqli_error($conn);
    }
}

// Add theatre to database
if (isset($_POST['submit_theatre'])) {
    $MovieID = $_POST['MovieID'];

    $sql = "INSERT INTO theatre (MovieID) VALUES ('$MovieID')";

    if (mysqli_query($conn, $sql)) {
        $message = "Theatre added successfully.";
    } else {
        $error = "Error adding theatre: " . mysqli_error($conn);
    }
}

// Add showtime to database
if (isset($_POST['add_showtime'])) {    
    $theatreNo = mysqli_real_escape_string($conn, $_POST['theatreNo']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $convertedTime = date('h:i A', strtotime($time));
    // Insert the showtime into the database
    $sql = "INSERT INTO showtimes (theatreNo, time) VALUES ('$theatreNo', '$convertedTime')";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Showtime added successfully.</p>";
    } else {
        echo "<p>Error adding showtime: " . mysqli_error($conn) . "</p>";
    }
}

// Delete movie from database
if (isset($_POST['delete_movie'])) {
    $MovieID = $_POST['MovieID'];
    $sql = "DELETE FROM movie WHERE MovieID=$MovieID";
    mysqli_query($conn, $sql);
}

// Delete theatre from database
if (isset($_POST['delete_theatre'])) {
    $theatreNo = $_POST['theatreNo'];
    $sql = "DELETE FROM theatre WHERE theatreNo=$theatreNo";
    mysqli_query($conn, $sql);
}

// Delete showtime from database
if (isset($_POST['delete_showtime'])) {
    $showtimeNo = $_POST['showtimeNo'];
    $sql = "DELETE FROM showtimes WHERE showtimeNo=$showtimeNo";
    mysqli_query($conn, $sql);
}

// Retrieve movies from database
$sql = "SELECT * FROM movie";
$movie_result = mysqli_query($conn, $sql);

// Retrieve theatres from database
$sql = "SELECT * FROM theatre";
$theatre_result = mysqli_query($conn, $sql);

$sql = "SELECT * FROM showtimes";
$showtime_result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
</head>

<body>
    <h3>Admin Panel</h3>
    <?php if (isset($message)) echo "<p style='color:green'>$message</p>" ?>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>" ?>
    <h4>Add Movie</h4>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="movie_title">Movie Name:</label>
        <input type="text" name="movie_title" id="movie_title" required>
        <br>
        <!-- <label for="movie_description">Description:</label>
        <textarea name="movie_description" id="movie_description" required></textarea>
        <br> -->
        <input type="submit" name="submit_movie" value="Add Movie">
    </form>

    <h4>Enter the movie ID that the new theatre is showing</h4>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="MovieID">Movie ID:</label>
        <input type="text" name="MovieID" id="MovieID" required>
        <br>
        <!-- <label for="theatre_location">Location:</label>
        <input type="text" name="theatre_location" id="theatre_location" required>
        <br> -->
        <input type="submit" name="submit_theatre" value="Add Theatre">
    </form>

    <h4>Add Showtime</h4>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="theatreNo">Theatre Number:</label>
        <input type="text" name="theatreNo" required>
        <br><br>
        <label for="time">Time:</label>
        <input type="time" name="time" required>
        <br><br>
        <input type="submit" name="add_showtime" value="Add Showtime">
    </form>

    <h4>Movies</h4>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($movie_result)) : ?>
                <tr>
                    <td><?php echo $row['MovieID']; ?></td>
                    <td><?php echo $row['Title']; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="MovieID" value="<?php echo $row['MovieID']; ?>">
                            <input type="submit" name="delete_movie" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h4>Theatres</h4>
    <table>
        <thead>
            <tr>
                <th>Theatre Number</th>
                <th>Movie ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($theatre_result)) : ?>
                <tr>
                    <td><?php echo $row['theatreNo']; ?></td>
                    <td><?php echo $row['MovieID']; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="theatreNo" value="<?php echo $row['theatreNo']; ?>">
                            <input type = "submit" name = "delete_theatre" value = "Delete">
                            </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h4>Showtimes</h4>
    <table>
        <thead>
            <tr>
                <th>Showtime Number</th>
                <th>Theatre Number</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($showtime_result)) : ?>
                <tr>
                    <td><?php echo $row['showtimeNo']; ?></td>
                    <td><?php echo $row['theatreNo']; ?></td>
                    <td>
                        <?php 
                            $time = date("h:i A", strtotime($row['time'])); 
                            echo $time;
                        ?>
                    </td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="showtimeNo" value="<?php echo $row['showtimeNo']; ?>">
                            <input type="submit" name="delete_showtime" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>