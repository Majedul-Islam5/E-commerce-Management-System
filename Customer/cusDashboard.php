<?php 
    session_start();

    if(!isset($_SESSION['userName'])) 
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
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/cusDashboard.css">
</head>
<body>
    <div class="main-content">
    <header>
    <h2>ALIDADA</h2>

     
    <nav>
        
        <a href="cusDashboard.php">Home</a>
        <a href="addToCart.php">Add To Cart</a>
        <a href="cusProfile.php">Profile</a>
        <form class="search-form" action="search.php" method="get">
        <input type="text" name="query" placeholder="Search..." required>
        <button type="submit">Search</button>
    </form>
    </nav>

   
</header>

    <hr>
    


    <footer>
        
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
</body>
</html>