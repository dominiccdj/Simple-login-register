<?php

// Connection to the database
$link = new mysqli("localhost", "root", "", "login");

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Get username and password from login screen and remove
// empty spaces, slashes and convert special characters to HTML
// entities to avoid possible SQL injection
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["user"]);
    $password = test_input($_POST["pass"]);
}

if ($_POST['action'] == 'Login') {
    // Login button was clicked so we proceed to try to log the user on

    // Create query for fetching suiting username and password
    $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password' ";
    $result = $link->query($sql);

    // If there is an user found with our username and password, it can log in
    if ($result->num_rows == 1) {
        echo " Login successful! Welcome: " . $username;
    } else {
        echo "Login Failed!";
    }

    // Close the connection with database
    $link->close();
} else if ($_POST['action'] == 'Register') {
    // Register button was clicked so we register the new user

    // Connection to the database
    $link = new mysqli("localhost", "root", "", "login");

    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

    // Get username and password from login screen
    $username = $password = "";

    // Removing empty spaces, slashes and converting special characters to HTML
    // entities to avoid possible SQL injection
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["user"]);
        $password = test_input($_POST["pass"]);
    }

    // Create query for fetching suiting username and password
    // to see if user already exists
    $sql = "SELECT * FROM users WHERE username = '$username' ";
    $result = $link->query($sql);

    // If there is an user found with our username and password, it can log in
    if ($result->num_rows > 0) {
        echo " User already exists!";
    } else {
        // User doesn't exist so it can be registered

        // Create query for creating new user in the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password') ";

        if ($link->query($sql) === true) {
            echo "New user registered successfully";
        } else {
            echo "Couldn't register a new user! Error: " . $sql . "<br>" . $link->error;
        }
    }

    // Close the connection with database
    $link->close();
}

// Function removes empty spaces, slashes and converts special characters to HTML
// entities to avoid possible SQL injection
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
