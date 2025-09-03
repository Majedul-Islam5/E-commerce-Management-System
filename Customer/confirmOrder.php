<?php

    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }
    $userId=$_SESSION['userId'];
    $status="ordered";

    $stmt=$conn->prepare("INSERT INTO order_info (c_id,status) VALUES (?,?)");
    $stmt->bind_param("is", $userId, $status);
    $stmt->execute();

    $stmt=$conn->prepare("DELETE FROM customer_order where user_id=?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    header("Location: cusDashboard.php");
?>