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
        <input type="text" name="username" required>
        <span></span>
        <label>username</label>
     </div>
     <div class="text_field" >
        <input type="password" name="password" required>
        <span></span>
        <label>password</label>
     </div>
    <button type="submit" name="login">login</button>
     </div>
    </div>
    </div>

    <?php
session_start();
    include 'connect2.php';


      
// Check if the login form is submitted
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to select the role based on the provided username and password
    $sql = "SELECT role FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        $row = $result->fetch_assoc();
        
        // Store the user's role in a session variable
        $_SESSION['ROLE'] = $row['role'];
        if( $_SESSION['ROLE'] == 'admin') {
            $_SESSION['username'] = $_POST['username'];
            header('location: dashboard.php');
                 
        }else if($_SESSION['ROLE'] == 'user') {
            $_SESSION['username'] = $_POST['username'];
            header('location: dashboard.php');
            
        }elseif($_SESSION['ROLE'] == 'mananger') {
            $_SESSION['username'] = $_POST['username'];
            header('location: dashboard.php');

        }else if($_SESSION['ROLE'] == 'staff') {
            $_SESSION['username'] = $_POST['username'];
            header('location: dashboard.php');
           

        }else {
        // Login failed
        $message[] = 'incorrect email or password';
        echo "<script>showDanger();</script>";
    }
}
}
$conn->close();

?>

</body>
</html>