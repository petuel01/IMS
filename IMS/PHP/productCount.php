<?php
    function getProductCount() {
        // Connect to the database
        $servername = "localhost";
$username = "root";
$password = "";
$dbname = "IMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
        // Query to count the number of rows in the products table
        $sql = "SELECT COUNT(*) as count FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["count"];
        } else {
            return 0;
        }


    }
    ?>