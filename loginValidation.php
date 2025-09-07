<?php
    session_start();

    include_once ('Database/data.php');

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $firstname=isset($_POST['userName']) ? test_input($_POST['userName']) : '';
    $password=isset($_POST['password']) ? test_input($_POST['password']) : '';

    $errors="";

    if(empty($firstname)) 
    {
        $_SESSION['Name']="Name is empty";
        $errors="Name is empty";
    }

    if(empty($password)) 
    {   
        $_SESSION['Password']="Password is empty";
        $errors="Password is empty";
    }

    if (!empty($errors)) 
    {
        //$_SESSION['login_error']=$errors;
        header("Location:Login.php");
        exit();
    }
    else
    {

        $result=$conn->query("select * from user_info where user_name='$firstname'"); 
        $row=$result->fetch_all(MYSQLI_ASSOC);
        if(empty($row))
        {
            $_SESSION['nameError']="User does not exist";
            header("Location: Login.php");
            exit();
        }
        if($row[0]['password']!=$password)
        {
            $_SESSION['passError']="Password does not match";
            header("Location: Login.php");
            exit();
        }
        else
        {
            $_SESSION['userId']=$row[0]['user_id'];
            if($row[0]['type']=="Customer")
            {
                header("Location: Customer/cusDashboard.php");
                exit();
            }

            if($row[0]['type']=="Admin")
            {
                header("Location: Admin/adDashboard.php");
                exit();
            }

            if($row[0]['type']=="DeliveryMan")
            {
                header("Location: DeliveryMan/deliDashBoard.php");
                exit();
            }
            
        }

}
?>

