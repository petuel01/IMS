<?php
// PHP code to insert the submitted item into the database
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

$pname = $_POST['p_name'];
$pprice = $_POST['p_price'];
$pquantity = $_POST['p_quantity'];
$description = $_POST['description'];
$pitem = $_POST['p_item'];
$pcateg = $_POST['p_categ'];

$imageName = $_FILES['image']['name'];
$imageData = file_get_contents($_FILES['image']['tmp_name']);
$imageData = $conn->real_escape_string($imageData); 


$sql= "SELECT * FROM products WHERE p_name = '$pname'";
$result = $conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
  $newqtt = $row['p_quantity'] + $pquantity;
  $updatesql ="UPDATE products SET p_quantity= $newqtt WHERE p_name = '$pname'";
  $conn->query($updatesql);
  header("location: product.php");
}else{

$sql = "INSERT INTO products ( p_name, p_price, p_quantity, description, p_item, p_categ, image) VALUES ('$pname','$pprice', '$pquantity', '$description', '$pitem', '$pcateg','$imageData')";

if ($conn->query($sql) === TRUE) {
  header("Location: product.php"); // Redirect back to the main page
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>
