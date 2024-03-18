<?php
session_start();

// Check if the user is logged in and has a role set in the session
if(!isset($_SESSION['ROLE'])) {
    header("Location: userlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user info</title>
    <link rel="stylesheet" href="\ims\css\dashboard.css">
    <link rel="stylesheet" href="\ims\source\fontawesome-free-5.15.4-web\fontawesome-free-5.15.4-web\css\all.css">
    <link rel="stylesheet" href="user.css">
    <script type="text/javascript" src="\ims\js\script.js"></script>
    <style>
        .user{
            width: 90%;
            margin-left: 6%;
            padding: 2rem;
            margin-top: 5.6rem;
            align-items: center;
            justify-content: center;
            background: green;
            margin-bottom: 2rem;
            border-radius: 10px;
        }
        .user h5{
            text-align: center;
            font-size: .9rem;
        }
        .user input{
            text-align: center;
            width: 80%;
            margin-left: 10%;
            font-size: .9rem;
        }
        .user input[type=submit]{
            background-color: green;

        }
        .user input[type=submit]:hover{
            background: black;
            color: white;
            transform: scale(1.15);
        }
        @media screen and (max-width: 700px){
            .user input,
            .user h5{
                font-size: .6rem;
            }
        }
    </style>
</head>
<body>
<nav class="horizontal">
    <header><i class="fas fa-shopping-cart"></i>I.M.S</header>
    </nav>
    <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times" id="cancel"></i>
        </label>
    
    
        <div class="sidebar">
            <ul class="list">
                <li class="item "><a href="dashboard.php" class="hov itemLink "><i class="fas fa-tachometer-alt" id="icon"></i>Dashboard</a></li>
                <li class="item"><a href="item.php" class="itemLink"><i class="fas fa-qrcode" id="icon"></i>Categories</a>
                </li>
                <li class="item"><a href="#" class="itemLink" onclick="hover()"><i class="fab fa-product-hunt" id="icon"></i>Products</a>   
                <ul class="sublist1">
                    <script>
                        function hover(){
                        document.querySelector('.sublist1').style.display ='block';
                        }
                    </script>
                    <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' ) {
               echo'
                        <li class="subitem"><a href="add-product.php" class="sublink" ><i class="fas fa-plus"></i></i> Add Products</a></li>';
                    } ?>
                        <li class="subitem"><a href="product.php" class="sublink"><i class="fas fa-layer-group"></i> Manage Products</a></li>
                    </ul>
                </li>
                <li class="item"><a href="#" class="itemLink" onclick="hover2()"><i class="fas fa-truck" id="icon"></i>Orders</a>   
                <ul class="sublist2">
                <script>
                        function hover2(){
                        document.querySelector('.sublist2').style.display ='block';
                        }
                    </script>
                    <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' ) {
               echo'
                        <li class="subitem"><a href="order.php" class="sublink" ><i class="fas fa-plus"></i></i> Add Order</a></li>';
                    } ?>
                        <li class="subitem"><a href="manage-orders.php" class="sublink"><i class="fas fa-layer-group"></i> Manage Orders</a></li>
                    </ul>
                </li>
                <script>
                        function hover3(){
                        document.querySelector(".sublist3").style.display ="block";
                        }
                    </script>
 <li class="item"><a href="customer.php" class="itemLink"><i class="fas fa-users" id="icon"></i>Customers</a></li>
                <li class="item"><a href="supliers.html" class="itemLink"><i class="fas fa-user" id="icon"></i>Suppliers</a></li>
                <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' || $_SESSION['ROLE'] == 'seller' ) {
               echo'
                <li class="item"><a href="#" class="itemLink" onclick="hover3()"><i class="fas fa-dollar-sign" id="icon"></i>Sales</a>
                <ul class="sublist3">
               
                        <li class="subitem"><a href="add-sales.php" class="sublink" ><i class="fas fa-plus"></i></i> Add Sales</a></li>
                        <li class="subitem"><a href="sales.php" class="sublink"><i class="fas fa-layer-group"></i> Manage Sales</a></li>
                    </ul>
                </li>'; } ?>
                <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' ) {
               echo'
                <li class="item"><a href="profile.php" class="itemLink"><i class="fas fa-address-book" id="icon"></i>User Management</a></li>';
                 } ?>
                  <li class="item"><a href="setings.php" class="itemLink"><i class="fas fa-cog" id="icon"></i>settings</a>
                <li class="item"><a href="\ims\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>
            </ul>
        </div>
<section >
   <?php  
    include 'connect2.php';
    $name = $_SESSION['username'];
    $edit_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$name' ") or die('query failed');
    if(mysqli_num_rows($edit_query)){
     while($fetch_edit = mysqli_fetch_assoc($edit_query)){
        
 ?>
 <h3>Account info</h3>
 <input type="hidden" name="up_id" value="<?php echo $fetch_edit['id'] ?>" >
 <h5>username</h5>
 <input type="text" name="up_name" value="<?php echo $fetch_edit['username'] ?>" readonly>
 <form method="post">
    <h5>Enter your Old-Password</h5>
    <input type="password" name="old-pass" placeholder="old password">
    <h5>Enter your New-Password</h5>
    <input type="password" name="new-pass" placeholder="new password">
    <input type="submit" name="save" value="Save Changes" >
 </form>
 </form>
 <?php
    }
  }

 
   
  if(isset($_POST['save'])){
    $oldpass = $_POST['old-pass'];
    $newpass = $_POST['new-pass'];
    $edit_pass = mysqli_query($conn, "SELECT password FROM users WHERE name = '$name' ") or die('query failed');
    if(mysqli_num_rows($edit_pass)){
        while($row = mysqli_fetch_assoc($edit_pass)){
            $pass = $row['password'];
        }
        if($pass == $oldpass){
            $change_pass = mysqli_query($conn,"UPDATE users SET password = '$newpass' WHERE name = '$name'") or die('query failed');
            $message[] = 'password chsnged successfully';
        }else{
            $message[] = 'wrong password';
        }
    
  }

  }      


   ?>
</section>
</body>
</html>