<?php

    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../CSS/adAddProduct.css">
</head>
<body>
    <div class="main-content">
        <header>
            <h2>ALIDADA</h2>
            <nav>
                <a href="adDashboard.php">Home</a>
                <a href="customerInfo.php">Customer Information</a>
                <a href="adProfile.php">Profile</a>
                <a href="logout.php">Log Out</a>
            </nav>
        </header>

        <hr>
        
       <form action="addProductValidation.php" method="POST" enctype="multipart/form-data">

            <div class="container">
                <label for="p_name"><strong>Product Name: </strong></label>
                <input type="text" id="p_name" name="p_name" autocomplete="off" placeholder=" " class="form_input">
                <span id="pnameErr">
                    <?php
                    if (isset($_SESSION['p_name'])) {
                        echo $_SESSION['p_name'];
                        unset($_SESSION['p_name']);
                    }
                    ?>
                </span>
            </div>

            <div class="container">
                <label for="price"><strong>Price: </strong></label>
                <input type="text" id="price" name="price" autocomplete="off" placeholder=" " min="1" class="form_input">
                <span id="priceErr">
                    <?php
                    if (isset($_SESSION['price'])) {
                        echo $_SESSION['price'];
                        unset($_SESSION['price']);
                    }
                    ?>
                </span>
            </div>


            <div class="container">
                <label for="product"><strong>Product Image: </strong></label>
                <input type="file" id="product" name="product" autocomplete="off" placeholder=" " class="form_input">
                <span id="productErr">
                    <?php
                    if (isset($_SESSION['product'])) {
                        echo $_SESSION['product'];
                        unset($_SESSION['product']);
                    }
                    ?>
                </span>
            </div>

            <div class="container">
                <label for="stock"><strong>Stock: </strong></label>
                <input type="text" id="stock" name="stock" autocomplete="off" placeholder=" " class="form_input">
                <span id="stockErr">
                    <?php
                    if (isset($_SESSION['stock'])) {
                        echo $_SESSION['stock'];
                        unset($_SESSION['stock']);
                    }
                    ?>
                </span>
            </div>

            <div class="container">
                <label for="category"><strong>Category: </strong></label>
                <input type="text" id="category" name="category" autocomplete="off" placeholder=" " class="form_input">
                <span id="categoryErr">
                    <?php
                    if (isset($_SESSION['category'])) {
                        echo $_SESSION['category'];
                        unset($_SESSION['category']);
                    }
                    ?>
                </span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Add Product</button>
            </div>

       </form>


        <footer>
            <hr>
            <p>Copyright &copy; All rights reserved by ALIDADA</p>
        </footer>
    </div>
</body>
</html>