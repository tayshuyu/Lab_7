<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";

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

// Get user input from the form
$matric = isset($_POST['matric']) ? $_POST['matric'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
$accessLevel = isset($_POST['accessLevel']) ? $_POST['accessLevel'] : '';

// SQL query to insert data into the users table
$sql = "INSERT INTO users (Matric, Name, Password, AccessLevel) VALUES ('$matric', '$name', '$password', '$accessLevel')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
