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
    <link rel="stylesheet" href="\ims\css\products.css">
    <script type="text/javascript" src="\ims\js\script.js"></script>
    <style>
        body{
            font-family: verdana;
        }
                td{
            text-align: center;
            font-size: 20px;
            padding-top: .5rem;
            margin-bottom: .5rem;
            color: grey;
            
            border-bottom: 1px solid blue;
        }
        #edit, #del{
            height: 2.7rem;
            color: white;
            margin-bottom: 1rem;
            border-radius: 8px;
            border: none;
        }
        #edit{
            background: blue;
            width: 2.5rem;

        }
        #del{
            background: red;
            width: 3.5rem;
        }
       
         .confirmation-dialog {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            height: 150px;
            width: 200px;
            background-color: #042331;
            border: 1px solid #ccc;
            z-index: 1000;
        }
        .poster{
            margin-top: 4.6rem;
            margin-left: 2.6rem

        }
        .col{
            color: white;
            font-size: 20px;
            text-align: center;
        }
        .edit-form{
            
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border-radius: 14px;
            height: 350px;
            width: 350px;
            background: #042331;
            z-index: 1000;

        }
        #editForm{
            display: grid;
            position: relative;
            height: 100%;
            
            
        }
        input{
            width: 100%;
            height: 2rem;
            border-radius: 12px;
            padding: 5px;
            text-align: center;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        label{
            color: white;
            font-size: medium;
        }
        .sav, .sava{
            width: 3.5rem;
            height: 2.5rem;
            padding: 5px;
            color: white;
            position: absolute    
        }
        .sav{
            
            right: 1rem;
            bottom: 1rem;
            background: red;
        }
        .sava{
            right: 5rem;
            bottom: 1rem;
            background: blue;
        }
        .active{
            color: white;
            font-size: 1rem;
            background: green;
            height: 3rem;
            width: 4rem;
            border: none;
            border-radius: 10px;
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
                <li class="item "><a href="dashboard.php" class="itemLink "><i class="fas fa-tachometer-alt" id="icon"></i>Dashboard</a></li>
                <li class="item"><a href="item.php" class="itemLink"><i class="fas fa-qrcode" id="icon"></i>Categories</a>
                </li>
                <li class="item"><a href="#" class="itemLink" onclick="hover()"><i class="fab fa-product-hunt" id="icon"></i>Products</a>   
                <ul class="sublist1">
                    <script>
                        function hover(){
                        document.querySelector('.sublist1').style.display ='block';
                        }
                    </script>
                        <li class="subitem"><a href="add-product.php" class="sublink" ><i class="fas fa-plus"></i></i> Add Products</a></li>
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
                        <li class="subitem"><a href="order.php" class="sublink" ><i class="fas fa-plus"></i></i> Add Order</a></li>
                        <li class="subitem"><a href="manage-oders.php" class="sublink"><i class="fas fa-layer-group"></i> Manage Orders</a></li>
                    </ul>
                </li>
                <script>
                        function hover3(){
                        document.querySelector(".sublist3").style.display ="block";
                        }
                    </script>
                <?php if($_SESSION['ROLE'] != 'user') {
               echo' <li class="item"><a href="customer.php" class="itemLink"><i class="fas fa-users" id="icon"></i>Customers</a></li>
                <li class="item"><a href="supliers.php" class="hov itemLink"><i class="fas fa-user" id="icon"></i>Suppliers</a></li>
                <li class="item"><a href="#" class="itemLink" onclick="hover3()"><i class="fas fa-dollar-sign" id="icon"></i>Sales</a>
                <ul class="sublist3">
               
                        <li class="subitem"><a href="add-sales.php" class="sublink" ><i class="fas fa-plus"></i></i> Add Sales</a></li>
                        <li class="subitem"><a href="sales.php" class="sublink"><i class="fas fa-layer-group"></i> Manage Sales</a></li>
                    </ul>
                </li>
                
                <li class="item"><a href="profile.php" class="itemLink"><i class="fas fa-address-book" id="icon"></i>User Management</a></li>';
                 } ?>
                <li class="item"><a href="logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>
            </ul>
    
        </div> 
    <section class="down">
        <div class="head-pro">
            <h4 class="haed">Manage Supliers</h4>
            <button class="add" onclick="addCateg()">Add Suppliers</button>
        </div>
        <div class="main-products">
            <div class="butts">
                <button class="copy">Copy</button>
                <button class="copy">CSV</button>
                <button class="copy">Excel</button>
                <button class="copy">Print</button>
                <br>
                <br>
                <hr>
            </div>
            
            <br>
            
            <table>
                <tr class="headth">
                    <th>Sipplier Name</th>
                    <th>Address</th>
                    <th>phone Adress</th>
                    <th>Product</th>
                    <th>Action</th>
                  </tr>
                 
      <?php
      include 'connect.php';
                        $sql = "SELECT * FROM supliers";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                                echo '
                                 <tbody>
                                 <tr class="row">
                                    <td>'.$row['sname'].'</td>
                                    <td>'.$row['address'].'</td>
                                    <td>'.$row['phone'].'</td>
                                    <td>'.$row['product'].'</td>
                                    <td>
                                    <button onclick="editRow(' . $row['id'] . ')"id="edit">edit</button>
                                    <button onclick="confirmDelete(' . $row["id"] . ')"id="del">delete</button>
                                </td>
                                    </tr>
                            </tbody>';
                      }
                            }else{
                             echo 'connection failed';
                            }
                    
                $conn->close();
                
                  ?>
            </table>

        </div>
    </section>
    <div class="edit-form">
    <form action="addsup.php" method="POST" id="editForm">
        <label >suppliers name:</label>
        <input type="text" name="s_name" placeholder="enter suppliers name" required>
        <label >Address</label>
        <input type="text" name="s_addres" placeholder="enter suppliers address" required>
        <label >Phone</label>
        <input type="text" name="s_phone" placeholder="enter suppliers phone" required>
        <label >Product</label>
        <input type="text" name="s_product" placeholder="enter product " required>
        <button type="submit" name="submit" class="sava" >Save</button>
        <button type="button" class="sav" onclick="cancelEdit()">Cancel</button>
    </form>
</div>


    <div class="confirmation-dialog" id="confirmationDialog">
    <p class="col">Are you sure you want to delete this supplier?</p>
    <div class="poster">
    <button class="sava" onclick="deleteItem()">Yes</button>
    <button class="sav" onclick="cancelDelete()">No</button>
    </div>
</div>
<div class="overlay" id="overlay"></div>
<script>
    function addCateg(){
        document.querySelector('.edit-form').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }
    function cancelEdit(){
        document.querySelector('.edit-form').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
</script>
</body>

</html>