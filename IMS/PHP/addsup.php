<?php
include 'connect.php';

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sname = $_POST["s_name"];
    $address = $_POST["s_addres"];
    $phone = $_POST["s_phone"];
    $product = $_POST["s_product"];

    // Insert user data into the database
    $sql = "INSERT INTO supliers (sname, address, phone, product) VALUES ('$sname', '$address', '$phone', '$product')";
    
    if ($conn->query($sql) === TRUE) {
        header("location: supliers.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }


// Close the MySQL connection
$conn->close();
?>
