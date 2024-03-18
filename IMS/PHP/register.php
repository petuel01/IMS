<?php
// Establish a connection to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_info";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

 // Function to check if an email already exists
function isEmailExists($email, $conn) {
    $query = "SELECT COUNT(*) as count FROM admins WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

// Example usage:
$emailToCheck = 'email';
$usernameToCheck = 'username';

if (isEmailExists($emailToCheck, $conn)) {
    echo "Email already exists. Please choose a different one.";
} else {
    // Insert user data into the database
    $sql = "INSERT INTO admins (name, email, password) VALUES ('$username','$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Registration sucessfull";
        echo "<script>alert('$message');</script>";
        header("location: /ims/html/form.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

// Close the MySQL connection
$conn->close();
?>
