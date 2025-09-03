<?php 
session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }


    $userId=$_SESSION['userId'];

    $result=$conn->query("select * from user_info where user_id=$userId"); 
    $row=$result->fetch_all(MYSQLI_ASSOC);

    $userName=$email=$mobile=$address=$password="";

    foreach($row as $val)
    {
        $userName=$val['user_name'];
        $email=$val['email'];
        $mobile=$val['nid'];
        $address=$val['address'];
        $password=$val['password'];
    }
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link rel="stylesheet" href="../CSS/cusProfile.css">
</head>
<body>
    <div class="main-content">
        <header>
            <h2>ALIDADA</h2>
            <nav>
                <a href="cusDashboard.php">Home</a>
                <a href="viewCart.php">Add to Cart</a>
                <a href="logout.php">Log Out</a>
            </nav>
        </header>

        <hr>

        <h2>Edit Your Profile</h2>
        <form action="cusVerifyEdit.php" method="POST">

            <label for="name"> <strong>Name</strong></label><br>
            <input type="text" id="name" value="<?php echo($userName)?>" name="userName" autocomplete="off" class="form_input">
            <span id="naerr">
                <?php
                    if (isset($_SESSION['Name'])) 
                    {
                        echo $_SESSION['Name'];
                        unset($_SESSION['Name']);
                    }
                ?>
            </span>
            <br><br>

            <label for="email"> <strong>Email</strong></label><br>
            <input type="email" id="email" value="<?php echo($email)?>" name="email" autocomplete="off" class="form_input" >
            <span id="emerr">
                <?php
                    if (isset($_SESSION['Email'])) 
                    {
                        echo $_SESSION['Email'];
                        unset($_SESSION['Email']);
                    }
                ?>
            </span>
            <br><br>

            <label for="mobile"> <strong>Mobile</strong></label><br>
            <input type="text" id="mobile" value="<?php echo($mobile)?>" name="mobile" autocomplete="off" class="form_input" >
            <span id="moberr">
                <?php
                    if (isset($_SESSION['Mobile'])) {
                        echo $_SESSION['Mobile'];
                        unset($_SESSION['Mobile']);
                    }
                ?>
            </span>
            <br><br>

            <label for="address"> <strong>Address</strong></label><br>
            <input type="text" id="address" value="<?php echo($address)?>" name="address"  autocomplete="off" class="form_input">
            <span id="adderr">
                <?php
                    if (isset($_SESSION['Address'])) {
                        echo $_SESSION['Address'];
                        unset($_SESSION['Address']);
                    }
                ?>
            </span>
            <br><br>

            <label for="password"><strong>Password</strong></label><br>
            <input type="text" id="password" value="<?php echo($password)?>" name="password" autocomplete="off" class="form_input" >
            <span id="passerr">
                <?php
                    if (isset($_SESSION['Password'])) {
                        echo $_SESSION['Password'];
                        unset($_SESSION['Password']);
                    }
                ?>
            </span>
            <br><br>
            
            <button type="Submit" name="action" value="delete">Delete Account</button>
            <button type="Submit" name="action" value="change">Save Changes</button>
            
        
        </form>

        <footer>
            <hr>
            <p>Copyright &copy; All rights reserved by ALIDADA</p>
        </footer>
    </div>
</body>
</html>