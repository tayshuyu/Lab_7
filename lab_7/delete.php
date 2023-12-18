<?php
session_start();

// Check if the user is logged in
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

// Check if matric parameter is set
if (!isset($_GET['matric'])) {
    echo "Matric number not specified.";
    exit();
}

$matricToDelete = $_GET['matric'];

// Delete user data based on matric number
$sql = "DELETE FROM users WHERE Matric = '$matricToDelete'";

if ($conn->query($sql) === TRUE) {
    echo "User deleted successfully!";
    
    // Redirect to display.php after deletion
    header("Location: display.php");
    exit();
} else {
    echo "Error deleting user: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
