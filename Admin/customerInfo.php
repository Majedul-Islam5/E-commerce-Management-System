<?php
    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }


    $result=$conn->query("select * from user_info where type in ('Customer', 'DeliveryMan')"); 
    $result=$result->fetch_all(MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../CSS/customerInfo.css">
</head>
<body>
    <div class="main-content">
        <header>
            <h2>ALIDADA</h2>
            <nav>
                <a href="adDashboard.php">Home</a>
                <a href="adAddProduct.php">Add Product</a>
                <a href="adProfile.php">Profile</a>
                <a href="logout.php">Log Out</a>
            </nav>
        </header>

        <hr>

        <table>
            <tr>
                <th>User Name</th>
                <th>User Type</th>
                <th>Address</th>
                <th>Email</th>
                <th>Number</th>
                <th>Delete User??</th>
            </tr>
            <?php
                foreach($result as $row):
                    
                    $user_name=$row['user_name'];
                    $type=$row['type'];
                    $address=$row['address'];
                    $email=$row['email'];
                    $nid=$row['nid'];
            ?>
            <tr>
                <td data-label="User Name"><?php echo($user_name)?></td>
                <td data-label="User Type"><?php echo($type)?></td>
                <td data-label="Address"><?php echo($address)?></td>
                <td data-label="Email"><?php echo($email)?></td>
                <td data-label="Number"><?php echo($nid)?></td>
                <td data-label="Action">
                    <a href="manageUser.php?user_id=<?php echo $row['user_id']?>">
                        <button type="button" class="button" id="<?php echo $row['user_id']?>">Delete User</button>
                    </a>
                </td>
            </tr>

            <?php endforeach;?>
        </table>




        <footer>
            <hr>
            <p>Copyright &copy; All rights reserved by ALIDADA</p>
        </footer>
    </div>
</body>
</html>