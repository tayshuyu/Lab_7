<?php
session_start();

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

// Get user input from the login form
$matric = isset($_POST['matric']) ? $_POST['matric'] : '';
$password_input = isset($_POST['password']) ? $_POST['password'] : '';

// SQL query to retrieve user data for authentication
$sql = "SELECT Matric, Password, AccessLevel FROM users WHERE Matric = '$matric'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verify the password
    if (password_verify($password_input, $row['Password'])) {
        // Authentication successful
        $_SESSION['matric'] = $row['Matric'];
        $_SESSION['accessLevel'] = $row['AccessLevel'];
        
        header("Location: display.php"); 
        exit();
    }
    else {
        // Authentication failed
        echo "Invalid username or password, try <a href='login.html'>login</a> again.";
        exit();
    }
}
else {
    echo "Invalid username or password, try <a href='login.html'>login</a> again.";
    exit();
} 

// Close the database connection
$conn->close();
?>
