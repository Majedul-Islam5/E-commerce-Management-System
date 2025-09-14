<?php
    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    $userId=$_SESSION['userId'];

    $visi1="";
    $visi2="";

    $result=$conn->query("select * from order_info where c_id=$userId"); 
    $result=$result->fetch_all(MYSQLI_ASSOC);
    if(count($result)==0)
    {
        $visi1="block";
        $visi2="none";

    }
    else
    {
                
        $visi1="none";
        $visi2="block";
        
    } 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link rel="stylesheet" href="../CSS/viewCart.css">
</head>
<body>
    <div class="main-content">
        <header>
            <a href="cusDashboard.php"><h2>ALIDADA</h2></a>
            <nav>
                <a href="cusDashboard.php">Home</a>
                <a href="viewCart.php">View Cart</a>
                <a href="cusProfile.php">Profile</a>
                <a href="logout.php">Log Out</a>
            </nav>
        </header>
        <hr>

        
        <div class="no-data" style="display: <?php echo($visi1)?>;">
            <h1>No purchase history</h1>
        </div>




        <div style="display: <?php echo($visi2)?>;" class="product">
            
                <table>
                    <tr>
                        <td>Reference Number</td>
                        <td>Order Date and Time</td>
                        <td>Order Status</td>
                        <td>Delivery Address</td>
                        <td>Total Amount Paid</td>
                    </tr>
                    <?php
                    $pr=$conn->query("select address from user_info where user_id=$userId"); 
                    $pr=$pr->fetch_all(MYSQLI_ASSOC);

                    foreach($result  as $row):
                        $order_id=$row['order_id'];
                        $prefix = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);  
                        $suffix = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
                        $reference = $prefix . str_pad($order_id, 2, '0', STR_PAD_LEFT) . $suffix;
                        if($row['status']=="ordered")
                        {
                            $status="Product Ordered";
                        }
                        if($row['status']=="delivered")
                        {
                            $status="Product Received";
                        }
                        if($row['status']=="accepted")
                        {
                            $status="Out for Delivery";
                        }
                        $order_datetime=$row['order_datetime'];
                        $product_cost=$row['product_cost'];
                        $address=$pr[0]['address'];
                    
                    ?>
                    <tr>
                        <td><?php echo($reference)?></td>
                        <td><?php echo($order_datetime)?></td>
                        <td><?php echo($status)?></td>
                        <td><?php echo($address)?></td>
                        <td><?php echo($product_cost)?></td>
                        
                        
                    </tr>
                    <?php endforeach;?>
                    
                </table>
        </div>

        <footer>
            <hr>
            <p>Copyright &copy; All rights reserved by ALIDADA</p>
        </footer>
    </div>

    


</body>
</html>

