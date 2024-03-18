<?php 
include 'connect.php';
session_start();

// Check if the user is logged in and has a role set in the session
if(isset($_SESSION['ROLE']) != 'admin') {
    header("Location: userlogin.php");
    exit();
}

if(isset($_POST['submit'])){
$product = mysqli_real_escape_string($conn, $_POST['name']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$detail = mysqli_real_escape_string($conn, $_POST['details']);

$imageName = $_FILES['image']['name'];
$imageData = file_get_contents($_FILES['image']['tmp_name']);
$imageData = $conn->real_escape_string($imageData);


$select_product = mysqli_query($conn, "SELECT name FROM products WHERE name = '$product'") or die('query failed');
if(mysqli_num_rows($select_product) > 0){
    $message[] = 'product already exist';
}else{
    $insert = mysqli_query($conn, "INSERT INTO products (name, price, detail, image) VALUES ('$product', '$price', '$detail','$imageData')") or die('query failed');
     if($insert){
        $message[] = 'products added successfully';
     }else{
        $message[] = 'something went wrong';
     }
}
}

     //delete products from database
     if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM products WHERE id = '$delete_id'") or die('query failed');
        
           header('location: products.php'); 
       }





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
 
    </style>
</head>
<body>
    <?php
    include 'user-header.php';
    ?>
    <section class="add-products">
        <form method="post" enctype="multipart/form-data">
        <h1>Add Product</h1>
        <?php
       if(isset($message)){
        forEach($message as $message){
        echo'
          <div class="message">
            <span>'.$message.'</span>
            <button onclick = "this.parentElement.remove()" class="cancelx">X</button>
          </div>
        ';
        
        }
       }
     ?>
            <div class="input-field">
                <label>Product Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-field">
                <label>Product Price</label>
                <input type="text" name="price" required>
            </div>
            <div class="input-field">
                <label>Product Details</label>
                <input type="text" name="details" required>
            </div>
            <div class="input-field">
                <label>Product image</label>
                <input type="file" name="image" required>
            </div>
            <input type="submit" name="submit" value="add product" class="btn">
    </form>

     </section>

<section class="show_products">
    <div class="box_container">
        <?php 
          $select_product = mysqli_query($conn, "SELECT * FROM products") or die('query failed');
          if(mysqli_num_rows($select_product)>0){
            while($fetch_products = mysqli_fetch_assoc($select_product)){
                $image = $fetch_products['image'];
          ?>
        <div class="box">     
        <?php echo' <img src="data:image/jpeg; base64,'.base64_encode($image).'" >' ?>
            <p>Price: <?php echo $fetch_products['price']; ?></p>
            <h4> <?php echo $fetch_products['name']; ?></h4>
            <details> <?php echo $fetch_products['detail']; ?></details>
            <a href="products.php?edit=<?php echo $fetch_products['id']; ?>" class="edit">edit</a>
            <a href="products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete" onclick="return confirm('Do you really want to delete this product');">delete</a>
            </div>
            <?php
            }
            }else{
                echo '
                     <div class="empty">
                          <p> No products Added</p>
                     </div>
                ';
            }
            ?>
        
    </div>
</section>
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
 <input type="text" name="up_name" value="<?php echo $fetch_edit['name'] ?>">
 <input type="text" name="up_price" value="<?php echo $fetch_edit['price'] ?>">
 <textarea style="width: 85%;" name="up_detail"><?php echo $fetch_edit['detail'] ?></textarea>
 <input type="file" name="up_image"  accept="image/jpg, image/jpeg, image/png, image/webp">
 <input type="submit" mame="update" value="update" class="btn ">
 <input type="reset" mame="cancel" value="cancel" id="close_form" class="btn" onclick="canceledit()">
 </form>
 <?php
    }
  }
    echo "<script>document.querySelector('.update').style.display='block'</script>";
 }
      


   ?>
</section>
<div id="loading">
    <div class="spinner"></div>
</div>
<script type="text/javascript" src="script.js"></script>
<script>
    window.addEventListener('load', function() {
        document.getElementById('loading').style.display = 'none';
    });
</script>
</body>
</html>