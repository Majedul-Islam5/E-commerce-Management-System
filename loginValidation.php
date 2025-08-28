<?php
session_start();

include_once 'Database/data.php';

$firstname=isset($_POST['name']) ? trim(htmlspecialchars($_POST['name'])) : '';
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



    header("Location: Customer/cusDashboard.php");

}
