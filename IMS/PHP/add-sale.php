<?php 
include 'connect.php';

$name = $_POST['pname'];
$qtt = $_POST['p-qtt'];
$price = $_POST['p-price'];
$amt = $_POST['total'];
$time = $_POST['datetime'];
$newamt = $price * $qtt;

$sql = "SELECT p_quantity FROM products WHERE p_name = '$name'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $quantity = $row['p_quantity'];


$sql = "INSERT INTO sales ( p_name, p_qtt, p_price, total, time) VALUES ('$name','$qtt','$price','$newamt', '$time')";
if ($conn->query($sql) === TRUE) {
  $newqtt = $quantity - $qtt;
  $sql = "UPDATE products SET p_quantity = $newqtt WHERE p_name = '$name'";
  if($conn->query($sql) === TRUE){
    echo "product succesfully updated";
    header("Location: sales.php"); // Redirect back to the main page
  }else{
    echo "product not updated";
  }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}else{
    echo "products not found in database";
}
$conn->close();

?>