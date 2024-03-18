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
    <title>Dashboard</title>
    <link rel="stylesheet" href="\ims\css\dashboard.css">
    <link rel="stylesheet" href="\ims\source\fontawesome-free-5.15.4-web\fontawesome-free-5.15.4-web\css\all.css">
    <link rel="stylesheet" href="\ims\css\add-products.css">
    <link rel="stylesheet" href="\ims\css\order.css">
    <script type="text/javascript" src="\ims\js\script.js"></script>
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
    <section>
        <h4 class="haed">Add New Orders</h4>
        <div class="container">
            <p class="label">Client Name</p>
            <input type="text" placeholder="enter client name">
            <p class="label">Client Adress</p>
            <input type="text" placeholder="enter client adreess">
            <p class="label">Phone Adress</p>
            <input type="text" placeholder="enter Clients Phone">
            <div class="prod" id="clone">
                <p class="lab">Product</p>
                <select name="prod" id="select1" class="inpu" style="background: rgb(206, 205, 219);">
             ">
                    <?php 
                    
                    include 'connect.php';
                     
                    $sql = "SELECT p_name FROM productS";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo '<option value='.$row['p_name'].' >'.$row['p_name'].'</option>';
                        }
                    }else{
                        echo '<option >no data found</option>';
                    }
                    $conn->close();
                    ?>
                </select>
                <p class="lab">Qtt</p>
                <input type="numbers" class="inp">
                <p class="lab">Amount</p>
                <input type="dolar" class="inp">
                <button class="plus lab" onclick="cloneRow(this)">+</button>
                <button class="times " onclick="delRow(this)">x</button>
            </div>
            <script>
                function cloneRow(button){
                    var parentRow = button.parentNode;
                    var cloneRow = parentRow.cloneNode(true);
                    clearInputValues(cloneRow);
                    document.getElementById('clone').appendChild(cloneRow);

                }
                function delRow(button){
                    var parentRow = button.parentNode;
                    if(document.getElementById('clone').childElementCount > 1){
                        parentRow.remove();
                    }
                
                }
               
            </script>
            
            <div class="math">
                <label >Net anount</label>
                <input type="text" class="mane">
                <label >Discount</label>
                <input type="text" class="mane">
                <label >Charges</label>
                <input type="text" class="mane">
                <label >Paid status</label>
                <input type="text" class="mane">

            </div>
            <br>
            <br>
            <hr>
            <div class="btns">
            <button class="save">Create Order</button>
            <button class="back">Cancel</button>
            </div>
        </div>
    </section>
</body>
</html>