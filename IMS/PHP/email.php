<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post">
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" required><br>

  <label for="email">Email:</label>
  <input type="email" name="email" id="email" required><br>

  <label for="password">Password:</label>
  <input type="password" name="password" id="password" required><br>

  <input type="submit" value="Register" name="send">
</form>
<?php
if(isset($_POST['send'])){
  // Server-side validation (example using filter_var())
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password']; // Consider password hashing for security
  
  if (!$name || !$email || !$password) {
    echo "Please fill in all required fields.";
    exit;
  }
  
  // Email content (customize as needed)
  $subject = "Registration Confirmation for " . $name;
  $message = "Thank you for registering! Your account details are:\n\nName: " . $name . "\nEmail: " . $email;
  
  // Email sending (using mail() for basic scenarios)
  $headers = "From: noreply@yourwebsite.com" . "\r\n" .
            "Reply-To: " . $email . "\r\n" .
            "Content-Type: text/plain; charset=UTF-8";
  
  if (mail($email, $subject, $message, $headers)) {
    echo "Registration successful! An email confirmation has been sent to " . $email;
    header('location: email.php');
  } else {
    echo "Error sending email. Please try again later.";
  }
}
  ?>
</body>
</html>