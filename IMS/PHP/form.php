<!DOCTYPE html>
<html lang="eng">
    <head>
<meta charset="UTF-8">
<meta name="viewport"content="width=device-width, initial-scale=1">
<link rel="stylesheet"href="\ims\css\form.css">
<style>
    #danger{
      display: none; 
      background: #f44336; 
      color: white; 
      padding: 10px;
      border-radius: 20px;
      width: 76%;
      margin-left: 3rem;
    }
</style>

</head>
<body>
    <div class="bg_image">
      <h2 class="wel">WELCOME</h2>
      <h1 class="wel">IMS</h1>
    <div class="center">
     <h1>login</h1>
     <div id="danger">wrong email or password. Please try again</div>
     <script>
      function showDanger(message){
         document.getElementById('danger').style.display = 'block';

      }
      function hideDanger(){
         document.getElementById('danger').style.display = 'none';

      }
      
    </script>
     <form id="loginForm"  method="post">
     <div class="text_field">
        <input type="email" name="email" required>
        <span></span>
        <label>email</label>
     </div>
     <div class="text_field" >
        <input type="password" name="password" required>
        <span></span>
        <label>password</label>
     </div>
    <a href="recover.html">forgoten password</a>
    <button type="submit">login</button>
     <div class="signup_link">
        not a member?<a href="/ims/html/register.html">signup</a>
     </div>
    </div>
    </div>
    <?php
 include 'connect2.php';

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Retrieve user data from the database
    $sql = "SELECT * FROM admins WHERE email = '$email' AND password = $password";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
           header("location: dashboard.php");
        } else {
          
            echo "<script>showDanger();</script>";
        }
    } else {
        echo "User not found";
  }



// Close the MySQL connection
$conn->close();
?>



         
</body>
</html>