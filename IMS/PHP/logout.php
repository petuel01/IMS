<?php 
session_start();
unset($_SESSION['ROLE']);
unset($_SESSION['IS LOGIN']);
if($_SESSION['ROLE'] == "admin"){
    header("location: form.php");  
}else{
header("location: userlogin.php");
die();
}


?>