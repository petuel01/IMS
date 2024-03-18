<?php
include 'connect.php';
session_start();

// Check if the user is logged in and has a role set in the session
if(!isset($_SESSION['ROLE'])) {
    header("Location: userlogin.php");
    exit();
}else{
    echo $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="\ims\css\dashboard.css">
    <link rel="stylesheet" href="\ims\source\fontawesome-free-5.15.4-web\fontawesome-free-5.15.4-web\css\all.css">
    <link rel="stylesheet" href="\ims\css\products.css">
    <script type="text/javascript" src="\ims\js\script.js"></script>
    <style>
        .message_container{
            height: 97vh;
        }
        .message_box{
            background: white;
            width: 96%;
            height: 90%;
            margin-left: 2%;
            border-radius: 15px;
            margin-top: 2rem;
            overflow-y: auto;
        }
        .message_send form{
            display: inline;
            padding: 1vh;
            width: 98%;
            height: 10vh;
            background-color: lightblue;
            position: fixed;
            bottom: 0;
            margin: .2rem;
            border-radius: 4px;
        }
        .message_send input{
            height: 6.7vh;
            width: 70%;
            margin: 1rem;
            border-radius: 15px;
        }
        .message_send form button{
            width: 10%;
            height: 6vh;
        }
        .mess-box{
            margin: 1rem;

        }
        .mess{
            background-color: blue;
            color: white;
            width: 100%;
            border-radius: 15px;
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
    <section class="down">
      <div class="message_container">
        <div class="message_box">
         <h1>messages: <?php print_r($_SESSION['username'])?></h1>
         <?php 
           $sql = mysqli_query($conn,'SELECT * FROM messages') or die ('querry failed');
           if(mysqli_num_rows($sql) > 0) {
            while($row = mysqli_fetch_assoc($sql)) {
                ?>
           <div class="mess-box">
            <p class="mess"><?php echo $row['message'] ?></p>
            <span class="sender"><?php echo $row['sender'] ?></span>
         </div>
                <?php

           }
        } else {
            echo 'failed';
        }
         ?>
        </div>
        <div class="message_send">
            <form method="post">
            <input type="text" placeholder="enter message" name="message">
            <button type="submit" class="send" name="send">send</button>
            </form>
            <?php
            if(isset($_POST['send'])){
             $message = $_POST['message'];
             $name = $_SESSION['username'];
             echo "Message: " . $message . "<br>";
             echo "Username: " . $name . "<br>";

             $sql = mysqli_query($conn, "INSERT INTO messages (message, sender) VALUES ('$message', '$name')") or die(mysqli_error($conn));
             if($sql){
                $message[] = 'message sent successfully';
             }else{
                $message[] = 'something went wrong';
             }
            }
            ?>
        </div>
       
      </div>
    </section>
</body>
</html>