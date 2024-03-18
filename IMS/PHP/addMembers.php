<?php
include 'connect2.php';

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Name"];
    $password = $_POST["Pass"];
    $role = $_POST["Role"];

    // Insert user data into the database
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        header("location: profile.php");
        echo "<script>showDanger();</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }


// Close the MySQL connection
$conn->close();
?>
