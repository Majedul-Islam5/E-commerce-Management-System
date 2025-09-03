<?php
    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    $userId=$_SESSION['userId'];

    $result=$conn->query("select * from customer_order where user_id=$userId"); 
    $row=$result->fetch_all(MYSQLI_ASSOC);
    if(count($row)==0)
    {
        echo "No data to display";
    }
    else
    {
                
        //yet to show the products that i have selected;
        
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
        
        <footer>
            <hr>
            <p>Copyright &copy; All rights reserved by ALIDADA</p>
        </footer>
    </div>
</body>
</html>

