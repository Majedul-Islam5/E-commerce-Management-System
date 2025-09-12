<?php
    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    $visi1="";
    $visi2="";


    $result=$conn->query("select * from order_info where d_id is NULL"); 
    $result=$result->fetch_all(MYSQLI_ASSOC);
    if(count($result)==0)
    {
        $visi1="block";
        $visi2="none";
    }
    else
    {
        $cusresult=$conn->query("select order_info.order_id, order_info.product_cost, order_info.delivery_fee, user_info.user_name, user_info.address, user_info.nid from user_info INNER JOIN order_info on user_info.user_id=order_info.c_id where order_info.d_id is NULL"); 
        $cusresult=$cusresult->fetch_all(MYSQLI_ASSOC);
                
        $visi1="none";
        $visi2="block";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/deliDashboard.css">
    
</head>
<body>
    <div class="main-content">
    <header>
        <a href="deliDashboard.php"><h2>ALIDADA</h2></a>

        
        <nav>
     
            <a href="deliDeliveryHistory.php">Delivery History</a>
            <a href="deliDeliveryStatus.php">Delivery Status</a>
            <a href="deliProfile.php">Profile</a>
            <a href="logout.php">Log Out</a>
        </nav>

   
    </header>


    <div class="no-data" style="display: <?php echo($visi1)?>;">
        <h1>No Customers order till now to accept</h1>
    </div>

    <div style="display: <?php echo($visi2)?>;" class="product">

        <table>
            <tr>
                <th>User Name</th>
                <th>Address</th>
                <th>Number</th>
                <th>Product Cost</th>
                <th>Delivery Fee</th>
                <th></th>


                
            </tr>
                <?php

                foreach($cusresult  as $row):
                    $order_id=$row['order_id'];
                    $user_name=$row['user_name'];
                    $address=$row['address'];
                    $nid=$row['nid'];
                    $product_cost=$row['product_cost'];
                    $delivery_fee=$row['delivery_fee'];
                
                ?>
                <tr>
                    <td><?php echo($user_name)?></td>
                    <td><?php echo($address)?></td>
                    <td><?php echo($nid)?></td>
                    <td>BDT <?php echo($product_cost)?></td>
                    <td>BDT <?php echo($delivery_fee)?></td>
                    <td>
                        <a href="acceptOrder.php?order_id=<?php echo ($order_id)?>">
                            <button type="button" class="button" id="<?php echo ($order_id)?>"> Accept Order</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
                
        </table>

    </div>


    <footer>
        
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
</body>
</html>