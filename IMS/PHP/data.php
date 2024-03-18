<?php
include 'connect.php';

$sql = "SELECT SUM(total) as total_amount, WEEK(time) as week_number FROM sales GROUP BY WEEK(time)";
$result = $conn->query($sql);

$salesData = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $salesData[] = $row;
  }
}

echo json_encode($salesData);

$conn->close();
?>
