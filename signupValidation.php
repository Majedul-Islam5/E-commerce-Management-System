<?php
session_start();

include_once ('Database/data.php');


$firstname=isset($_POST['userName']) ? trim($_POST['userName']) : '';
$email=isset($_POST['email']) ? trim($_POST['email']) : '';
$mobile=isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
$address=isset($_POST['address']) ? trim($_POST['address']) : '';
$password=isset($_POST['password']) ? trim($_POST['password']) : '';
$userType=isset($_POST['userType']) ? trim($_POST['userType']) : '';

$error="";


if ($firstname=='' || $email=='' || $mobile=='' || $address=='' || $password=='' || $userType=='')
{
    $error="All fields are required";
} 

if (!empty($errors)) 
{
    $_SESSION['signup_error'] = $error;
    header("Location: index.php");
    exit();
}
else
{

    $stmt = $conn->prepare("INSERT INTO user_info (user_name,password,type,address,email,nid ) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $firstname, $password, $userType,$address,$email,$mobile);
    $stmt->execute();

    header("Location: Login.php");
}
