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


    $result=$conn->query("select * from order_info where d_id='$userId' and status='accepted'"); 
    $result=$result->fetch_all(MYSQLI_ASSOC);
    if(count($result)==0)
    {
        $visi1="block";
        $visi2="none";
    }
    else
    {
        $cusresult=$conn->query("select order_info.order_id, user_info.user_name, user_info.address, user_info.nid from user_info INNER JOIN order_info on user_info.user_id=order_info.c_id where order_info.d_id='$userId' and status='accepted'"); 
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
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../CSS/deliDeliveryStatus.css">
</head>
<body>
    <div class="main-content">
        <header>
            <h2>ALIDADA</h2>
            <nav>
                <a href="deliDashboard.php">Home</a>
                <a href="deliDeliveryHistory.php">Delivery History</a>
                <a href="deliProfile.php">Profile</a>
                <a href="logout.php">Log Out</a>
            </nav>
        </header>

        <hr>

        <div class="no-data" style="display: <?php echo($visi1)?>;">
            <h1>No  Orders Accepted Yet</h1>
        </div>


        <div style="display: <?php echo($visi2)?>;" class="product">

            <table>
                <tr>
                    <th>User Name</th>
                    <th>Address</th>
                    <th>Upload Picture</th>
                    <th>Number</th>
                    <th style="border:none; background:none;"></th>  
                </tr>
                    <?php
                    foreach($cusresult  as $row):
                        $order_id=$row['order_id'];
                        $user_name=$row['user_name'];
                        $address=$row['address'];
                        $nid=$row['nid'];
                    ?>
                    <tr>
                        <form action="updateOrder.php" method="POST" enctype="multipart/form-data">
                            <td><?php echo($user_name)?></td>
                            <td><?php echo($address)?></td>
                            <td>
                                <div class="container file-container">
                                    <input type="file" id="product" name="product" class="form_input file-input"><br>
                                    <span class="error2">
                                        <?php
                                        if (isset($_SESSION['product'])) {
                                            echo $_SESSION['product'];
                                            unset($_SESSION['product']);
                                        }
                                        ?>
                                        </span>
                                </div>
                            </td>
                            <td><?php echo($nid)?></td>
                            <td style="border:none;">
                                <button type="submit" class="button" name="accept" value="<?php echo ($order_id)?>"> Delivered</button>
                                <button type="submit" class="button" name="cancel" value="<?php echo ($order_id)?>" style="background-color: red; margin-left:12px;"> Cancel</button>
                                
                            </td>
                        </form>
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