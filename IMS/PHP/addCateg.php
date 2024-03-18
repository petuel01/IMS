<?php
include 'connect.php';

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cname = $_POST["c_name"];

    // Insert user data into the database
    $sql = "INSERT INTO categories (c_name) VALUES ('$cname')";
    
    if ($conn->query($sql) === TRUE) {
        header("location: item.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }


// Close the MySQL connection
$conn->close();
?>
