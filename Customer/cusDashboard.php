<?php 
    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    $sql="";
    $filter="";
    if(isset($_POST['category'])  && !empty($_POST['category']))
    {
        $filter=$_POST['category'];
        $sql="select * from product where category='$filter'";
    }
    else
    {
        $sql="select * from product";
    }

    $result = $conn->query($sql);
    $result=$result->fetch_all(MYSQLI_ASSOC);

    if(isset($_POST['reset']))
    {
        unset($_POST['category']);
        unset($_POST['reset']);
        header("Location: cusDashboard.php");
         
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
            <a href="viewCart.php">Add To Cart</a>
            <a href="cusProfile.php">Profile</a>
            <form class="search-form" action="cusDashboard.php" method="POST">
                <select name="category" onchange="this.form.submit()">
                    <option value="" disabled selected>Choose a Product Type</option>
                    <?php
                    $optsql = "SELECT DISTINCT category FROM product"; 
                    $optResult = $conn->query($optsql);
                    $optResult=$optResult->fetch_all(MYSQLI_ASSOC);
                    if(count($optResult)>0)
                    {
                        foreach($optResult as $opt)
                        {
                            $category = $opt['category'];
                            $selected = (isset($_POST['category']) && $_POST['category'] == $category) ? "selected" : "";
                            echo "<option value='$category' $selected>$category</option>";
                        }
                    }
                    ?>
                </select>
                <button type="submit" name="reset">Reset</button>
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
            <span>BDT <?php echo $row['price']?></span><br>
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