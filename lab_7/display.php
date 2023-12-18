<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
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

    // SQL query to retrieve data from the users table
    $sql = "SELECT Matric, Name, AccessLevel FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display table header
        echo "<table border='1'>";
        echo "<tr><th>Matric Number</th><th>Name</th><th>Level</th><th colspan='2'>Action</th></tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Matric"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["AccessLevel"] . "</td>";
            echo "<td><a href='update.php?matric=" . $row["Matric"] . "'>Update</a></td>";
            echo "<td><a href='delete.php?matric=" . $row["Matric"] . "'>Delete</a></td>";
            echo "</tr>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
