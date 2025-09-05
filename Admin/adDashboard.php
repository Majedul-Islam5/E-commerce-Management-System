<?php

    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    $sql="select * from product";
    $result = $conn->query($sql);
    $result=$result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/adDashboard.css">
    
</head>
<body>
    <div class="main-content">
    <header>
        <h2>ALIDADA</h2>

        
        <nav>
            
            <a href="adDashboard.php">Home</a>
            <a href="customerInfo.php">Customer Information</a>
            <a href="adAddProduct.php">Add Product</a>
            <a href="adProfile.php">Profile</a>
        </nav>

   
    </header>


    <div id="view">
        
        <?php
            foreach($result as $row):
                
        ?>
        <div class="product">
            <img src="../Image/<?php echo $row['image_url']?>" alt="notfound"><br>
            <span><?php echo $row['p_name']?></span><br>
            <span>BDT <?php echo $row['price']?></span><br>
            <span><?php echo $row['stock']?> items</span><br>
            <span>Category: <?php echo $row['category']?></span><br>
            <a href="editProduct.php?p_id=<?php echo $row['p_id']?>">
                <button type="button" class="button" id="<?php echo $row['p_id']?>">Add Item</button>
            </a>
        </div>
        <?php endforeach;?>       
    </div>


    <footer>
        
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
</body>
</html>