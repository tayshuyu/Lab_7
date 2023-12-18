<?php
session_start();

if (!isset($_SESSION['matric'])) {
    header("Location: login.html");
    exit();
}

// Database connection parameters
$servername = "localhost";
$username = "shuyu";
$password = "shuyu0412";
$dbname = "lab_7";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the update form
$matricToUpdate = isset($_POST['matric']) ? $_POST['matric'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$accessLevel = isset($_POST['accessLevel']) ? $_POST['accessLevel'] : '';

// SQL query to update data in the users table
$sql = "UPDATE users SET Name = '$name', AccessLevel = '$accessLevel' WHERE Matric = '$matricToUpdate'";

// Execute the query
if ($conn->query($sql) === TRUE) {
    header("Location: display.php");
    exit();
} else {
    echo "Error updating user data: " . $conn->error;
}

// Close the database connection
$conn->close();
?>