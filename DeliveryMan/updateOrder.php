<?php
    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    $errors="";

    if(isset($_POST['accept']))
    {
        if (!isset($_FILES['product']) ||  $_FILES['product']['error'] !== UPLOAD_ERR_OK) 
        {
        
            $_SESSION['product'] = "Please upload a image to confirm delivery.";
            $errors="empty";
        }

        if (!empty($errors)) 
        {
            header("Location: deliDeliveryStatus.php");
            exit();
        }
        else
        {
            $order_id=$_POST['accept'];
            $status="delivered";
            $stmt=$conn->prepare("update order_info set status=? WHERE order_id=?");
            $stmt->bind_param("si", $status, $order_id);
            $stmt->execute();

            header("Location: deliDashBoard.php");
            exit();
        }
    }
    if(isset($_POST['cancel']))
    {
        $order_id=$_POST['cancel'];
        $status="ordered";
        $stmt=$conn->prepare("update order_info set status=?,d_id=NULL WHERE order_id=?");
        $stmt->bind_param("si", $status, $order_id);
        $stmt->execute();

        header("Location: deliDeliveryStatus.php");
        exit();
    }

    
?>