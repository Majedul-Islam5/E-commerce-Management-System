<?php
session_start();

include_once 'Database/data.php';


$firstname=isset($_POST['name']) ? trim($_POST['name']) : '';
$email=isset($_POST['email']) ? trim($_POST['email']) : '';
$mobile=isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
$address=isset($_POST['address']) ? trim($_POST['address']) : '';
$password=isset($_POST['password']) ? trim($_POST['password']) : '';
$userType=isset($_POST['userType']) ? trim($_POST['userType']) : '';

$error="";


if ($firstname=='' || $email=='' || $mobile=='' || $address=='' || $password=='' || $userType=='')
{
    $error="Name is empty";
} 

if ($error) 
{
    $_SESSION['signup_error'] = $error;
    header("Location: index.php");
    exit();
}
else
{


    header("Location: Login.php");
}
