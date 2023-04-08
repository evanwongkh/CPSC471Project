<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <p>Don't have an account? <a href="register.php">Register</a></p>
    <form action="login.php" method="POST">
    <div class='box'>
        <div class='container'>
            <div class="top-header">
                <span>Login here!</span>
                <header>Login</header>
            </div>

            <div class="input-field">
                    <input type="text" name="username" class='input' placeholder='Username...' required><br><br>
            </div>

            <div class="input-field">
                    <input type="password" name="password" class='input' placeholder='Password...' required><br><br>
            </div>

            <div class="input-field">
                    <input type="submit" value="Login" class='submit'>
            </div>
        </div>
    </div>
    </form>
</body>
</html>