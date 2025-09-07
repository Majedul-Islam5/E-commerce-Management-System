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
    $total=0;
    $delivary=100;

    $result=$conn->query("select * from customer_order where user_id=$userId"); 
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
            <h2>ALIDADA</h2>
            <nav>
                <a href="cusDashboard.php">Home</a>
                <a href="cusProfile.php">Profile</a>
                <a href="logout.php">Log Out</a>
            </nav>
        </header>
        <hr>

        
        <div class="no-data" style="display: <?php echo($visi1)?>;">
            <h1>No Data to Show</h1>
        </div>




        <div style="display: <?php echo($visi2)?>;" class="product">
            <table>
                <?php

                foreach($result  as $row):
                    $p_id=$row['p_id'];
                    $pr=$conn->query("select * from product where p_id=$p_id"); 
                    $pr=$pr->fetch_all(MYSQLI_ASSOC);
                    $total+=$pr[0]['price'];
                    $delivary+=100;
                
                ?>
                <tr>
                    <td><img src="../Image/<?php echo($pr[0]['image_url'])?>" alt="notfound" width="120" height="120"></td>
                    <td><?php echo($pr[0]['p_name'])?></td>
                    <td>BDT <?php echo($pr[0]['price'])?></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td>Subtotal: </td>
                    <td></td>
                    <td>BDT <?php echo($total)?></td>
                </tr>

                <tr>
                    <td>Shipping: </td>
                    <td></td>
                    <td>BDT <?php echo($delivary)?></td>
                </tr>

                <tr>
                    <td>Total: </td>
                    <td></td>
                    <td>BDT <?php echo($delivary+$total)?></td>
                </tr>
            </table>
            <select id="paymentMethod" onchange="showPaymentOptions()">
                <option value="" disabled selected>Select Payment Method</option>
                <option value="online">Mobile Banking</option>
                <option value="card">Card</option>
            </select>

            <div id="onlineOptions" class="hidden">
                <p>Select one:</p>
                <label class="payment-option">
                    <input type="radio" name="onlinePayment" value="bkash" required>
                    <img src="../Image/bkash.png" alt="bKash">
                </label>
                <label class="payment-option">
                    <input type="radio" name="onlinePayment" value="nagad">
                    <img src="../Image/nagad.png" alt="Nagad">
                </label>
            </div>

            <div id="cardOptions" class="hidden">
                <p>Enter Card/Account Number:</p>
                <input type="text" placeholder="Enter Account Number" required>
            </div>
            
            <form action="confirmOrder.php" method="POST">
                    <button type="submit" name="payment">Place Order</button>
            </form>
            
        </div>

        <script src="../JS/payment.js"></script>

        <footer>
            <hr>
            <p>Copyright &copy; All rights reserved by ALIDADA</p>
        </footer>
    </div>

    


</body>
</html>

