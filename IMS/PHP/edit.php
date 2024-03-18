<?php
        include 'connect.php';
             //updatting product after editinh
             $update_id = $_POST['up_id'];
             $update_name = $_POST['up_name'];
             $update_price = $_POST['up_price'];
             $update_detail = $_POST['up_detail'];
     
             $imageName = $_FILES['up_image']['name'];            
             $imageData = file_get_contents($_FILES['up_image']['tmp_name']);
             $imagedat = $conn->real_escape_string($imageData);
             
             $update_query = mysqli_query($conn, "UPDATE products SET name='$update_name', price='$update_price',
             detail='$update_detail', image='$imagedat' WHERE id='$update_id' ") or die('query failed');
      
     if($update_query === TRUE){;
          header("location: products.php");
      }else{
         echo "something went wrong";
      }
?>
