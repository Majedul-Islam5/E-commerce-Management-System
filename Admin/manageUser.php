<?php
    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    if (isset($_GET['user_id'])) 
    {
        $user_id=$_GET['user_id'];
        echo $user_id;

        $result=$conn->query("select * from user_info where user_id='$user_id'"); 
        $result=$result->fetch_all(MYSQLI_ASSOC);
        if($result[0]['type']=="Customer")
        {
            $stmt=$conn->prepare("update order_info set d_id=NULL WHERE c_id=?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            $stmt=$conn->prepare("DELETE FROM customer_order WHERE user_id=?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            $stmt=$conn->prepare("DELETE FROM order_info WHERE c_id=?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            $stmt=$conn->prepare("DELETE FROM user_info WHERE user_id=?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            header("Location: customerInfo.php");
        }
        elseif($result[0]['type']=="DeliveryMan")
        {

            $stmt=$conn->prepare("DELETE FROM order_info WHERE d_id=?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            
            $stmt=$conn->prepare("DELETE FROM user_info WHERE user_id=?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            header("Location: customerInfo.php");
        }
    }
?>