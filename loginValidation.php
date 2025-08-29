<?php
    session_start();

    include_once 'Database/data.php';

    $firstname=isset($_POST['userName']) ? trim(htmlspecialchars($_POST['userName'])) : '';
    $password=isset($_POST['password']) ? trim(htmlspecialchars($_POST['password'])) : '';

    $errors="";

    if(empty($firstname)) 
    {
        $errors="Name is empty";
    }

    if(empty($password)) 
    {
        $errors="Password is empty";
    }

    if (!empty($errors)) 
    {
        $_SESSION['login_error']=$errors;
        header("Location:Login.php");
        exit();
    }
    else
    {

        $result=$conn->query("select * from user_info where user_name='$firstname'"); 
        $row=$result->fetch_all(MYSQLI_ASSOC);
        if($row[0]['user_name']!=$firstname)
        {
            $_SESSION['nameError']="User does not exist";
            header("Location: Login.php");
            exit();
        }
        if($row[0]['password']!=$password)
        {
            $_SESSION['passError']="Password does not match";
            header("Location: Login.php");
        }
        else
        {
            $_SESSION['userName']=$firstname;
            header("Location: Customer/cusDashboard.php");
        }

}
?>

