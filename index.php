<?php
    session_start();
    if (isset($_SESSION['signup_error'])) 
    {
        echo "<p style='color: red;'>Empty Field exist</p>";
        unset($_SESSION['signup_error']);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="main-content">
    <header>
    <h2>ALIDADA</h2>
    <nav>
        <a href="index.php">Home</a>
        <a href="../html/Education.html">Contact</a>
        <a href="../html/Experience.html">About</a>
        <a href="Login.php">Log In</a>
    </nav>
</header>

    <hr>
    </div>
<img src="Image/LOGINSIGNUP.jpg" alt="signup" >

<form action="signupValidation.php" method="POST" onsubmit="return validation()">

        <div class="container">
            <h1>Sign Up</h1>
            
        </div>

        <div class="container">
            
            <input type="text" id="name" name="userName" autocomplete="off" placeholder=" " class="form_input" >
            <label for="name"> <strong>Name</strong></label>
            <span id="nameerr"></span>
        </div>
        


        <div class="container">
            
            <input type="email" id="email" name="email" autocomplete="off" placeholder=" " class="form_input" >
            <label for="email"> <strong>Email</strong></label>
            <span id="emailerr"></span>
        </div>

        <div class="container">
            <select id="userType" name="userType" class="form_input" style="width:338px; height: 45px;">
                <option value="" disabled selected>Select a Type</option>
                <option value="Customer">Customer</option>
                <option value="DeliveryMan">Delivery Man</option>
            </select>
            <label for="userType"><strong>User Type</strong></label>
            <span id="typeerr"></span>
        </div>


        <div class="container">
            
            <input type="number" id="mobile" name="mobile" autocomplete="off" placeholder=" " class="form_input" >
            <label for="number"> <strong>Mobile</strong></label>
            <span id="mobileerr"></span>
        </div>

        <div class="container">
            
            <input type="text" id="address" name="address"  autocomplete="off" placeholder=" " class="form_input">
            <label for="address"> <strong>Address</strong></label>
            <span id="addresserr"></span>
        </div>

        <div class="container">
            <input type="password" id="password" name="password" autocomplete="off" placeholder=" " class="form_input" >
            <label for="password"><strong>Password</strong></label>
            <span id="passworderr"></span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Sign Up</button>
        </div>


        

        
        
    </form>
    

    <footer>
        
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
    <script src="JS/signupValidation.js"></script>
</body>
</html>