<?php
// PHP code to delete an item from the database
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

$itemId = $_POST['itemId'];

$sql = "DELETE FROM products WHERE id='$itemId'";

if ($conn->query($sql) === TRUE) {
  echo "Item deleted successfully";
  header("location: product.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

