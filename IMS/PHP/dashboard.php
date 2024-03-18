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
    <script type="text/javascript" src="\ims\js\script.js"></script>
    <script src="jquery-3.7.1.min.js"></script>
    <script src="\ims\js\chart.umd.js"></script>
    <style>

.content2{
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
    flex-wrap: wrap;
    margin-bottom:3rem;
}

.recent{
    height: 320px;
    width: 600px;
    flex: 5;
    background: rgb(193, 200, 228);
    margin: 0 25px 25px 25px;
    box-shadow: 4px 7px rgba(0, 0, 0, 0.2), 0 6px 20px 0 ;
}
.recents{
    height: 320px;
    width: 350px;
    flex: 5;
    background: rgb(193, 200, 228);
    margin: 0 25px 25px 25px;
    box-shadow: 4px 7px rgba(0, 0, 0, 0.2), 0 6px 20px 0 ;
}
.content
{
    background: #e3e3eb;
   
  
}.cards{
    padding: 5px 5px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
.card{
    width: 200px;
    height: 100px;
    background: rgb(158, 169, 219);
    margin: 10px 5px;
    display: flex;
    align-items: center;
    
    box-shadow:  4px 7px rgba(0, 0, 0, 0.2), 0 6px 20px 0 ;
    border-radius: 10px;
}
.box{
    text-align: center;
    padding-left: 2rem;
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
        

        <section>
         
            <div class="cards">
                <div class="card" style="background: blue;">
                        <div class="box">
                            <i class="fas fa-qrcode" id="icon"></i>
                              <?php 
                              ?>
                            <h3
                            ></i></i>Items</h3>
                            <h1><?php echo itemCount(); ?></h1>
                        </div>
                        <div class="iconcase">
                            <?php 
                             function itemCount() {
                                include 'connect.php';
                             // Query to count the number of rows in the products table
                             $sql = "SELECT COUNT(*) as count FROM sales";
                             $result = $conn->query($sql);
                     
                             if ($result->num_rows > 0) {
                                 $row = $result->fetch_assoc();
                                 return $row["count"];
                             } else {
                                 return 0;
                             }
                     
                     
                         }
                            ?>
                        </div>
                    </div>
                    <div class="card" style="background: green;">
                        <div class="box" >
                            <i class="fas fa-dollar-sign" id="icon"></i>
                            
                            <h3>SALES</h3>
                            <h1><?php echo getSalesCount(); ?></h1>
                        </div>
                        <div class="iconcase">
                        <?php
    function getSalesCount() {
           include 'connect.php';
        // Query to count the number of rows in the products table
        $sql = "SELECT COUNT(*) as count FROM sales";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["count"];
        } else {
            return 0;
        }


    }
    ?>
        
                        </div>
                    </div>
                    <div class="card"  style="background: red;">
                        <div class="box">
                            <i class="fab fa-product-hunt"></i>
                            
                            <h3>Products</h3>
                            <h1><?php echo getProductCount(); ?></h1>
                            <?php
    function getProductCount() {
           include 'connect.php';
        // Query to count the number of rows in the products table
        $sql = "SELECT COUNT(*) as count FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["count"];
        } else {
            return 0;
        }


    }
    ?>
                        </div>
                        <div class="iconcase">
                        </div>
                    </div>
                    <div class="card" style="background: lightblue;">
                        <div class="box" >
                            <i class="fas fa-clipboard-list"></i>
                            
                            <h3>Finishing</h3>
                            <h1>00</h1>
                        </div>
                        <div class="iconcase">
                        </div>
                    </div>
                    <div class="card">
                        <div class="box">
                            <i class="fas fa-truck-moving"></i>
                            
                            <h3>Order</h3>
                            <h1>00</h1>
                        </div>
                        <div class="iconcase">
        
                        </div>
                    </div>
                    <div class="card" style="background: rgba(54, 162, 235, 0.6);">
                        <div class="box">
                            <i class="fas fa-money-bill-alt"></i>
                            <h3>ACCOUNT</h3>
                            <h1>00</h1>
                        </div>
                        <div class="iconcase">
                        </div>
                    </div>
            </div>
            <div class="content2">
                <div class="recent">
                    <canvas id="salesChart"></canvas>
                    </div>
                <div class="recents">
                    <canvas id="myLineChart"></canvas>
                    </div>
                    
                    </div>
                    
               
           
            
              <script>
document.addEventListener('DOMContentLoaded', function() {
  fetch('data.php')
    .then(response => response.json())
    .then(data => {
      const weeks = data.map(sale => sale.week_number);
      const amounts = data.map(sale => sale.total_amount);

      const ctx = document.getElementById('salesChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: weeks,
          datasets: [{
            label: 'Sales Amount',
            data: amounts,
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    })
    .catch(error => console.error('Error:', error));
});
              </script>
              <script>
                    // Get the canvas element
                    var ctx = document.getElementById('myLineChart').getContext('2d');
                
                    // Define your data
                    var data = {
                        labels: ['Label1', 'Label2', 'Label3'],
                        datasets: [{
                            label: 'My Line Chart',
                            data: [3, 6, 4],
                            borderColor: 'rgb(75, 192, 192)',
                            borderWidth: 2,
                            fill: false
                        }]
                    };
                
                    // Configure the options
                    var options = {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                type: 'category',
                                labels: data.labels
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    };
                
                    // Create the line chart
                    var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: data,
                        options: options
                    });
                
                </script>
                
                </section>
</body>
</html>