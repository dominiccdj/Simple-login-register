<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <meta name="author" content="dominiccdj">
</head>

<body>

    <div id="frm">
        <form action="process.php" method="post">
            <p>
                <label for="user">Username:</label>
                <input type="text" name="user" id="user" required>
            </p>
            <p>
                <label for="user">Password:</label>
                <input type="password" name="pass" id="pass" required>
            </p>

            <hr>

            <div id="buttons">
                <input type="submit" class="btn" id="logBtn" name="action" value="Login">
                <input type="submit" class="btn" id="regBtn" name="action" value="Register">
            </div>

        </form>
    </div>

</body>

</html> 