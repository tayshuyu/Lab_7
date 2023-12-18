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

$matricToUpdate = $_GET['matric'];

// Fetch user data based on matric number
$sql = "SELECT Matric, Name, AccessLevel FROM users WHERE Matric = '$matricToUpdate'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Display a form for updating user data
    echo "<h2>Update User</h2>";
    echo "<form action='update_process.php' method='post'>";
    echo "<label for='matric'>Matric Number:</label>";
    echo "<input type='text' id='matric' name='matric' value='" . $row['Matric'] . "' readonly><br>";
    echo "<label for='name'>Name:</label>";
    echo "<input type='text' id='name' name='name' value='" . $row['Name'] . "' required><br>";
    echo "<label for='accessLevel'>Access Level:</label>";
    echo "<input type='text' id='accessLevel' name='accessLevel' value='" . $row['AccessLevel'] . "' required><br>";
    echo "<input type='submit' value='Update'>";echo "<a href='display.php'>Cancel</a>";
    echo "</form>";
} else {
    echo "User not found.";
}

// Close the database connection
$conn->close();
?>
