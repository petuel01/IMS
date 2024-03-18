<?php
include 'connect.php';
session_start();

// Check if the user is logged in and has a role set in the session
if(!isset($_SESSION['ROLE'])) {
    header("Location: userlogin.php");
    exit();
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = '$delete_id'") or die('query failed');
    echo '<script>alert("product deleted succesfully");</script>';
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
            height: 200px;
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
            height: 400px;
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
            color: white;
            width: 3.5rem;
            height: 2.5rem;
            padding: 5px;
            
        }
        .sav{
            
            right: 1rem;
            bottom: 1rem;
            background: red;
        }
        .sava{
            right: 1rem;
            bottom: 1rem;
            background: blue;
        }
        .picture{
            height: 3rem;
            width: 3rem;
            border-radius: 50%;
        }
        .active{
            background: green;
            color: white;
            border: none;
            border-radius: 8px;
            height: 2,5rem;
            padding: 5px;
        }
        .not{
            background: red;
            color: white;
            border: none;
            border-radius: 8px;
            height: 2,5rem;
            padding: 5px;
        }
       span{
        background: red;
        padding: 3px;
        color: white;
        font-size: 13px;
       }
       .update{


position: fixed;
right: 0;
top: 0;
left: 0;
max-height: 100%;
background: lightblue;
overflow-y: auto;
z-index: 1100;
}
.update form{
width: 50%;
background: #fff;
padding: 1rem;
margin: 2rem auto;
text-align: center;
}
.update .edit
.update .btn{
width: 30%;
cursor: pointer;
color: white;
}
.edit {
    background: blue;
}
.btn{
    background: red;
}
.update form img{
width: 60%;
}
form input{
    width: 80%;
    margin: .5rem;
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
        <div class="head-pro">
            <h4 class="haed">Manage Products</h4>
            
        <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' ) {
               echo'
            <button class="add"><a href="add-product.php" style="color: white;">add product</a></button>';
        } ?>
        </div>
        <div class="top-right">
            <a href="dashboard.html" class="home"><i class="fas fa-tachometer-alt"i></i>Home</a>
            <a href="#" class="pro">Products</a>    
        </div>
        <div class="main-products">
            <form method="POST" class="search">
                <button name="submit" id="search" class="search-btn"><i class="fas fa-search"></i></button>
                <input type="text" placeholder="search" class="text-area" name="search">
          </form>
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
            
            <table id="tableId">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Category</th>
                    <th>Availability</th>
                    <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' ) {
                  echo'
                    <th>Action</th>
                  </tr>'; } ?>
 <?php
 include 'connect.php';
 if(isset($_POST['submit'])){
    $search = $_POST['search'];
    $sql = "select * from products where id like '%$search%' or p_name like '%$search%'";
    $result = mysqli_query($conn, $sql);
    if($result){
        if(mysqli_num_rows($result)>0){
            while($row = $result->fetch_assoc()) {
                $imageData = $row['image'];
                $quantity = $row['p_quantity'];
                $id = $row['id'];
                echo'
                <tbody>
                <tr class="row">
                    <td><img src="data:image/jpeg; base64,'.base64_encode($imageData).'" class="picture"></td>
                    <td>'.$row['p_name'].'</td>
                    <td>'.$row['p_price'].'</td>
                    <td>'.$row['p_quantity'].'</td>
                    <td>'.$row['p_categ'].'</td>
                    <td><button class="active">Active</button></td>
                    <td>'
                    ?>
                     <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' ) {
               echo'
               <button id="edit"><a href="product.php?edit='.$id.'" class="edit">edit</a></button>
               <button id="del"><a href="product.php?delete='.$id.'" class="delete" onclick="return confirm("Do you really want to delete this product");">delete</a></button>';
                   
                     } ?>
                    <?php
                    echo'
                </td>
                    </tr>
            </tbody>
               ';
            }
        }else{
            echo'<h1 style="color: red;">item not found</h1>';
        }
    }
}else{
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $imageData = $row['image'];
        $quantity = $row['p_quantity'];
        $id = $row['id'];
        if($quantity < 5){
            echo '
            <tbody>
                <tr class="row">
                    <td><img src="data:image/jpeg; base64,'.base64_encode($imageData).'" class="picture"></td>
                    <td>'.$row['p_name'].'</td>
                    <td>'.$row['p_price'].'</td>
                    <td>'.$row['p_quantity'].'<span class="low">low</span></td>
                    <td>'.$row['p_categ'].'</td>
                    <td><button class="not">finishing</button></td>
                    <td>'
                    ?>
                       <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' ) {
               echo'
               <button id="edit"><a href="product.php?edit='.$id.'" class="edit">edit</a></button>
               <button id="del"><a href="product.php?delete='.$id.'" class="delete" onclick="return confirm("Do you really want to delete this product");">delete</a></button>';
                   
                     } ?>
                    <?php
                    echo'
                </td>
                    </tr>
            </tbody>
               ';
        }else{
            if($quantity < 5){
                echo '
                <tbody>
                    <tr class="row">
                        <td><img src="data:image/jpeg; base64,'.base64_encode($imageData).'" class="picture"></td>
                        <td>'.$row['p_name'].'</td>
                        <td>'.$row['p_price'].'</td>
                        <td>'.$row['p_quantity'].'<span class="low">low</span></td>
                        <td>'.$row['p_categ'].'</td>
                        <td><button class="not">finishing</button></td>
                        <td>'
                        ?>
                                   <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' ) {
               echo'
               <button id="edit"><a href="product.php?edit='.$id.'" class="edit">edit</a></button>
               <button id="del"><a href="product.php?delete='.$id.'" class="delete" onclick="return confirm("Do you really want to delete this product");">delete</a></button>';
                   
                     } ?>
                    <?php
                    echo'
                </td>
                    </tr>
            </tbody>
               ';
            }else{
            echo'
                    <tbody>
                    <tr class="row">
                        <td><img src="data:image/jpeg; base64,'.base64_encode($imageData).'" class="picture"></td>
                        <td>'.$row['p_name'].'</td>
                        <td>'.$row['p_price'].'</td>
                        <td>'.$row['p_quantity'].'</td>
                        <td>'.$row['p_categ'].'</td>
                        <td><button class="active">Active</button></td>
                        <td>'
                        ?>
                                <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'mananger' ) {
               echo'
               <button id="edit"><a href="product.php?edit='.$id.'" class="edit">edit</a></button>
               <button id="del"><a href="product.php?delete='.$id.'" class="delete" onclick="return confirm("Do you really want to delete this product");">delete</a></button>';
                   
                     } ?>
                    <?php
                    echo'
                </td>
                    </tr>
            </tbody>
               ';
            }
        }
    }
}
}
    ?>
      
            </table>

        </div>
    </section>
    <div class="edit-form">
    <form action="edit.php" method="POST" id="editForm">
        <input type="hidden" id="editId" name="editId" required>
        <label for="editName">Name:</label>
        <input type="text" id="editName" name="editName" required>
        <label for="editPrice">Price:</label>
        <input type="text" id="editPrice" name="editPrice" required>
        <label for="editqtt">quantiy:</label>
        <input type="number" id="editQtt" name="editQtt" required>
        <label for="category">Category</label>
        <input type="text" id="editCateg" name="editCateg" required>
        <button type="submit" name="submit" class="sava" >Save</button>
        <button type="button" class="sav" onclick="cancelEdit()">Cancel</button>
    </form>
</div>


    <div class="confirmation-dialog" id="confirmationDialog">
    <p class="col">Are you sure you want to delete this product?</p>
    <div class="poster">
    <button class="sava" onclick="deleteItem()">Yes</button>
    <button class="sav" onclick="cancelDelete()">No</button>
    </div>
</div>
<div class="overlay" id="overlay"></div>
<section class="update">
<?php  
 if(isset($_GET['edit'])){
     $edit_id = $_GET['edit'];
    $edit_query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$edit_id'") or die('query failed');
    if(mysqli_num_rows($edit_query)){
     while($fetch_edit = mysqli_fetch_assoc($edit_query)){
         $pic = $fetch_edit['image'];
 ?>
 <form action="edit.php" method="post" enctype="multipart/form-data">
 <?php echo' <img src="data:image/jpeg; base64,'.base64_encode($pic).'" >' ?>
 <input type="hidden" name="up_id" value="<?php echo $fetch_edit['id'] ?>">
 <input type="text" name="up_name" value="<?php echo $fetch_edit['p_name'] ?>">
 <input type="num" name="up_price" value="<?php echo $fetch_edit['p_price'] ?>">
 <textarea style="width: 85%;" name="up_detail"><?php echo $fetch_edit['description'] ?></textarea>
 <input type="num" name="up_qtt" value="<?php echo $fetch_edit['p_quantity'] ?>">
 <input type="text" name="up_categ" value="<?php echo $fetch_edit['p_categ'] ?>">
 <input type="file" name="up_image"  accept="image/jpg, image/jpeg, image/png, image/webp">
 <input type="submit" mame="update" value="update" class="edit ">
 <input type="reset" mame="cancel" value="cancel" id="close_form" class="btn" onclick="canceledit()">
 </form>
 <?php
    }
  }
    echo "<script>document.querySelector('.update').style.display='block'</script>";
 }
      


   ?>
   <script>
    function canceledit(){
    document.querySelector('.update').style.display = 'none';
}
   </script>
</section>
</body>
</html>