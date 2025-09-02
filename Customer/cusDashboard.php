<?php 
    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    $result = $conn->query("select * from product");
    $result=$result->fetch_all(MYSQLI_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/cusDashboard.css">
    
</head>
<body>
    <div class="main-content">
    <header>
        <h2>ALIDADA</h2>

        
        <nav>
            
            <a href="cusDashboard.php">Home</a>
            <a href="viewCart.php">Add To Cart</a>
            <a href="cusProfile.php">Profile</a>
            <form class="search-form" action="search.php" method="get">
            <input type="text" name="query" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>
        </nav>

   
    </header>

    <hr>

    <div id="view">
        
        <?php
            foreach($result as $row):
                
        ?>
        <div class="product">
            <img src="../Image/<?php echo $row['image_url']?>" alt="notfound"><br>
            <span><?php echo $row['p_name']?></span><br>
            <span><?php echo $row['price']?></span><br>
            <a href="holdCart.php?p_id=<?php echo $row['p_id']?>">
                <button type="button" class="button" id="<?php echo $row['p_id']?>">Add to Cart</button>
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